<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoaiSanPhamController;
use App\Http\Controllers\HangSanXuatController;
use App\Http\Controllers\TinhTrangController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\DonHangChiTietController;
use App\Http\Controllers\NguoiDungController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\InboxController;
use Illuminate\Support\Facades\Auth;

// Đăng ký, đăng nhập, Quên mật khẩu
Auth::routes();
// Route::head() Route::prefix('admin')->middleware('admin-check')->group(function () {

// Trang chủ
Route::get('/', [HomeController::class, 'getHome'])->name('client');
Route::get('/home', [HomeController::class, 'getHome'])->name('client');

Route::get('/getMauTheoDungLuong/{id}/{spid}', [HomeController::class, 'getMauTheoDungLuong']);
// Trang sản phẩm
Route::get('san-pham', [HomeController::class, 'getSanPham'])->name('client.sanpham');
Route::post('/san-pham', [HomeController::class, 'postSanPham'])->name('client.sanpham.search');
Route::get('/san-pham/loai/{tenloai_slug}/', [HomeController::class, 'getSanPham'])->name('client.sanpham.danhmuc');
Route::get('/san-pham/loai/{tenloai_slug}/{tenhang_slug}', [HomeController::class, 'getDanhMucChiTiet'])->name('client.sanpham.danhmucchitiet');
Route::get('/san-pham/{tenloai_slug}/{tensanpham_slug}', [HomeController::class, 'getSanPham_ChiTiet'])->name('client.sanpham.chitiet');
Route::post('/so-sanh', [HomeController::class, 'postSoSanh'])->name('client.sosanh.sanpham');

// Trang giỏ hàng
Route::get('/gio-hang', [HomeController::class, 'getGioHang'])->name('client.giohang');
Route::post('/gio-hang/them', [HomeController::class, 'postGioHang_Them'])->name('client.giohang.add');
Route::get('/gio-hang/xoa', [HomeController::class, 'getGioHang_XoaTatCa'])->name('client.giohang.destroy');
Route::get('/gio-hang/xoa/{row_id}', [HomeController::class, 'getGioHang_Xoa'])->name('client.giohang.delete');
Route::get('/gio-hang/giam/{row_id}', [HomeController::class, 'getGioHang_Giam'])->name('client.giohang.down');
Route::get('/gio-hang/tang/{row_id}', [HomeController::class, 'getGioHang_Tang'])->name('client.giohang.up');

// Trang đặt hàng
Route::get('/dat-hang', [HomeController::class, 'getDatHang'])->name('client.dathang.create');
Route::post('/dat-hang', [HomeController::class, 'postDatHang'])->name('client.dathang.add');
Route::get('/dat-hang-thanh-cong', [HomeController::class, 'getDatHangThanhCong'])->name('client.dathang.success');
Route::get('/dat-hang-error', [HomeController::class, 'getDatHangKhongThanhCong'])->name('client.dathang.error');

//Trang bài viết
Route::get('/bai-viet', [HomeController::class, 'getBaiViet'])->name('client.baiviet');
Route::get('/bai-viet/{tieude_slug}', [HomeController::class, 'getBaiVietChiTiet'])->name('client.baiviet.chitiet');

//Paypal
Route::get('/payment', [PayPalController::class, 'payment'])->name('payment');
Route::get('/cancel', [PayPalController::class, 'cancel'])->name('payment.cancel');
Route::get('/payment/success', [PayPalController::class, 'success'])->name('payment.success');

//Xem đơn hàng chi tiết
Route::get('/donhang-chitiet/{donhang_id}', [DonHangChiTietController::class, 'getDonHangChiTiet'])->name('client.donhang.chitiet');

// Liên hệ
Route::get('lien-he', [HomeController::class, 'getLienHe'])->name('client.lienhe');

//Đánh giá sản phẩm
Route::post('/danh-gia', [DanhGiaController::class, 'postDanhGia'])->name('client.danhgia');

//Sản phẩm yêu thích
Route::get('/yeu-thich', function () {
    $tenloai = "Yêu thích";
    return view('client.yeuthich', compact('tenloai'));
})->name('client.yeuthich');

// // Trang khách hàng
Route::get('/khach-hang/dang-ky', [HomeController::class, 'getDangKy'])->name('user.dangky');
Route::get('/khach-hang/dang-nhap', [HomeController::class, 'getDangNhap'])->name('user.dangnhap');

