<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\DonHang_ChiTiet;
use Illuminate\Http\Request;

class DonHangChiTietController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getDanhSach()
    {
        // Xử lý chung với DonHang
    }

    public function getDonHangChiTiet($donhang_id)
    {
        $tenloai = 'Đơn hàng chi tiết';
        $dh = DonHang::where('id', $donhang_id)->first();
        $dhct = DonHang_ChiTiet::where('donhang_id', $donhang_id)->get();
        return view('user.donhang_chitiet', compact('tenloai', 'dhct', 'dh'));
    }

    public function getThem()
    {
        // Xử lý chung với DonHang
    }

    public function postThem(Request $request)
    {
        // Xử lý chung với DonHang
    }

    public function getSua($id)
    {
        // Xử lý chung với DonHang
    }

    public function postSua(Request $request, $id)
    {
        // Xử lý chung với DonHang
    }

    public function getXoa($id)
    {
        // Xử lý chung với DonHang
    }
}
