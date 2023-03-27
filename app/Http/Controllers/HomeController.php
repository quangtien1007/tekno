<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\User;
use App\Models\MauSanPham;
use App\Models\DungLuongSanPham;
use App\Models\DonHang;
use App\Models\DonHang_ChiTiet;
use App\Models\LoaiSanPham;
use App\Models\HangSanXuat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Mail\DatHangEmail;
use App\Models\BaiViet;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\ExpressCheckout;

class HomeController extends Controller
{
    public function getHome()
    {
        $sanpham = SanPham::orderby('id', 'asc')->limit(10)->get();
        $laptop = SanPham::where('loaisanpham_id', 3)->paginate(5);
        $navdata = LoaiSanPham::where('parent_id', 0)->get();
        $cusac = SanPham::where('loaisanpham_id', 5)->paginate(4);
        $tablet = SanPham::where('loaisanpham_id', 2)->paginate(4);
        $tainghe = SanPham::where('loaisanpham_id', 6)->paginate(3);
        return view('client.index', compact('sanpham', 'navdata', 'tainghe', 'laptop', 'cusac', 'tablet'));
    }

    public function getDangKy()
    {
        return view('user.dangky');
    }

    public function getDangNhap()
    {
        return view('user.dangnhap');
    }

    public function getBaiViet()
    {
        $baiviet = BaiViet::paginate(10);
        return view('client.baiviet', compact('baiviet'));
    }

    public function getBaiVietChiTiet($tieude_slug)
    {
        if (!empty($tieude_slug)) {
            $baiviet = BaiViet::where('tieude_slug', $tieude_slug)->first();
            $author = User::where('id', $baiviet->author_id)->first();
            DB::table('baiviet')->where('id', $baiviet->id)->update(['luotxem' => $baiviet->luotxem + 1]);
        }
        session()->push('baivietvuaxem', $baiviet);
        // dd(session());

        return view('client.baivietchitiet', compact('baiviet', 'author'));
    }

    public function getSanPham($tenloai_slug = '')
    {
        $tenloai = '';
        if (!empty($tenloai_slug)) {
            $loaisanpham = LoaiSanPham::where('tenloai_slug', $tenloai_slug)->first();
            $sanpham = SanPham::where('loaisanpham_id', $loaisanpham->id)->paginate(12);
            $tenloai = $loaisanpham->tenloai;
            $hangsanxuat = SanPham::select('hangsanxuat_id')->where('loaisanpham_id', $loaisanpham->id)->distinct()->get();
        } else {
            $sanpham = SanPham::paginate(12);
            $hangsanxuat = HangSanXuat::all();
        }
        $msp = DungluongSanPham::all();
        $lsp = LoaiSanPham::where('tenloai_slug', $tenloai_slug)->first();

        // dd($lsp);

        return view('client.sanpham', compact('sanpham', 'tenloai', 'msp', 'hangsanxuat', 'lsp'));
    }

