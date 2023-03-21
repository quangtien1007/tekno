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
use Illuminate\Support\Facades\Auth;
// Đăng ký, đăng nhập, Quên mật khẩu
Auth::routes();

// Trang chủ
Route::get('/', [HomeController::class, 'getHome'])->name('client');
Route::get('/home', [HomeController::class, 'getHome'])->name('client');

Route::get('/detail', function () {
    return view('client.sanpham');
})->name('client.sanpham');

// // Trang sản phẩm
// Route::get('/san-pham', [HomeController::class, 'getSanPham'])->name('frontend.sanpham');
// Route::post('/san-pham', [HomeController::class, 'postSanPham'])->name('frontend.sanpham');
// Route::get('/san-pham/loai/{tenloai_slug}/', [HomeController::class, 'getSanPham'])->name('frontend.sanpham.danhmuc');
// Route::get('/san-pham/loai/{tenloai_slug}/{tenhang_slug}', [HomeController::class, 'getDanhMucChiTiet'])->name('frontend.sanpham.danhmucchitiet');
// Route::get('/san-pham/hang/{tenhang_slug}', [HomeController::class, 'getHangSanXuat'])->name('frontend.sanpham.hangsanxuat');
Route::get('/san-pham/{tenloai_slug}/{tensanpham_slug}', [HomeController::class, 'getSanPham_ChiTiet'])->name('client.sanpham.chitiet');

// // Trang giỏ hàng
// Route::get('/gio-hang', [HomeController::class, 'getGioHang'])->name('frontend.giohang');
Route::post('/gio-hang/them', [HomeController::class, 'postGioHang_Them'])->name('client.giohang.them');
// Route::get('/gio-hang/xoa', [HomeController::class, 'getGioHang_XoaTatCa'])->name('frontend.giohang.xoatatca');
Route::get('/gio-hang/xoa/{row_id}', [HomeController::class, 'getGioHang_Xoa'])->name('client.giohang.xoa');
// Route::get('/gio-hang/giam/{row_id}', [HomeController::class, 'getGioHang_Giam'])->name('frontend.giohang.giam');
// Route::get('/gio-hang/tang/{row_id}', [HomeController::class, 'getGioHang_Tang'])->name('frontend.giohang.tang');

// // Trang đặt hàng
Route::get('/dat-hang', [HomeController::class, 'getDatHang'])->name('client.dathang');
// Route::post('/vnpay-checkout', [PayPalController::class, 'vnPayCheckOut'])->name('frontend.vnpay');
// Route::post('/dat-hang', [HomeController::class, 'postDatHang'])->name('frontend.dathang');
// Route::get('/dat-hang-thanh-cong', [HomeController::class, 'getDatHangThanhCong'])->name('frontend.dathangthanhcong');
// Route::get('/dat-hang-error', [HomeController::class, 'getDatHangKhongThanhCong'])->name('frontend.dathangerror');

// //Trang bài viết
// Route::get('/bai-viet', [HomeController::class, 'getBaiViet'])->name('frontend.baiviet');
// Route::get('/bai-viet/{tieude_slug}', [HomeController::class, 'getBaiVietChiTiet'])->name('frontend.baivietchitiet');

// //paypal
// Route::get('/payment', [PayPalController::class, 'payment'])->name('payment');
// Route::get('/cancel', [PayPalController::class, 'cancel'])->name('payment.cancel');
// Route::get('/payment/success', [PayPalController::class, 'success'])->name('payment.success');

// // Liên hệ
// Route::get('/lien-he', [HomeController::class, 'getLienHe'])->name('frontend.lienhe');

// // Trang khách hàng
// Route::get('/khach-hang/dang-ky', [HomeController::class, 'getDangKy'])->name('user.dangky');
// Route::get('/khach-hang/dang-nhap', [HomeController::class, 'getDangNhap'])->name('user.dangnhap');

// // Trang tài khoản khách hàng
// Route::prefix('khach-hang')->group(function () {
// 	// Trang chủ tài khoản khách hàng
// 	Route::get('/', [UserController::class, 'getHome'])->name('user');

