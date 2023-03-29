<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\LoaiSanPham;
use App\Models\HangSanXuat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Imports\SanPhamImport;
use App\Imports\MauSanPhamImport;
use App\Imports\DungLuongSanPhamImport;
use App\Exports\SanPhamExport;
use App\Models\MauSanPham;
use App\Models\DungLuongSanPham;
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
        return view('admin.sanpham.them', compact('loaisanpham', 'hangsanxuat'));
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
        ]);

        // Kiểm tra tập tin rỗng hay không?
        if ($request->hasFile('hinhanh')) {
            $file = $request->file('hinhanh');
            // Tạo thư mục nếu chưa có
            $lsp = LoaiSanPham::find($request->loaisanpham_id);
            File::isDirectory($lsp->tenloai_slug) or Storage::makeDirectory('sanpham/' . $lsp->tenloai_slug, 0775);

            // Xác định tên tập tin
            $extension = $request->file('hinhanh')->extension();
            $filename = Str::slug($request->tensanpham, '-') . '.' . $extension;

            // Upload vào thư mục và trả về đường dẫn
            $pathImage = $lsp->tenloai_slug;
            $upload_path = 'storage/app/sanpham/' . $pathImage . '/';
            $image_url1 = $pathImage . '/' . $filename;

            $file->move($upload_path, $filename);
        }

        $image = array();
        if ($files = $request->file('hinhanhmota')) {
            foreach ($files as $file) {
                $lsp = LoaiSanPham::find($request->loaisanpham_id);
                File::isDirectory($lsp->tenloai_slug) or Storage::makeDirectory($lsp->tenloai_slug, 0775);

                //lay duoi tap tin
                $ext = strtolower($file->getClientOriginalExtension());
                $image_name = Str::slug($request->tensanpham, '-') . rand(1, 10);

                //lay ten + duoi tap tin cua anh
                $image_full_name = $image_name . '.' . $ext;

                //lay ten loai san pham de upload vao dung thu muc do
                $pathImage = $lsp->tenloai_slug;
                $upload_path = 'storage/app/sanpham/' . $pathImage . '/';

                //url day du = noi luu/(ten anh + duoi tap tin)
                $image_url = $upload_path . $image_full_name;

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
        $orm->save();

        $sp = DB::select("SHOW TABLE STATUS LIKE 'sanpham'"); //Câu lệnh xem trạng thái của bảng
        $id_sp = $sp[0]->Auto_increment; //Lay id tiep theo

        $msp = DB::select("SHOW TABLE STATUS LIKE 'mausanpham'"); //Câu lệnh xem trạng thái của bảng
        $id_msp = $msp[0]->Auto_increment;

        $msp = DB::select("SHOW TABLE STATUS LIKE 'mausanpham'"); //Câu lệnh xem trạng thái của bảng
        $id_dlsp = $msp[0]->Auto_increment;
        // dd($id_msp);

        $msp = new MauSanPham();
        for ($i = 0; $i <= count($request->mausanpham) - 2; $i += 3) {
            //chạy từ 0 tới tổng sl ptu trong mảng trừ đi 2, với bước nhảy là 3
            if ($id_sp == 1) {
                $idsp = $id_sp;
            } else {
                $idsp = $id_sp - 1;
                //Lấy id tự động tăng tiếp theo và trừ 1 sẽ ra id hiện tại của sản phẩm vừa thêm
            }
            //                          0  1   2   3    4   5    6    7  8
            //ví dụ về ptu trong mảng [do,200,0.4,vang,100,0.3,trang,10,0.2]
            //count($request->mausanpham) sẽ bằng 8 - 2 = 6, khi đó ta sẽ thực hiện được 3 vòng lặp
            // $i=0 là 1 vòng, $i=3 là 2 vòng, $i=6 là 3 vòng và khi $i=9 thì sẽ ngừng
            //$i=0 sẽ lấy được mausanpham[0]='do',mausanpham[1]='200',mausanpham[3]='0.4' và tiếp tục
            $msp->id = $id_msp;
            $msp->sanpham_id = $idsp;
            $msp->mau = $request->mausanpham[$i];
            $msp->soluongton = $request->mausanpham[$i + 1];
            $msp->giatrimau = $request->mausanpham[$i + 2];
            // dd($msp);
            $msp->save();
        }

        $dlsp = new DungLuongSanPham();
        for ($i = 0; $i <= count($request->dungluong) - 2; $i += 3) {
            //chạy từ 0 tới tổng sl ptu trong mảng trừ đi 2, với bước nhảy là 3
            if ($id_sp == 1) {
                $idsp = $id_sp;
            } else {
                $idsp = $id_sp - 1;
                //Lấy id tự động tăng tiếp theo và trừ 1 sẽ ra id hiện tại của sản phẩm vừa thêm
            }
            //                          0  1   2   3    4   5    6    7  8
            //ví dụ về ptu trong mảng [do,200,0.4,vang,100,0.3,trang,10,0.2]
            //count($request->dungluong) sẽ bằng 8 - 2 = 6, khi đó ta sẽ thực hiện được 3 vòng lặp
            // $i=0 là 1 vòng, $i=3 là 2 vòng, $i=6 là 3 vòng và khi $i=9 thì sẽ ngừng
            //$i=0 sẽ lấy được dungluong[0]='do',dungluong[1]='200',dungluong[3]='0.4' và tiếp tục
            $dlsp->id = $id_dlsp;
            $dlsp->sanpham_id = $idsp;
            $dlsp->dungluong = $request->dungluong[$i];
            $dlsp->soluongton = $request->dungluong[$i + 1];
            $dlsp->giatridungluong = $request->dungluong[$i + 2];
            // dd($msp);
            $dlsp->save();
        }
        // dd($msp);

        return redirect()->route('admin.sanpham')->with('success', 'Thêm sản phẩm thành công');
    }

    public function getSua($id)
    {
        $hangsanxuat = HangSanXuat::all();
        $sanpham = SanPham::find($id);
        $loaisanpham = LoaiSanPham::all();
        return view('admin.sanpham.sua', compact('sanpham', 'loaisanpham', 'hangsanxuat'));
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
        if ($request->hasFile('hinhanh')) {
            // Xóa tập tin cũ
            $sp = SanPham::find($id);
            Storage::delete($sp->hinhanh);

            // Xác định tên tập tin mới
            $extension = $request->file('hinhanh')->extension();
            $filename = Str::slug($request->tensanpham, '-') . '.' . $extension;

            // Upload vào thư mục và trả về đường dẫn
            $lsp = LoaiSanPham::find($request->loaisanpham_id);
            $path = Storage::putFileAs($lsp->tenloai_slug, $request->file('hinhanh'), $filename);
        }

        $image = array();
        if ($files = $request->file('hinhanhmota')) {
            foreach ($files as $file) {
                $lsp = LoaiSanPham::find($request->loaisanpham_id);
                File::isDirectory($lsp->tenloai_slug) or Storage::makeDirectory($lsp->tenloai_slug, 0775);
                $ext = strtolower($file->getClientOriginalExtension());
                $image_name = Str::slug($request->tensanpham, '-') . rand(10, 10000);
                $image_full_name = $image_name . '.' . $ext;
                $pathImage = $lsp->tenloai_slug;
                $upload_path = 'storage/app/' . $pathImage . '/';
                $image_url = $upload_path . $image_full_name;
                $file->move($upload_path, $image_full_name);
                $image[] = $image_url;
            }
        }

        $orm = SanPham::find($id);
        $orm->loaisanpham_id = $request->loaisanpham_id;
        $orm->hangsanxuat_id = $request->hangsanxuat_id;
        $orm->tensanpham = $request->tensanpham;
        $orm->tensanpham_slug = Str::slug($request->tensanpham, '-');
        $orm->dongia = $request->dongia;
        if (!empty($path)) $orm->hinhanh = $path;
        if (!empty($image)) $orm->hinhanhmota = implode('|', $image);
        $orm->motasanpham = $request->motasanpham;
        $orm->save();
        // $orm->mausanpham = implode('|', $request->mausanpham);
        // $orm->dungluong = implode('|', $request->dungluong);

        //bang mausanpham va dungluongsanpham
        //Lấy id tự động tăng tiếp theo và trừ 1 sẽ ra id hiện tại của sản phẩm vừa thêm
        // $sp = DB::select("SHOW TABLE STATUS LIKE 'sanpham'"); //Câu lệnh xem trạng thái của bảng
        // $id_sp = $sp[0]->Auto_increment;

        // $msp = MauSanPham::find($id);
        // for ($i = 0; $i <= count($request->mausanpham) - 2; $i += 3) {
        // 	//chạy từ 0 tới tổng sl ptu trong mảng trừ đi 2, với bước nhảy là 3
        // 	if ($id_sp == 1) {
        // 		$idsp = $id_sp;
        // 	} else {
        // 		$idsp = $id_sp - 1;
        // 		//Lấy id tự động tăng tiếp theo và trừ 1 sẽ ra id hiện tại của sản phẩm vừa thêm
        // 	}
        // 	//                          0  1   2   3    4   5    6    7  8
        // 	//ví dụ về ptu trong mảng [do,200,0.4,vang,100,0.3,trang,10,0.2]
        // 	//count($request->mausanpham) sẽ bằng 8 - 2 = 6, khi đó ta sẽ thực hiện được 3 vòng lặp
        // 	// $i=0 là 1 vòng, $i=3 là 2 vòng, $i=6 là 3 vòng và khi $i=9 thì sẽ ngừng
        // 	//$i=0 sẽ lấy được mausanpham[0]='do',mausanpham[1]='200',mausanpham[3]='0.4' và tiếp tục
        // 	$mau = $request->mausanpham[$i];
        // 	$slt = $request->mausanpham[$i + 1];
        // 	$gtm = $request->mausanpham[$i + 2];
        // 	date_default_timezone_set('Asia/Ho_Chi_Minh');
        // 	$currentTime = date("m-d-y H:i:s", time());
        // 	DB::insert('insert into mausanpham (sanpham_id,mau,soluongton,giatrimau,created_at,updated_at)
        // 				 values (?, ?, ?, ?, ?, ?)', [$idsp, $mau, $slt, $gtm, $currentTime, $currentTime]);
        // }

        // $dlsp = new DungLuongSanPham();
        // for ($i = 0; $i <= count($request->dungluong) - 2; $i += 3) {
        // 	//chạy từ 0 tới tổng sl ptu trong mảng trừ đi 2, với bước nhảy là 3
        // 	if ($id_sp == 1) {
        // 		$idsp = $id_sp;
        // 	} else {
        // 		$idsp = $id_sp - 1;
        // 		//Lấy id tự động tăng tiếp theo và trừ 1 sẽ ra id hiện tại của sản phẩm vừa thêm
        // 	}
        // 	//                          0  1   2   3    4   5    6    7  8
        // 	//ví dụ về ptu trong mảng [do,200,0.4,vang,100,0.3,trang,10,0.2]
        // 	//count($request->mausanpham) sẽ bằng 8 - 2 = 6, khi đó ta sẽ thực hiện được 3 vòng lặp
        // 	// $i=0 là 1 vòng, $i=3 là 2 vòng, $i=6 là 3 vòng và khi $i=9 thì sẽ ngừng
        // 	//$i=0 sẽ lấy được mausanpham[0]='do',mausanpham[1]='200',mausanpham[3]='0.4' và tiếp tục
        // 	$dl = $request->dungluong[$i];
        // 	$slt1 = $request->dungluong[$i + 1];
        // 	$gtdl = $request->dungluong[$i + 2];
        // 	date_default_timezone_set('Asia/Ho_Chi_Minh');
        // 	$currentTime = date("m-d-y H:i:s", time());
        // 	DB::insert('update dungluongsanpham (sanpham_id,dungluong,soluongton,giatridungluong,created_at,updated_at)
        // 				 values (?, ?, ?, ?, ?, ?)', [$idsp, $dl, $slt1, $gtdl, $currentTime, $currentTime]);
        // }
        // dd($msp);

        return redirect()->route('admin.sanpham')->with('success', 'Cập nhật sản phẩm thành công');
    }

    public function getXoa($id)
    {
        $orm = SanPham::find($id);
        $orm->delete();

        // Xóa tập tin khi xóa sản phẩm
        Storage::delete($orm->hinhanh);

        return redirect()->route('admin.sanpham');
    }

    public function postNhap(Request $request)
    {
        Excel::import(new SanPhamImport, $request->file('file_excel'));
        return redirect()->route('admin.sanpham')->with('success', 'Xóa sản phẩm thành công');
    }

    // public function getXuat()
    // {
    //     return Excel::download(new SanPhamExport, 'san-pham.xlsx');
    // }

    public function postNhapMau(Request $request)
    {
        Excel::import(new MauSanPhamImport, $request->file('file_excel'));
        return redirect()->route('admin.sanpham')->with('success', 'Đã nhập màu thành công!!!');
    }

    // public function getXuatMau()
    // {
    //     return Excel::download(new SanPhamExport, 'san-pham.xlsx');
    // }

    public function postNhapDungLuong(Request $request)
    {
        Excel::import(new DungLuongSanPhamImport(), $request->file('file_excel'));
        return redirect()->route('admin.sanpham')->with('success', 'Đã nhập dung lượng thành công');
    }
}
