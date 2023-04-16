<?php

namespace App\Http\Controllers;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SanPham;
use App\Models\User;
use App\Models\MauSanPham;
use App\Models\DungLuongSanPham;
use App\Models\DungLuong_Mau;
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
use \App\Models\Message;

class HomeController extends Controller
{
    public function getMauTheoDungLuong($dungluong, $spid)
    {
        $dungluong_id = DB::table('dungluong')->where('dungluong', $dungluong)->first()->id;
        $mau_id = DB::table('dungluong_mau')->where('dungluong_id', $dungluong_id)->where('sanpham_id', $spid)->get();
        foreach ($mau_id as $item) {
            $mau = DB::table('mau')->where('id', $item->mau_id)->first()->mau;
            $item->mau = $mau;
        }
        echo json_encode($mau_id);
    }

    public function getHome()
    {
        //show tin nhan
        $messages = null;
        // Show just the users and not the admins as well
        $users = User::where('is_admin', false)->orderBy('id', 'DESC')->get();
        if (Auth::check()) {
            if (auth()->user()->is_admin == false) {
                $messages = Message::where('user_id', auth()->id())->orWhere('receiver', auth()->id())->orderBy('id', 'DESC')->get();
            } else {
                $messages = null;
            }
        }
        $sanpham = SanPham::orderby('id', 'asc')->limit(10)->get();
        $laptop = SanPham::where('loaisanpham_id', 3)->paginate(5);
        $laptop1 = SanPham::where('loaisanpham_id', 3)->paginate(9);
        $navdata = LoaiSanPham::where('parent_id', 0)->get();
        $cusac = SanPham::where('loaisanpham_id', 5)->paginate(4);
        $tablet = SanPham::where('loaisanpham_id', 2)->paginate(4);
        $tainghe = SanPham::where('loaisanpham_id', 6)->paginate(3);
        $tenloai = 'Trang chủ';
        return view('client.index', compact('sanpham', 'navdata', 'tainghe', 'laptop', 'cusac', 'tablet', 'laptop1', 'messages', 'users', 'tenloai'));
    }

    public function getDangKy()
    {
        $tenloai = 'Đăng ký';
        return view('user.dangky', compact('tenloai'));
    }

    public function getDangNhap()
    {
        $tenloai = 'Đăng nhập';
        return view('user.dangnhap', compact('tenloai'));
    }

    public function getBaiViet()
    {
        $baiviet = BaiViet::paginate(10);
        $tenloai = 'Tin tức';
        return view('client.baiviet', compact('baiviet', 'tenloai'));
    }

    public function getBaiVietChiTiet($tieude_slug)
    {
        if (!empty($tieude_slug)) {
            $baiviet = BaiViet::where('tieude_slug', $tieude_slug)->first();
            $author = User::where('id', $baiviet->author_id)->first();
            DB::table('baiviet')->where('id', $baiviet->id)->update(['luotxem' => $baiviet->luotxem + 1]);
        }
        session()->push('baivietvuaxem', $baiviet);
        $tenloai = $baiviet->tieude;

        return view('client.baivietchitiet', compact('baiviet', 'author', 'tenloai'));
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
        $banchay = DB::table('donhang_chitiet')
            ->select('sanpham_id', DB::raw('SUM(soluongban) as total_sales'))->groupBy('sanpham_id')
            ->get();
        $lsp = LoaiSanPham::where('tenloai_slug', $tenloai_slug)->first();

        return view('client.sanpham', compact('sanpham', 'tenloai', 'hangsanxuat', 'lsp'));
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
        $lsp = LoaiSanPham::where('tenloai_slug', $tenloai_slug)->first();
        return view('client.sanpham', compact('sanpham', 'tenloai', 'hangsanxuat', 'lsp'));
    }
    public function postSanPham(Request $request)
    {
        // dd($request);
        if (isset($request->price_min) && isset($request->price_max)) {
            $sanpham = SanPham::where('dongia', '>', (float)$request->price_min * 1000000)
                ->where('dongia', '<', (float)$request->price_max * 1000000)
                ->paginate(15);
            $tenloai = 'Tìm kiếm';
            $lsp = LoaiSanPham::where('id', $request->loaisanpham_id)->first();
            // dd($sanpham);
            return view('client.sanpham', compact('sanpham', 'tenloai', 'lsp'));
        }
        if (isset($request->search)) {
            $sanpham = SanPham::where('tensanpham', 'LIKE', "%{$request->search}%")->paginate(15);
            $tenloai = 'Tìm kiếm';
            $lsp = LoaiSanPham::where('tenloai_slug', 'LIKE', "%{$request->search}%")->first();

            return view('client.sanpham', compact('sanpham', 'tenloai', 'lsp'));
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

            return view('client.sanpham', compact('sanpham', 'tenloai', 'lsp'));
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
        return view('client.sanpham', compact('sanpham', 'lsp'));
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
        $sp = SanPham::where('tensanpham_slug', $tensanpham_slug)->first();
        $dl = DB::table('dungluong_mau')->distinct()->select('dungluong_id')->where('sanpham_id', '=', $sp->id)->get();
        $loaisanpham = LoaiSanPham::where('tenloai_slug', $tenloai_slug)->first();
        $sanpham = SanPham::where('tensanpham_slug', $tensanpham_slug)->first();
        $sanphamlienquan = SanPham::where('loaisanpham_id', $loaisanpham->id)->orderBy('created_at', 'desc')->take(4)->get();
        return view('client.sanpham_chitiet', compact('loaisanpham', 'sanpham', 'sanphamlienquan', 'dl'));
    }

    public function getLienHe()
    {
        $tenloai = 'Liên hệ';
        return view('client.lienhe', compact('tenloai'));
    }

    public function getGioHang()
    {
        $tenloai = 'Giỏ hàng';
        $sanpham = SanPham::all();
        if (Cart::count())
            return view('client.giohang', compact('sanpham', 'tenloai'));
        else
            return view('client.giohang_rong', compact('tenloai'));
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
            'qty' => $request->qty ? $request->qty : 1,
            'weight' => 0,
            'options' => [
                'image' => $sanpham->hinhanh
            ]
        ]);

