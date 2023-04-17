<?php

namespace App\Http\Controllers;

use App\Http\Middleware\User;
use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }

    public function getHome()
    {
        $tenloai = 'Khách hàng';
        $donhang = DonHang::where('user_id', Auth::user()->id)->orderBy('created_at', 'asc')->get();
        // dd($donhang);
        return view('user.index', compact('donhang', 'tenloai'));
    }

    public function getDonHang()
    {
        // Quản lý đơn hàng của khách hàng
        // "Đơn hàng của tôi"
        $tenloai = 'Khách hàng';
        $donhang = DonHang::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('user.donhang', compact('donhang', 'tenloai'));
    }

    public function getDonHang_ChiTiet($id)
    {
        $tenloai = 'Khách hàng';
        return view('user.donhang_chitiet', compact('tenloai'));
    }

    public function getMatKhau()
    {
        $tenloai = 'Khách hàng';
        return view('user.doimatkhau', compact('tenloai'));
    }

    public function getHoSo()
    {
        $tenloai = 'Khách hàng';
        return view('user.hoso');
    }

    public function postCapNhatHoSo(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:email,' . $id],
            'password' => ['confirmed'],
        ]);

        $orm = User::find($id);
        $orm->name = $request->name;
        $orm->username = Str::before($request->email, '@');
        $orm->email = $request->email;
        if (!empty($request->password)) $orm->password = Hash::make($request->password);
        $orm->save();

        return redirect()->route('khachhang');
    }
}
