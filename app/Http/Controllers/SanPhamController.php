<?php

namespace App\Http\Controllers;

use App\Models\DungLuong_Mau;
use App\Models\SanPham;
use App\Models\LoaiSanPham;
use App\Models\HangSanXuat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Imports\SanPhamImport;
use App\Imports\MauSanPhamImport;
use App\Imports\DungLuongMauImport;
use App\Exports\SanPhamExport;
use App\Models\MauSanPham;
use App\Exports\DungLuongMauExport;
use App\Models\FormMau;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class SanPhamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getDanhSach()
    {
        $tensanpham = '';
        $selectdata = LoaiSanPham::all();
        $sanpham = SanPham::paginate(15);

        return view('admin.sanpham.danhsach', compact('sanpham', 'selectdata'));
    }

    public function postSanPham(Request $request)
    {
        if ($request->sapxep == 'default') {
            $sanpham = SanPham::all()->paginate(16);
            // Ghi vào SESSION
            session()->put('sapxep', 'default');
        } else {
            $sanpham = SanPham::where('loaisanpham_id', $request->sapxep)->paginate(16);
            session()->put('sapxep', 'danhmuc');
        }

        $selectdata = LoaiSanPham::all();
        $mausanpham = MauSanPham::all();
        return view('admin.sanpham.danhsach', compact('sanpham', 'selectdata', 'mausanpham'));
    }
    public function getThem()
    {
        $loaisanpham = LoaiSanPham::all();
        $hangsanxuat = HangSanXuat::all();
        $form = FormMau::all();

        return view('admin.sanpham.them', compact('loaisanpham', 'hangsanxuat', 'form'));
    }

    public function postThem(Request $request)
    {
        $this->validate($request, [
            'loaisanpham_id' => ['required'],
            'hangsanxuat_id' => ['required'],
            'tensanpham' => ['required', 'string', 'max:191', 'unique:sanpham'],
            'dongia' => ['required', 'numeric'],
            'hinhanh' => ['nullable', 'image', 'max:2048'],
            'hinhanhmota' => ['nullable', 'max:2048'],
            'motasanpham' => ['nullable'],
            'thongsokythuat' => ['nullable'],
        ]);

        // Kiểm tra tập tin rỗng hay không?
        if ($request->hasFile('hinhanh')) {
            $file = $request->file('hinhanh');
            // Tạo thư mục nếu chưa có
            $lsp = LoaiSanPham::find($request->loaisanpham_id);
            $path = public_path() . '/images/sanpham/' . $lsp->tenloai_slug;
            File::isDirectory($lsp->tenloai_slug) or File::makeDirectory($path, $mode = 0777, true, true);

            // Xác định tên tập tin
            $extension = $request->file('hinhanh')->extension();
            $filename = Str::slug($request->tensanpham, '-') . '.' . $extension;

            // Upload vào thư mục và trả về đường dẫn
            $pathImage = $lsp->tenloai_slug;
            $upload_path = public_path() . '/images/sanpham/' . $pathImage . '/';
            $image_url1 = $pathImage . '/' . $filename;

            $file->move($upload_path, $filename);
        }

        $image = array();
        if ($files = $request->file('hinhanhmota')) {
            foreach ($files as $file) {
                $lsp = LoaiSanPham::find($request->loaisanpham_id);
                File::isDirectory($lsp->tenloai_slug) or File::makeDirectory($path, $mode = 0777, true, true);

                //lay duoi tap tin
                $ext = strtolower($file->getClientOriginalExtension());
                $image_name = Str::slug($request->tensanpham, '-') . rand(1, 10);

                //lay ten + duoi tap tin cua anh
                $image_full_name = $image_name . '.' . $ext;

                //lay ten loai san pham de upload vao dung thu muc do
                $pathImage = $lsp->tenloai_slug;
                $upload_path = public_path() . '/images/sanpham/' . $pathImage . '/';

                //url day du = noi luu/(ten anh + duoi tap tin)
                $image_url = $pathImage . '/' . $image_full_name;

                //luu tap tin vao thu muc
                $file->move($upload_path, $image_full_name);

                //dung mang de chua url hinh anh
                $image[] = $image_url;
            }
        }

        $orm = new SanPham();
        $orm->loaisanpham_id = $request->loaisanpham_id;
        $orm->hangsanxuat_id = $request->hangsanxuat_id;
        $orm->tensanpham = $request->tensanpham;
        $orm->tensanpham_slug = Str::slug($request->tensanpham, '-');
        $orm->dongia = $request->dongia;
        $orm->hinhanh = $image_url1;
        if (!empty($image)) $orm->hinhanhmota = implode('|', $image);
        $orm->motasanpham = $request->motasanpham;
        $orm->thongsokythuat = $request->thongsokythuat;
        $orm->save();

        $sp = DB::select("SHOW TABLE STATUS LIKE 'sanpham'"); //Câu lệnh xem trạng thái của bảng
        $id_sp = $sp[0]->Auto_increment; //Lay id tiep theo

        if (isset($request->dungluong_id)) {
            for ($i = 0; $i < count($request->dungluong_id); $i++) {
                $var = 'dungluong_mau' . ($request->dungluong_id)[$i];
                for ($j = 0; $j <= count($request->$var) - 1; $j += 2) {
                    $dlm = new DungLuong_Mau();
                    $dlm->dungluong_id = ($request->dungluong_id)[$i];
                    $dlm->mau_id = ($request->$var)[$j];
                    $dlm->sanpham_id = $id_sp - 1;
                    $dlm->soluongton = ($request->$var)[$j + 1];
                    $dlm->save();
                }
            }
        } else {
            return redirect()->route('admin.sanpham.index')->with('error', 'Có lỗi khi thêm sản phẩm');
        }
        return redirect()->route('admin.sanpham.index')->with('success', 'Thêm sản phẩm thành công');
    }

    public function getSua($id)
    {
        $hangsanxuat = HangSanXuat::all();
        $sanpham = SanPham::find($id);
        $loaisanpham = LoaiSanPham::all();
        $form = FormMau::all();
        return view('admin.sanpham.sua', compact('sanpham', 'loaisanpham', 'hangsanxuat', 'form'));
    }

    public function postSua(Request $request, $id)
    {
        $this->validate($request, [
            'loaisanpham_id' => ['required'],
            'hangsanxuat_id' => ['required'],
            'tensanpham' => ['required', 'string', 'max:191', 'unique:sanpham,tensanpham,' . $id],
            'dongia' => ['required', 'numeric'],
            'hinhanh' => ['nullable', 'image', 'max:2048'],
            'hinhanhmota' => ['nullable', 'max:2048'],
            'motasanpham' => ['nullable'],
        ]);

        // Kiểm tra tập tin rỗng hay không?
        $path = '';
        $lsp = LoaiSanPham::find($request->loaisanpham_id);
        if ($request->hasFile('hinhanh')) {
            // Xóa tập tin cũ
            $file = $request->file('hinhanh');
            $sp = SanPham::find($id);
            File::delete(public_path() . '/' . $lsp->tenloai . '/' . $sp->hinhanh);
            $lsp = LoaiSanPham::find($request->loaisanpham_id);
            // Xác định tên tập tin mới
            $extension = $request->file('hinhanh')->extension();
            $filename = Str::slug($request->tensanpham, '-') . '.' . $extension;

            // Upload vào thư mục và trả về đường dẫn
            $pathImage = $lsp->tenloai_slug;
            $upload_path = public_path() . '/images/sanpham/' . $pathImage . '/';
            $image_url1 = $pathImage . '/' . $filename;

            $file->move($upload_path, $filename);
        }

        $image = array();
        if ($files = $request->file('hinhanhmota')) {
            $sp = SanPham::find($id);
            $hinhanhmota = explode('|', $sp->hinhanhmota);


            foreach ($hinhanhmota as $item) {
                File::delete(public_path() . '/' . $lsp->tenloai . '/' . $item);
            }
            foreach ($files as $file) {
                File::isDirectory($lsp->tenloai_slug) or File::makeDirectory($path, $mode = 0777, true, true);

                //lay duoi tap tin
                $ext = strtolower($file->getClientOriginalExtension());
                $image_name = Str::slug($request->tensanpham, '-') . rand(1, 10);

                //lay ten + duoi tap tin cua anh
                $image_full_name = $image_name . '.' . $ext;

                //lay ten loai san pham de upload vao dung thu muc do
                $pathImage = $lsp->tenloai_slug;
                $upload_path = public_path() . '/images/sanpham/' . $pathImage . '/';

                //url day du = noi luu/(ten anh + duoi tap tin)
                $image_url = $pathImage . '/' . $image_full_name;

                //luu tap tin vao thu muc
                $file->move($upload_path, $image_full_name);

                //dung mang de chua url hinh anh
                $image[] = $image_url;
            }
        }

        $orm = SanPham::find($id);
        $orm->loaisanpham_id = $request->loaisanpham_id;
        $orm->hangsanxuat_id = $request->hangsanxuat_id;
        $orm->tensanpham = $request->tensanpham;
        $orm->tensanpham_slug = Str::slug($request->tensanpham, '-');
        $orm->dongia = $request->dongia;
        if (!empty($image_url1)) $orm->hinhanh = $image_url1;
        if (!empty($image)) $orm->hinhanhmota = implode('|', $image);
        $orm->motasanpham = $request->motasanpham;
        $orm->thongsokythuat = $request->thongsokythuat;
        $orm->save();

        return redirect()->route('admin.sanpham.index')->with('success', 'Cập nhật sản phẩm thành công');
    }

    public function getXoa($id)
    {
        $orm = SanPham::find($id);
        $orm->delete();

        // Xóa tập tin khi xóa sản phẩm
        Storage::delete($orm->hinhanh);

        return redirect()->route('admin.sanpham.index');
    }

    public function postNhap(Request $request)
    {
        Excel::import(new SanPhamImport, $request->file('file_excel'));
        return redirect()->route('admin.sanpham.index')->with('success', 'Xóa sản phẩm thành công');
    }

    public function getXuat()
    {
        return Excel::download(new SanPhamExport, 'san-pham.xlsx');
    }


    public function getXuatDungLuongMau()
    {
        return Excel::download(new DungLuongMauExport, 'dung-luong-mau.xlsx');
    }

    public function postNhapDungLuongMau(Request $request)
    {
        Excel::import(new DungLuongMauImport(), $request->file('file_excel'));
        return redirect()->route('admin.sanpham.index')->with('success', 'Đã nhập dung lượng thành công');
    }
}