// Trang tài khoản khách hàng
Route::prefix('khach-hang')->group(function () {
    // Trang chủ tài khoản khách hàng
    Route::get('/', [UserController::class, 'getHome'])->name('user');

    // Xem và cập nhật trạng thái đơn hàng
    Route::get('/don-hang/{id}', [UserController::class, 'getDonHang'])->name('user.index');
    Route::post('/don-hang/{id}', [UserController::class, 'postDonHang'])->name('user.donhang');

    // Cập nhật thông tin tài khoản
    Route::post('/cap-nhat-ho-so', [NguoiDungController::class, 'postSua'])->name('user.capnhathoso');
});

//Chat realtime/ livewire
Route::group(['middleware' => 'user'], function () {
    Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index'); //admin.inbox.index
    Route::get('/inbox/{id}', [InboxController::class, 'show'])->name('inbox.show'); //admin.inbox.show
});

// Trang tài khoản quản lý
Route::prefix('admin')->middleware('admin-check')->group(function () {
    // Trang chủ tài khoản quản lý
    Route::get('/', [AdminController::class, 'getHome'])->name('admin');
    // Route::get('/home', [AdminController::class, 'getHome'])->name('admin');

    // Quản lý Loại sản phẩm
    Route::get('/loaisanpham', [LoaiSanPhamController::class, 'getDanhSach'])->name('admin.loaisanpham');
    Route::get('/loaisanpham/them', [LoaiSanPhamController::class, 'getThem'])->name('admin.loaisanpham.create');
    Route::post('/loaisanpham/them', [LoaiSanPhamController::class, 'postThem'])->name('admin.loaisanpham.add');
    Route::get('/loaisanpham/sua/{id}', [LoaiSanPhamController::class, 'getSua'])->name('admin.loaisanpham.edit');
    Route::post('/loaisanpham/sua/{id}', [LoaiSanPhamController::class, 'postSua'])->name('admin.loaisanpham.update');
    Route::get('/loaisanpham/xoa/{id}', [LoaiSanPhamController::class, 'getXoa'])->name('admin.loaisanpham.delete');

    // Quản lý Hãng sản xuất
    Route::get('/hangsanxuat', [HangSanXuatController::class, 'getDanhSach'])->name('admin.hangsanxuat');
    Route::get('/hangsanxuat/them', [HangSanXuatController::class, 'getThem'])->name('admin.hangsanxuat.create');
    Route::post('/hangsanxuat/them', [HangSanXuatController::class, 'postThem'])->name('admin.hangsanxuat.add');
    Route::get('/hangsanxuat/sua/{id}', [HangSanXuatController::class, 'getSua'])->name('admin.hangsanxuat.edit');
    Route::post('/hangsanxuat/sua/{id}', [HangSanXuatController::class, 'postSua'])->name('admin.hangsanxuat.update');
    Route::get('/hangsanxuat/xoa/{id}', [HangSanXuatController::class, 'getXoa'])->name('admin.hangsanxuat.delete');
    Route::post('/hangsanxuat/nhap', [HangSanXuatController::class, 'postNhap'])->name('admin.hangsanxuat.import');
    Route::get('/hangsanxuat/xuat', [HangSanXuatController::class, 'getXuat'])->name('admin.hangsanxuat.export');

    // Quản lý Tình trạng
    Route::get('/tinhtrang', [TinhTrangController::class, 'getDanhSach'])->name('admin.tinhtrang');
    Route::get('/tinhtrang/them', [TinhTrangController::class, 'getThem'])->name('admin.tinhtrang.create');
    Route::post('/tinhtrang/them', [TinhTrangController::class, 'postThem'])->name('admin.tinhtrang.add');
    Route::get('/tinhtrang/sua/{id}', [TinhTrangController::class, 'getSua'])->name('admin.tinhtrang.edit');
    Route::post('/tinhtrang/sua/{id}', [TinhTrangController::class, 'postSua'])->name('admin.tinhtrang.update');
    Route::get('/tinhtrang/xoa/{id}', [TinhTrangController::class, 'getXoa'])->name('admin.tinhtrang.delete');

    // Quản lý Sản phẩm
    Route::get('/sanpham', [SanPhamController::class, 'getDanhSach'])->name('admin.sanpham');
    Route::post('/sanpham', [SanPhamController::class, 'postSanPham'])->name('admin.sanpham.sort');
    Route::get('/sanpham/them', [SanPhamController::class, 'getThem'])->name('admin.sanpham.create');
    Route::post('/sanpham/them', [SanPhamController::class, 'postThem'])->name('admin.sanpham.add');
    Route::get('/sanpham/sua/{id}', [SanPhamController::class, 'getSua'])->name('admin.sanpham.edit');
    Route::post('/sanpham/sua/{id}', [SanPhamController::class, 'postSua'])->name('admin.sanpham.update');
    Route::get('/sanpham/xoa/{id}', [SanPhamController::class, 'getXoa'])->name('admin.sanpham.delete');
    Route::post('/sanpham/nhap', [SanPhamController::class, 'postNhap'])->name('admin.sanpham.import');
    Route::post('/sanpham/nhapdlmau', [SanPhamController::class, 'postNhapDungLuongMau'])->name('admin.dlmau.import');
    Route::get('/sanpham/xuat', [SanPhamController::class, 'getXuat'])->name('admin.sanpham.export');
    Route::get('/sanpham/xuatdlmau', [SanPhamController::class, 'getXuatDungLuongMau'])->name('admin.dungluongmau.export');

    // Quản lý Đơn hàng
    Route::get('/donhang', [DonHangController::class, 'getDanhSach'])->name('admin.donhang');
    Route::get('/donhang/them', [DonHangController::class, 'getThem'])->name('admin.donhang.create');
    Route::post('/donhang/them', [DonHangController::class, 'postThem'])->name('admin.donhang.add');
    Route::get('/donhang/sua/{id}', [DonHangController::class, 'getSua'])->name('admin.donhang.edit');
    Route::post('/donhang/sua/{id}', [DonHangController::class, 'postSua'])->name('admin.donhang.update');
    Route::get('/donhang/xoa/{id}', [DonHangController::class, 'getXoa'])->name('admin.donhang.delete');
    Route::get('/donhang/hoadon/{donhang_id}', [DonHangController::class, 'getInDonHang'])->name('admin.donhang.hoadon');

    // Quản lý Đơn hàng chi tiết
    Route::get('/donhang/chitiet', [DonHangChiTietController::class, 'getDanhSach'])->name('admin.donhang.chitiet');
    Route::get('/donhang/chitiet/sua/{id}', [DonHangChiTietController::class, 'getSua'])->name('admin.donhang.chitiet.edit');
    Route::post('/donhang/chitiet/sua/{id}', [DonHangChiTietController::class, 'postSua'])->name('admin.donhang.chitiet.update');
    Route::get('/donhang/chitiet/xoa/{id}', [DonHangChiTietController::class, 'getXoa'])->name('admin.donhang.chitiet.delete');

    // Quản lý Tài khoản người dùng
    Route::get('/nguoidung', [NguoiDungController::class, 'getDanhSach'])->name('admin.nguoidung');
    Route::get('/nguoidung/them', [NguoiDungController::class, 'getThem'])->name('admin.nguoidung.create');
    Route::post('/nguoidung/them', [NguoiDungController::class, 'postThem'])->name('admin.nguoidung.add');
    Route::get('/nguoidung/sua/{id}', [NguoiDungController::class, 'getSua'])->name('admin.nguoidung.edit');
    Route::post('/nguoidung/sua/{id}', [NguoiDungController::class, 'postSua'])->name('admin.nguoidung.update');
    Route::get('/nguoidung/xoa/{id}', [NguoiDungController::class, 'getXoa'])->name('admin.nguoidung.delete');

    //Quản lý bài viết
    Route::get('/baiviet', [BaiVietController::class, 'getDanhSach'])->name('admin.baiviet');
    Route::get('/baiviet/them', [BaiVietController::class, 'getThem'])->name('admin.baiviet.create');
    Route::post('/baiviet/them', [BaiVietController::class, 'postThem'])->name('admin.baiviet.add');
    Route::get('/baiviet/sua/{id}', [BaiVietController::class, 'getSua'])->name('admin.baiviet.edit');
    Route::post('/baiviet/sua/{id}', [BaiVietController::class, 'postSua'])->name('admin.baiviet.update');
    Route::get('/baiviet/xoa/{id}', [BaiVietController::class, 'getXoa'])->name('admin.baiviet.delete');
});
