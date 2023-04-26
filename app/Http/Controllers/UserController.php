<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        // $usr = User::find($id);
        // $usr->name = $request->name;
        // $usr->email = $request->email;
        // $usr->password = Hash::make($request->password);

        return response()->json(['success' => 'Laravel ajax example is being processed.']);
    }
}
