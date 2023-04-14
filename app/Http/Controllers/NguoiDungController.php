<?php

namespace App\Http\Controllers;

use App\Models\Role;
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
        $roles = Role::all()->groupBy('group');
        return view('admin.nguoidung.them', compact('roles'));
    }

    public function postThem(Request $request)
    {
        // dd($request);
        $is_admin = 0;
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:4', 'confirmed'],
            'role_ids' => ['required'],
        ]);
        for ($i = 0; $i < count($request->role_ids); $i++) {
            if ($request->role_ids[$i] == 5) {
                $is_admin = 1;
            } else {
                $is_admin = 0;
            }
        }
        $orm = new User();
        $orm->name = $request->name;
        $orm->email = $request->email;
        $orm->password = Hash::make($request->password);
        $orm->is_admin = $is_admin;
        $orm->save();

        $user = User::whereEmail($request->email)->first();
        $user->assignRoles($request->role_ids);

        return redirect()->route('admin.nguoidung')->with('success', 'Đã thêm tài khoản thành công');;
    }

    public function getSua($id)
    {
        $nguoidung = User::find($id);
        return view('admin.nguoidung.sua', compact('nguoidung'));
    }

    public function postSua(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->id],
            'is_admin' => ['required'],
            'password' => ['confirmed'],
        ]);

        $orm = User::find($request->id);
        $orm->name = $request->name;
        $orm->email = $request->email;
        $orm->is_admin = $request->is_admin;
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