// 	// Xem và cập nhật trạng thái đơn hàng
// 	Route::get('/don-hang/{id}', [UserController::class, 'getDonHang'])->name('user.index');
// 	// Route::post('/don-hang/{id}', [UserController::class, 'postDonHang'])->name('user.donhang');

// 	// Cập nhật thông tin tài khoản
// 	Route::post('/cap-nhat-ho-so', [NguoiDungController::class, 'postSua'])->name('user.capnhathoso');
// });

// Trang tài khoản quản lý
Route::prefix('admin')->middleware('admin-check')->group(function () {
    // Trang chủ tài khoản quản lý
    Route::get('/', [AdminController::class, 'getHome'])->name('admin');
    Route::get('/home', [AdminController::class, 'getHome'])->name('admin');

    // Quản lý Loại sản phẩm
    Route::get('/loaisanpham', [LoaiSanPhamController::class, 'getDanhSach'])->name('admin.loaisanpham');
    Route::get('/loaisanpham/them', [LoaiSanPhamController::class, 'getThem'])->name('admin.loaisanpham.them');
    Route::post('/loaisanpham/them', [LoaiSanPhamController::class, 'postThem'])->name('admin.loaisanpham.them');
    Route::get('/loaisanpham/sua/{id}', [LoaiSanPhamController::class, 'getSua'])->name('admin.loaisanpham.sua');
    Route::post('/loaisanpham/sua/{id}', [LoaiSanPhamController::class, 'postSua'])->name('admin.loaisanpham.sua');
    Route::get('/loaisanpham/xoa/{id}', [LoaiSanPhamController::class, 'getXoa'])->name('admin.loaisanpham.xoa');

    // Quản lý Hãng sản xuất
    Route::get('/hangsanxuat', [HangSanXuatController::class, 'getDanhSach'])->name('admin.hangsanxuat');
    Route::get('/hangsanxuat/them', [HangSanXuatController::class, 'getThem'])->name('admin.hangsanxuat.them');
    Route::post('/hangsanxuat/them', [HangSanXuatController::class, 'postThem'])->name('admin.hangsanxuat.them');
    Route::get('/hangsanxuat/sua/{id}', [HangSanXuatController::class, 'getSua'])->name('admin.hangsanxuat.sua');
    Route::post('/hangsanxuat/sua/{id}', [HangSanXuatController::class, 'postSua'])->name('admin.hangsanxuat.sua');
    Route::get('/hangsanxuat/xoa/{id}', [HangSanXuatController::class, 'getXoa'])->name('admin.hangsanxuat.xoa');
    Route::post('/hangsanxuat/nhap', [HangSanXuatController::class, 'postNhap'])->name('admin.hangsanxuat.nhap');
    Route::get('/hangsanxuat/xuat', [HangSanXuatController::class, 'getXuat'])->name('admin.hangsanxuat.xuat');

    // Quản lý Tình trạng
    Route::get('/tinhtrang', [TinhTrangController::class, 'getDanhSach'])->name('admin.tinhtrang');
    Route::get('/tinhtrang/them', [TinhTrangController::class, 'getThem'])->name('admin.tinhtrang.them');
    Route::post('/tinhtrang/them', [TinhTrangController::class, 'postThem'])->name('admin.tinhtrang.them');
    Route::get('/tinhtrang/sua/{id}', [TinhTrangController::class, 'getSua'])->name('admin.tinhtrang.sua');
    Route::post('/tinhtrang/sua/{id}', [TinhTrangController::class, 'postSua'])->name('admin.tinhtrang.sua');
    Route::get('/tinhtrang/xoa/{id}', [TinhTrangController::class, 'getXoa'])->name('admin.tinhtrang.xoa');

    // Quản lý Sản phẩm
    Route::get('/sanpham', [SanPhamController::class, 'getDanhSach'])->name('admin.sanpham');
    Route::post('/sanpham', [SanPhamController::class, 'postSanPham'])->name('admin.sanpham');
    Route::get('/sanpham/them', [SanPhamController::class, 'getThem'])->name('admin.sanpham.them');
    Route::post('/sanpham/them', [SanPhamController::class, 'postThem'])->name('admin.sanpham.them');
    Route::get('/sanpham/sua/{id}', [SanPhamController::class, 'getSua'])->name('admin.sanpham.sua');
    Route::post('/sanpham/sua/{id}', [SanPhamController::class, 'postSua'])->name('admin.sanpham.sua');
    Route::get('/sanpham/xoa/{id}', [SanPhamController::class, 'getXoa'])->name('admin.sanpham.xoa');
    Route::post('/sanpham/nhap', [SanPhamController::class, 'postNhap'])->name('admin.sanpham.nhap');
    Route::post('/sanpham/nhapmau', [SanPhamController::class, 'postNhapMau'])->name('admin.mausanpham.nhap');
    Route::post('/sanpham/nhapdl', [SanPhamController::class, 'postNhapDungLuong'])->name('admin.dlsanpham.nhap');
    Route::get('/sanpham/xuat', [SanPhamController::class, 'getXuat'])->name('admin.sanpham.xuat');

    // Quản lý Đơn hàng
    Route::get('/donhang', [DonHangController::class, 'getDanhSach'])->name('admin.donhang');
    Route::get('/donhang/them', [DonHangController::class, 'getThem'])->name('admin.donhang.them');
    Route::post('/donhang/them', [DonHangController::class, 'postThem'])->name('admin.donhang.them');
    Route::get('/donhang/sua/{id}', [DonHangController::class, 'getSua'])->name('admin.donhang.sua');
    Route::post('/donhang/sua/{id}', [DonHangController::class, 'postSua'])->name('admin.donhang.sua');
    Route::get('/donhang/xoa/{id}', [DonHangController::class, 'getXoa'])->name('admin.donhang.xoa');

    // Quản lý Đơn hàng chi tiết
    Route::get('/donhang/chitiet', [DonHangChiTietController::class, 'getDanhSach'])->name('admin.donhang.chitiet');
    Route::get('/donhang/chitiet/sua/{id}', [DonHangChiTietController::class, 'getSua'])->name('admin.donhang.chitiet.sua');
    Route::post('/donhang/chitiet/sua/{id}', [DonHangChiTietController::class, 'postSua'])->name('admin.donhang.chitiet.sua');
    Route::get('/donhang/chitiet/xoa/{id}', [DonHangChiTietController::class, 'getXoa'])->name('admin.donhang.chitiet.xoa');

    // Quản lý Tài khoản người dùng
    Route::get('/nguoidung', [NguoiDungController::class, 'getDanhSach'])->name('admin.nguoidung');
    Route::get('/nguoidung/them', [NguoiDungController::class, 'getThem'])->name('admin.nguoidung.them');
    Route::post('/nguoidung/them', [NguoiDungController::class, 'postThem'])->name('admin.nguoidung.them');
    Route::get('/nguoidung/sua/{id}', [NguoiDungController::class, 'getSua'])->name('admin.nguoidung.sua');
    Route::post('/nguoidung/sua/{id}', [NguoiDungController::class, 'postSua'])->name('admin.nguoidung.sua');
    Route::get('/nguoidung/xoa/{id}', [NguoiDungController::class, 'getXoa'])->name('admin.nguoidung.xoa');

    //Quản lý bài viết
    Route::get('/baiviet', [BaiVietController::class, 'getDanhSach'])->name('admin.baiviet');
    Route::get('/baiviet/them', [BaiVietController::class, 'getThem'])->name('admin.baiviet.them');
    Route::post('/baiviet/them', [BaiVietController::class, 'postThem'])->name('admin.baiviet.them');
    Route::get('/baiviet/sua/{id}', [BaiVietController::class, 'getSua'])->name('admin.baiviet.sua');
    Route::post('/baiviet/sua/{id}', [BaiVietController::class, 'postSua'])->name('admin.baiviet.sua');
    Route::get('/baiviet/xoa/{id}', [BaiVietController::class, 'getXoa'])->name('admin.baiviet.xoa');
});
