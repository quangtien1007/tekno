<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\DonHang_ChiTiet;
use App\Models\TinhTrang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\SanPham;
use App\Models\MauSanPham;
use App\Models\DungLuongSanPham;
use App\Models\DungLuong_Mau;
use App\Models\HangSanXuat;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\LoaiSanPham;

class DonHangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getDanhSach()
    {
        $donhang = DonHang::all();
        return view('admin.donhang.danhsach', compact('donhang'));
    }

    public function getDungLuongTheoSanPham($idsp)
    {
        $dl_id = DB::table('dungluong_mau')->distinct()->select('dungluong_id')->where('sanpham_id', '=', $idsp)->get();
        foreach ($dl_id as $item) {
            $dl = DB::table('dungluong')->where('id', $item->dungluong_id)->first()->dungluong;
            $item->dungluong = $dl;
        }
        return json_encode($dl_id);
    }


    public function getThem()
    {
        $donhang = Donhang::all();
        $sanpham = SanPham::all();
        $dungluong = DungLuongSanPham::all();
        $mau = MauSanPham::all();
        return view('admin.donhang.them', compact('donhang', 'sanpham', 'dungluong', 'mau'));
    }

    public function postThem(Request $request)
    {
        // dd($request);
        $tenloai = 'Đặt hàng thành công';
        $tinhtrang = 8;
        $status_dh = DB::select("SHOW TABLE STATUS LIKE 'donhang'"); //Câu lệnh xem trạng thái của bảng
        $id_dh = $status_dh[0]->Auto_increment;

        // Lưu vào đơn hàng
        $dh = new DonHang();
        $dh->user_id = Auth::user()->id;
        $dh->tinhtrang_id = $tinhtrang; // Đơn hàng mới
        $dh->diachigiaohang = 'Tại quầy';
        $dh->dienthoaigiaohang = $request->dienthoaigiaohang;
        $dh->is_thanhtoan = 1;
        $dh->pt_thanhtoan = 'Tại quầy';
        $dh->save();

        // Lưu vào đơn hàng chi tiết
        $ct = new DonHang_ChiTiet();
        $ct->donhang_id = $dh->id;
        $ct->sanpham_id = $request->sanpham_id;
        $ct->mau_id = isset($request->msp) ? $request->msp : 6;
        $ct->dungluong_id = isset($request->dlsp) ? $request->dlsp : 6;
        $ct->soluongban = $request->soluong;
        $ct->dongiaban = SanPham::where('id', $request->sanpham_id)->first()->dongia;
        $ct->save();


        $dungluong_mau = DungLuong_Mau::where('sanpham_id', $request->sanpham_id)->where('dungluong_id', $request->dlsp)->where('mau_id', $request->msp)->first();
        //cập nhật số lượng tồn của màu và dung lượng sản phẩm
        if (isset($request->msp) || isset($request->dlsp)) {
            DB::table('dungluong_mau')
                ->where('dungluong_id', $request->dlsp)
                ->where('mau_id', $request->msp)
                ->where('sanpham_id', $request->sanpham_id)
                ->update(['soluongton' => $dungluong_mau->soluongton - $request->soluong]);
        }


        $dh = DB::table('donhang')->where('id', $id_dh)->first();
        $dhct = DonHang_ChiTiet::where('donhang_id', $id_dh)->get();

        $data = [
            'title' => 'Thông tin hóa đơn',
            'date' => date('m/d/Y'),
            'dhct' => $dhct,
            'dh' => $dh,
            'tenkh' => $request->tenkh,
        ];

        $pdf = PDF::loadView('admin.donhang.hoadon', $data);

        $pdf->download('hoadon.pdf');

        return $pdf->download('hoadon.pdf');
    }

    public function getInDonHang($donhang_id)
    {
        $dh = DB::table('donhang')->where('id', $donhang_id)->first();
        // dd($dh);
        $dhct = DonHang_ChiTiet::where('donhang_id', $donhang_id)->get();

        $data = [
            'title' => 'Thông tin hóa đơn',
            'date' => date('m/d/Y'),
            'dhct' => $dhct,
            'dh' => $dh
        ];

        $pdf = PDF::loadView('admin.donhang.hoadon', $data);

        return $pdf->download('hoadon.pdf');
    }

    public function getSua($id)
    {
        $donhang = DonHang::find($id);
        $tinhtrang = TinhTrang::all();
        return view('admin.donhang.sua', compact('donhang', 'tinhtrang'));
    }

    public function postSua(Request $request, $id)
    {
        $this->validate($request, [
            'tinhtrang_id' => ['required'],
            'dienthoaigiaohang' => ['required', 'string', 'max:20'],
            'diachigiaohang' => ['required', 'string', 'max:191'],
        ]);

        $orm = DonHang::find($id);
        $orm->tinhtrang_id = $request->tinhtrang_id;
        $orm->dienthoaigiaohang = $request->dienthoaigiaohang;
        $orm->diachigiaohang = $request->diachigiaohang;
        $orm->is_thanhtoan = $request->is_thanhtoan;
        $orm->save();

        return redirect()->route('admin.donhang.index')->with('success', 'Cập nhật đơn hàng thành công');
    }

    public function getXoa($id)
    {
        $orm = DonHang::find($id);

        $chitiet = DonHang_ChiTiet::where('donhang_id', $orm->id)->first();
        $chitiet->delete();
        $orm->delete();

        return redirect()->route('admin.donhang.index')->with('success', 'Xóa đơn hàng thành công');
    }

    public function getThongKe()
    {
        $dhct = DB::table('donhang')->get();
        $tongDonHang = count($dhct);
        $data = [];
        $tongSanPham = DB::table('DonHang_ChiTiet')
            ->select(DB::raw('SUM(soluongban) AS tongSoluong'))
            ->first()->tongSoluong;
        $tongDoanhThu = DB::table('donhang_chitiet')->select(DB::raw('SUM(soluongban*dongiaban) AS tongDoanhThu'))->first()->tongDoanhThu;
        $tongDienThoai = DB::select(DB::raw('SELECT SUM(soluongban) AS tongDT FROM donhang_chitiet,sanpham WHERE donhang_chitiet.sanpham_id = sanpham.id AND sanpham.loaisanpham_id = 1'))[0]->tongDT;
        $tongLaptop = DB::select(DB::raw('SELECT SUM(soluongban) AS tongLaptop FROM donhang_chitiet,sanpham WHERE donhang_chitiet.sanpham_id = sanpham.id AND sanpham.loaisanpham_id = 3'))[0]->tongLaptop;
        $tongTablet = DB::select(DB::raw('SELECT SUM(soluongban) AS tongTablet FROM donhang_chitiet,sanpham WHERE donhang_chitiet.sanpham_id = sanpham.id AND sanpham.loaisanpham_id = 2'))[0]->tongTablet;
        $tongChuotBanPhim = DB::select(DB::raw('SELECT SUM(soluongban) AS tongChuotBanPhim FROM donhang_chitiet,sanpham WHERE donhang_chitiet.sanpham_id = sanpham.id AND sanpham.loaisanpham_id = 4'))[0]->tongChuotBanPhim;
        $lspId = DB::select(DB::raw('
        SELECT DISTINCT loaisanpham_id from sanpham,donhang_chitiet where donhang_chitiet.sanpham_id = sanpham.id
        '));

        $hsx = HangSanXuat::all();
        foreach ($hsx as $h) {
            foreach ($lspId as $lsp) {
                $tongLoaiSanPham = DB::select(DB::raw('
                SELECT DISTINCT COUNT(soluongban) AS
                    test from donhang_chitiet,sanpham WHERE donhang_chitiet.sanpham_id = sanpham.id AND sanpham.hangsanxuat_id = ' . $h->id . ' AND sanpham.loaisanpham_id = ' . $lsp->loaisanpham_id . '
                '))[0];
                // array_unshift($data, $tongLoaiSanPham);
            }
        }
        // dd($data);
        $thongke = [
            'tongdonhang' => $tongDonHang,
            'tongsanpham' => $tongSanPham,
            'doanhthu' => $tongDoanhThu,
            'dienthoai' => $tongDienThoai,
            'laptop' => $tongLaptop,
            'tablet' => $tongTablet,
            'chuotbanphim' => $tongChuotBanPhim,
        ];
        return view('admin.thongke.thongke', compact('thongke', 'data'));
    }
}
