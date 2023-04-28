<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DonHang;
use Illuminate\Support\Facades\Validator;
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

        $validation = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['confirmed'],
        ]);
        if ($validation->passes()) {
            $usr = User::find($id);
            $usr->name = $request->name;
            $usr->email = $request->email;
            $usr->password = Hash::make($request->password);
            $usr->save();
            return response()->json([
                'title' => 'Thành công',
                'info' => 'Đã sửa thông tin thành công!',
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'title' => 'Lỗi',
                'info' => 'Có lỗi vui lòng kiểm tra lại thông tin',
                'status' => 'error',
            ]);
        }
    }

    public function postDiaChi(Request $request)
    {
        $id = Auth::user()->id;
        $usr = User::find($id);
        $usr->diachi = $request->diachi;
        $usr->sodienthoai = $request->sodienthoai;
        $usr->save();
        return response()->json([
            'title' => 'Thành công',
            'info' => 'Đã sửa thông tin thành công!',
            'status' => 'success',
        ]);
    }
}
