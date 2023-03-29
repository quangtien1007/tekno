<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NguoiDungController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getDanhSach()
    {
        $nguoidung = User::all();
        return view('admin.nguoidung.danhsach', compact('nguoidung'));
    }

    public function getThem()
    {
        return view('admin.nguoidung.them');
    }

    public function postThem(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required'],
            'password' => ['required', 'min:4', 'confirmed'],
        ]);

        $orm = new User();
        $orm->name = $request->name;
        $orm->username = Str::before($request->email, '@');
        $orm->email = $request->email;
        $orm->password = Hash::make($request->password);
        $orm->role = $request->role;
        $orm->save();

        return redirect()->route('admin.nguoidung');
    }

    public function getSua($id)
    {
        $nguoidung = User::find($id);
        return view('admin.nguoidung.sua', compact('nguoidung'))->with('success', 'Đã thêm tài khoản thành công');
    }

    public function postSua(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->id],
            'role' => ['required'],
            'password' => ['confirmed'],
        ]);

        $orm = User::find($request->id);
        $orm->name = $request->name;
        $orm->username = Str::before($request->email, '@');
        $orm->email = $request->email;
        $orm->role = $request->role;
        if (!empty($request->password)) $orm->password = Hash::make($request->password);
        $orm->save();

        return redirect()->route('admin.nguoidung')->with('success', 'Đã cập nhật tài khoản thành công');
    }

    public function getXoa($id)
    {
        $orm = User::find($id);
        $orm->delete();

        return redirect()->route('admin.nguoidung')->with('success', 'Đã xóa tài khoản thành công');
    }
}
