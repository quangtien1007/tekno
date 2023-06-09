<?php

namespace App\Http\Controllers;

use App\Models\LoaiSanPham;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LoaiSanPhamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getDanhSach()
    {
        $loaisanpham = LoaiSanPham::all();
        return view('admin.loaisanpham.danhsach', compact('loaisanpham'));
    }

    public function getThem()
    {
        $category = LoaiSanPham::all();
        return view('admin.loaisanpham.them', compact('category'));
    }

    public function postThem(Request $request)
    {
        $this->validate($request, [
            'tenloai' => ['required', 'string', 'max:191'],
        ]);

        // Upload hình ảnh
        $path = '';
        // dd();
        $orm = new LoaiSanPham();
        $orm->tenloai = $request->tenloai;
        $orm->tenloai_slug = Str::slug($request->tenloai, '-');
        $orm->parent_id = $request->parent_id;
        // dd($path);
        // if (!empty($path)) $orm->hinhanh = $path;
        $orm->save();

        return redirect()->route('admin.loaisanpham.create')->with('success', 'Thêm loại sản phẩm thành công');
    }

    public function getSua($id)
    {
        $loaisanpham = LoaiSanPham::find($id);
        return view('admin.loaisanpham.sua', compact('loaisanpham'));
    }

    public function postSua(Request $request, $id)
    {
        $this->validate($request, [
            'tenloai' => ['required', 'string', 'max:191', 'unique:loaisanpham,tenloai,' . $id],
        ]);

        $orm = LoaiSanPham::find($id);
        $orm->tenloai = $request->tenloai;
        $orm->tenloai_slug = Str::slug($request->tenloai, '-');
        $orm->save();

        return redirect()->route('admin.loaisanpham')->with('success', 'Cập nhật loại sản phẩm thành công');
    }

    public function getXoa($id)
    {
        $orm = LoaiSanPham::find($id);
        $orm->delete();

        return redirect()->route('admin.loaisanpham')->with('success', 'Xóa loại sản phẩm thành công');
    }
}