    public function getDanhMucChiTiet($tenloai_slug, $tenhang_slug)
    {
        $tenloai = '';
        $hangsanxuat = array();
        if (!empty($tenhang_slug) && !empty($tenloai_slug)) {
            $loaisanpham = LoaiSanPham::where('tenloai_slug', $tenloai_slug)->first();
            $hsx = HangSanXuat::where('tenhang_slug', $tenhang_slug)->first();
            $sanpham = SanPham::where('loaisanpham_id', $loaisanpham->id)->where('hangsanxuat_id', $hsx->id)->paginate(16);
            $hangsanxuat = SanPham::select('hangsanxuat_id')->where('loaisanpham_id', $loaisanpham->id)->distinct()->get();
        }
        $msp = MauSanPham::all();
        $lsp = LoaiSanPham::where('tenloai_slug', $tenloai_slug)->first();
        return view('client.sanpham', compact('sanpham', 'tenloai', 'msp', 'hangsanxuat', 'lsp'));
    }
    public function postSanPham(Request $request)
    {
        // $lsp = LoaiSanPham::where('tenloai_slug', $request->tenloai_slug)->first();
        $msp = DungLuongSanPham::all();
        
        if (isset($request->search) && isset($request->cate_select)) {
            $sanpham = SanPham::where('tensanpham', 'LIKE', "%{$request->search}%")
                ->where('loaisanpham_id', 'LIKE', "%{$request->cate_select}%")
                ->paginate(15);
            $lsp = LoaiSanPham::where('id', $request->cate_select)->first();
            $tenloai = 'Tìm kiếm';
            return view('client.sanpham', compact('sanpham', 'tenloai', 'lsp', 'msp'));
        }
        if (isset($request->tenloai_slug)) {
            $lsp = LoaiSanPham::where('tenloai_slug', $request->tenloai_slug)->first();
            $tenloai = $lsp->tenloai;

            if ($request->sapxep == 'popularity') // Mua nhiều nhất
            {
                $sanpham = SanPham::leftJoin('donhang_chitiet', 'sanpham.id', '=', 'donhang_chitiet.sanpham_id')
                    ->where('sanpham.loaisanpham_id', $lsp->id)
                    ->selectRaw('sanpham.*, coalesce(sum(donhang_chitiet.soluongban), 0) tongsoluongban')
                    ->groupBy('sanpham.id')
                    ->orderBy('tongsoluongban', 'desc')
                    ->paginate(16);

                // Ghi vào SESSION
                session()->put('sapxep', 'popularity');
            } elseif ($request->sapxep == 'date') // Mới nhất
            {
                $sanpham = SanPham::where('loaisanpham_id', $lsp->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(16);

                // Ghi vào SESSION
                session()->put('sapxep', 'date');
            } elseif ($request->sapxep == 'price') // Xếp theo giá: thấp đến cao
            {
                $sanpham = SanPham::where('loaisanpham_id', $lsp->id)
                    ->orderBy('dongia', 'asc')
                    ->paginate(16);

                // Ghi vào SESSION
                session()->put('sapxep', 'price');
            } elseif ($request->sapxep == 'price-desc') // Xếp theo giá: cao xuống thấp
            {
                $sanpham = SanPham::where('loaisanpham_id', $lsp->id)
                    ->orderBy('dongia', 'desc')
                    ->paginate(16);

                // Ghi vào SESSION
                session()->put('sapxep', 'price-desc');
            } else // Mặc định
            {
                $sanpham = SanPham::where('loaisanpham_id', $lsp->id)
                    ->paginate(16);

                // Ghi vào SESSION
                session()->put('sapxep', 'default');
            }

            return view('client.sanpham', compact('sanpham', 'tenloai', 'lsp', 'msp'));
        } else {
            if ($request->sapxep == 'popularity') // Mua nhiều nhất
            {
                $sanpham = SanPham::leftJoin('donhang_chitiet', 'sanpham.id', '=', 'donhang_chitiet.sanpham_id')
                    ->selectRaw('sanpham.*, coalesce(sum(donhang_chitiet.soluongban), 0) tongsoluongban')
                    ->groupBy('sanpham.id')
                    ->orderBy('tongsoluongban', 'desc')
                    ->paginate(16);

                // Ghi vào SESSION
                session()->put('sapxep', 'popularity');
            } elseif ($request->sapxep == 'date') // Mới nhất
            {
                $sanpham = SanPham::orderBy('created_at', 'desc')->paginate(16);

                // Ghi vào SESSION
                session()->put('sapxep', 'date');
            } elseif ($request->sapxep == 'price') // Xếp theo giá: thấp đến cao
            {
                $sanpham = SanPham::orderBy('dongia', 'asc')->paginate(16);

                // Ghi vào SESSION
                session()->put('sapxep', 'price');
            } elseif ($request->sapxep == 'price-desc') // Xếp theo giá: cao xuống thấp
            {
                $sanpham = SanPham::orderBy('dongia', 'desc')->paginate(16);

                // Ghi vào SESSION
                session()->put('sapxep', 'price-desc');
            } else // Mặc định
            {
                $sanpham = SanPham::paginate(16);

                // Ghi vào SESSION
                session()->put('sapxep', 'default');
            }
        }
        return view('client.sanpham', compact('sanpham', 'lsp', 'msp'));
    }

    public function postTimSanPham(Request $request)
    {
        if (isset($request->search) && isset($request->cate_select)) {
            $sanpham = SanPham::where('tensanpham', 'LIKE', "%{$request->search}%")
                ->where('loaisanpham_id', 'LIKE', "%{$request->cate_select}%")
                ->get();
        } else if (isset($request->search)) {
            $sanpham = SanPham::where('tensanpham', 'LIKE', "%{$request->search}%")->get();
        }
        dd($sanpham);
    }

    public function getSanPham_ChiTiet($tenloai_slug, $tensanpham_slug)
    {
        $msp = MauSanPham::all();
        $dl = DungLuongSanPham::all();
        $loaisanpham = LoaiSanPham::where('tenloai_slug', $tenloai_slug)->first();
        $sanpham = SanPham::where('tensanpham_slug', $tensanpham_slug)->first();
        $sanphamlienquan = SanPham::where('loaisanpham_id', $loaisanpham->id)->orderBy('created_at', 'desc')->take(4)->get();
        return view('client.sanpham_chitiet', compact('loaisanpham', 'sanpham', 'sanphamlienquan', 'msp', 'dl'));
    }

    public function getLienHe()
    {
        return view('client.lienhe');
    }

    public function getGioHang()
    {
        $sanpham = SanPham::all();
        if (Cart::count())
            return view('client.giohang', compact('sanpham'));
        else
            return view('client.giohang_rong');
    }


    public function postGioHang_Them(Request $request)
    {
        // dd($request);
        $sanpham = SanPham::where('tensanpham_slug', $request->tensanpham_slug)->first();

        Cart::add([
            'id' => $sanpham->id,
            'name' => $sanpham->tensanpham,
            'price' => $sanpham->dongia,
            'color' => (isset($request->msp) ? $request->msp : 'null'),
            'storage' => (isset($request->dlsp) ? $request->dlsp : 'null'),
            'qty' => 1,
            'weight' => 0,
            'options' => [
                'image' => $sanpham->hinhanh
            ]
        ]);

        // Quay về trang chủ kèm thông báo dạng flash session
        return redirect()->route('client')->with('status', 'Đã thêm sản phẩm <strong>' . $sanpham->tensanpham . '</strong> vào giỏ.');
    }

    public function getGioHang_Xoa($row_id)
    {
        Cart::remove($row_id);
        return redirect()->route('client.giohang');
    }

    public function getGioHang_XoaTatCa()
    {
        Cart::destroy();
        return redirect()->route('client.giohang');
    }

    public function getGioHang_Giam($row_id)
    {
        $row = Cart::get($row_id);
        if ($row->qty > 1)
            Cart::update($row_id, $row->qty - 1);
        return redirect()->route('client.giohang');
    }

    public function getGioHang_Tang($row_id)
    {
        $row = Cart::get($row_id);
        $msp = MauSanPham::where(['sanpham_id' => $row->id, 'mau' => $row->color])->first();
        $dlsp = DungLuongSanPham::where(['sanpham_id' => $row->id, 'dungluong' => $row->storage])->first();
        if ($row->qty < $msp->soluongton || $row->qty < $dlsp->soluongton) {
            Cart::update($row_id, $row->qty + 1);
            return redirect()->route('client.giohang');
        } else {
            return redirect()->route('client.giohang')->with('status', 'Sản phẩm trong kho không đủ số lượng.');
        }
    }

    public function getDatHang()
    {
        // $id_sp = SanPham::where('id', $id)->first();
        // Nếu đã đăng nhập thì chuyển sang thanh toán
        if (Auth::check())
            return view('client.dathang');
        else // Nếu chưa đăng nhập thì chuyển sang đăng nhập
            return redirect()->route('user.dangnhap');
    }

    public function vnPayCheckOut()
    {
    }

    public function postDatHang(Request $request)
    {
        // dd($request);
        $tinhtrang = 1;
        $status_dh = DB::select("SHOW TABLE STATUS LIKE 'donhang'"); //Câu lệnh xem trạng thái của bảng
        $id_dh = $status_dh[0]->Auto_increment;

        // Lưu vào đơn hàng
        $dh = new DonHang();
        $dh->user_id = Auth::user()->id;
        $dh->tinhtrang_id = $tinhtrang; // Đơn hàng mới
        $dh->diachigiaohang = $request->diachigiaohang;
        $dh->dienthoaigiaohang = $request->dienthoaigiaohang;
        $dh->is_thanhtoan = 0;
        $dh->pt_thanhtoan = 'cod';
        $dh->save();

        // Lưu vào đơn hàng chi tiết
        foreach (Cart::content() as $value) {
            $ct = new DonHang_ChiTiet();
            $mau = MauSanPham::where(['sanpham_id' => $value->id, 'mau' => $value->color])->first();
            $dungluong = DungLuongSanPham::where(['sanpham_id' => $value->id, 'dungluong' => $value->storage])->first();

            $ct->donhang_id = $dh->id;
            $ct->sanpham_id = $value->id;
            $ct->mau_id = isset($mau->id) ? $mau->id : '165';
            $ct->dungluong_id = isset($dungluong->id) ? $dungluong->id : '218';
            $ct->soluongban = $value->qty;
            $ct->dongiaban = $value->price;
            $ct->save();


            //cập nhật số lượng tồn của màu và dung lượng sản phẩm
            if (isset($mau->id)) {
                DB::table('mausanpham')->where('id', $mau->id)->update(['soluongton' => $mau->soluongton - $value->qty]);
            }
            if (isset($dungluong->id)) {
                DB::table('dungluongsanpham')->where('id', $dungluong->id)->update(['soluongton' => $dungluong->soluongton - $value->qty]);
            }
        }

        $this->validate($request, [
            'diachigiaohang' => ['required', 'max:191'],
            'dienthoaigiaohang' => ['required', 'max:191'],
        ]);

        if ($request->payment_opt == 'cod') {
            //
            // $ct->save();
            Mail::to(Auth::user()->email)->send(new DatHangEmail($dh));
            return redirect()->route('client.dathangthanhcong');
            // //
        } elseif ($request->payment_opt == 'paypal') {
            //
            $price = round(Cart::total() / 235900, 2); //chuyen doi tien te
            $data = [];
            $data['items'] = [
                [
                    'name' => Cart::content()->first()->name,
                    'price' => $price,
                    'desc' => 'Description',
                    'qty' => Cart::content()->first()->qty
                ]
            ];

            $data['invoice_id'] = 1;
            $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
            $data['return_url'] = route('payment.success');
            $data['cancel_url'] = route('payment.cancel');
            $data['total'] = $price;

            $provider = new ExpressCheckout;
            $response = $provider->setExpressCheckout($data); //set data cho response
            $response = $provider->setExpressCheckout($data, true);

            Mail::to(Auth::user()->email)->send(new DatHangEmail($dh));
            DB::update(
                'update donhang set tinhtrang_id = ? ,is_thanhtoan = ?, pt_thanhtoan = ? where id = ?',
                [2, 1, $request->payment_opt, $id_dh]
            );

            return redirect($response['paypal_link']);
        } elseif ($request->payment_opt == 'vnpay') {
            //
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://localhost:90/techshop/dat-hang-thanh-cong";
            $vnp_TmnCode = "NRCQ8CGP"; //Mã website tại VNPAY
            $vnp_HashSecret = "ALFRFFGZLUMPKJOCTRPKKYHCKLMEJPXZ"; //Chuỗi bí mật

            $vnp_TxnRef = rand(10, 200); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Thanh toán VNPAY';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = Cart::total() * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array(
                'code' => '00', 'message' => 'success', 'data' => $vnp_Url
            );
            if (isset($_POST['redirect'])) {
                DB::update(
                    'update donhang set tinhtrang_id = ? ,is_thanhtoan = ?, pt_thanhtoan = ? where id = ?',
                    [2, 1, $request->payment_opt, $id_dh]
                );
                // $ct->save();
                Mail::to(Auth::user()->email)->send(new DatHangEmail($dh));
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
        }

        return redirect()->route('client.dathangthanhcong');
    }

    public function getDatHangThanhCong()
    {
        if (isset($_GET['vnp_Amount'])) {
            DB::insert(
                'insert into vnpay_checkout (vnp_Amount, vnp_BankCode, vnp_BankTranNo, vnp_CardType, vnp_OrderInfo,vnp_PayDate,vnp_TransactionNo, vnp_SecureHash) values (?, ?, ?, ?, ?, ?, ?, ?)',
                [$_GET['vnp_Amount'], $_GET['vnp_BankCode'], $_GET['vnp_BankTranNo'], $_GET['vnp_CardType'], $_GET['vnp_OrderInfo'], $_GET['vnp_PayDate'], $_GET['vnp_TransactionNo'], $_GET['vnp_SecureHash']]
            );
        }
        // Xóa giỏ hàng khi hoàn tất đặt hàng
        Cart::destroy();
        /*
		vnp_Amount=2088900000
		vnp_BankCode=NCB
		vnp_BankTranNo=VNP13966660
		vnp_CardType=ATM
		vnp_OrderInfo=Thanh+to%C3%A1n+VNPAY
		vnp_PayDate=20230318212816
		vnp_ResponseCode=00&vnp_TmnCode=NRCQ8CGP
		vnp_TransactionNo=13966660
		vnp_TransactionStatus=00&vnp_TxnRef=80
		vnp_SecureHash=416c6bbda833c4a6e2738eff6896e68da7e9b52a829f0b67d8fa0061bec4847e8f901980d4adbdb544fcbb2af010b12f63ae0b790bb47eaceba7dbe9e0b24a76*/
        return view('client.dathangthanhcong');
    }

    public function getDatHangKhongThanhCong()
    {
        Cart::destroy();
        return view('client.dathangthanhcong');
    }

    public function postSoSanh(Request $request)
    {
        $sanpham = SanPham::where('id', $request->idsp)->first();
        $addItems = "<script>
                        console.log('started');
                        var sosanh = ['{$sanpham->id}','asdads','{$sanpham->tensanpham}','{$sanpham->dongia}'];
                        var items = JSON.stringify(sosanh)
                        localStorage.setItem('sanpham{$sanpham->id}', items);
                        const storedBlogs = JSON.parse(localStorage.getItem('sanpham{$sanpham->id}'));
                    </script>";
        // dd($sanpham);
        // session()->push('sosanh', [$sanpham]);
    }
}
