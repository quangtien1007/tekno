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
use Gloudemans\Shoppingcart\Facades\Cart;

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
        $mau_id = DB::table('dungluong_mau')->distinct()->select('mau_id')->where('sanpham_id', '=', $idsp)->get();
        foreach ($dl_id as $item) {
            $dl = DB::table('dungluong')->where('id', $item->dungluong_id)->first()->dungluong;
            $mau = DB::table('mau')->where('id', $item->mau_id)->first()->mau;
            $item->dungluong = $dl;
        }
        foreach ($mau_id as $item) {
            $item->mau = $mau;
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
        // $tenloai = 'Đặt hàng thành công';
        // $tinhtrang = 1;
        // $status_dh = DB::select("SHOW TABLE STATUS LIKE 'donhang'"); //Câu lệnh xem trạng thái của bảng
        // $id_dh = $status_dh[0]->Auto_increment;

        // // Lưu vào đơn hàng
        // $dh = new DonHang();
        // $dh->user_id = Auth::user()->id;
        // $dh->tinhtrang_id = $tinhtrang; // Đơn hàng mới
        // $dh->diachigiaohang = $request->diachigiaohang;
        // $dh->dienthoaigiaohang = $request->dienthoaigiaohang;
        // $dh->is_thanhtoan = 1;
        // $dh->pt_thanhtoan = 'Tại quầy';
        // $dh->save();

        // // Lưu vào đơn hàng chi tiết
        // $ct = new DonHang_ChiTiet();
        // $mau = MauSanPham::where(['mau' => $value->color])->first();
        // $dungluong = DungLuongSanPham::where(['dungluong' => $value->storage])->first();
        // // dd($mau);
        // $ct->donhang_id = $dh->id;
        // $ct->sanpham_id = $request->id;
        // $ct->mau_id = isset($mau->id) ? $mau->id : 6;
        // $ct->dungluong_id = isset($dungluong->id) ? $dungluong->id : 6;
        // $ct->soluongban = $value->qty;
        // $ct->dongiaban = $value->price;
        // $ct->save();


        // $dungluong_mau = DungLuong_Mau::where('sanpham_id', $value->id)->where('dungluong_id', $dungluong->id)->where('mau_id', $mau->id)->first();
        // // dd($dungluong_mau);
        // //cập nhật số lượng tồn của màu và dung lượng sản phẩm
        // if (isset($mau->id) || isset($dungluong->id)) {
        //     DB::table('dungluong_mau')
        //         ->where('dungluong_id', $dungluong->id)
        //         ->where('mau_id', $mau->id)
        //         ->where('sanpham_id', $value->id)
        //         ->update(['soluongton' => $dungluong_mau->soluongton - $value->qty]);
        // }
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

        return redirect()->route('admin.donhang.index');
    }

    public function getXoa($id)
    {
        $orm = DonHang::find($id);
        $orm->delete();

        $chitiet = DonHang_ChiTiet::where('donhang_id', $orm->id)->first();
        $chitiet->delete();

        return redirect()->route('admin.donhang.index');
    }
}