        // Quay về trang chủ kèm thông báo dạng flash session
        return redirect()->route('client')->with('success', 'Đã thêm sản phẩm ' . $sanpham->tensanpham . 'vào giỏ.');
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
        $color = MauSanPham::where('mau', $row->color)->first()->id;
        $storage = DungLuongSanPham::where('dungluong', $row->storage)->first()->id;
        $soluongton = DungLuong_Mau::where('dungluong_id', $storage)->where('mau_id', $color)->where('sanpham_id', $row->id)->first();

        if ($row->qty < $soluongton->soluongton) {
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
        $tenloai = 'Đặt hàng';
        if (Auth::check())
            return view('client.dathang', compact('tenloai'));
        else // Nếu chưa đăng nhập thì chuyển sang đăng nhập
            return redirect()->route('user.dangnhap');
    }


    public function postDatHang(Request $request)
    {
        $tenloai = 'Đặt hàng thành công';
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
            $mau = MauSanPham::where(['mau' => $value->color])->first();
            $dungluong = DungLuongSanPham::where(['dungluong' => $value->storage])->first();
            // dd($mau);
            $ct->donhang_id = $dh->id;
            $ct->sanpham_id = $value->id;
            $ct->mau_id = isset($mau->id) ? $mau->id : 6;
            $ct->dungluong_id = isset($dungluong->id) ? $dungluong->id : 6;
            $ct->soluongban = $value->qty;
            $ct->dongiaban = $value->price;
            $ct->save();


            $dungluong_mau = DungLuong_Mau::where('sanpham_id', $value->id)->where('dungluong_id', $dungluong->id)->where('mau_id', $mau->id)->first();
            // dd($dungluong_mau);
            //cập nhật số lượng tồn của màu và dung lượng sản phẩm
            if (isset($mau->id) || isset($dungluong->id)) {
                DB::table('dungluong_mau')
                    ->where('dungluong_id', $dungluong->id)
                    ->where('mau_id', $mau->id)
                    ->where('sanpham_id', $value->id)
                    ->update(['soluongton' => $dungluong_mau->soluongton - $value->qty]);
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
            return redirect()->route('client.dathang.success');
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
            $vnp_Returnurl = "http://127.0.0.1:8000/dat-hang-thanh-cong";
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

        // return redirect()->route('client.dathangthanhcong');
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
        $tenloai = 'Đặt hàng';
        return view('client.dathangthanhcong', compact('tenloai'));
    }

    public function getDatHangKhongThanhCong()
    {
        Cart::destroy();
        return view('client.dathangthanhcong');
    }
}
