<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\HangSanXuat;

class AdminController extends Controller
{
    public function __construct()
    {
        // Bắt buộc phải đăng nhập
        $this->middleware('auth');
    }

    public function getHome()
    {
        $dhct = DB::table('donhang')->get();
        $tongDonHang = count($dhct);
        $data = [];
        $tongSanPham = DB::table('donhang_chitiet')
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
        return view('admin.index', compact('thongke', 'data'));
    }
}
