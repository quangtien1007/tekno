<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
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
Route::get('/getDungLuongTheoSanPham/{id}', [DonHangController::class, 'getDungLuongTheoSanPham']);
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

    Route::prefix('quyen')->controller(RoleController::class)->middleware('role:admin')->name('admin.quyen.')->group(function () {
        Route::get('/', 'getDanhSach')->name('index');
        Route::get('/them', 'getThem')->name('create');
        Route::post('/them', 'postThem')->name('add');
        Route::get('/sua/{id}', 'getSua')->name('edit');
        Route::put('/sua/{id}', 'postSua')->name('update');
        Route::get('/xoa/{id}', 'getXoa')->name('delete');
    });

    // Quản lý Loại sản phẩm
    Route::prefix('loaisanpham')->controller(LoaiSanPhamController::class)->middleware('role:admin')->name('admin.loaisanpham.')->group(function () {
        Route::get('/', 'getDanhSach')->name('index');
        Route::get('/them', 'getThem')->name('create');
        Route::post('/them', 'postThem')->name('add');
        Route::get('/sua/{id}', 'getSua')->name('edit');
        Route::post('/sua/{id}', 'postSua')->name('update');
        Route::get('/xoa/{id}', 'getXoa')->name('delete');
    });

    // Quản lý Hãng sản xuất
    Route::prefix('hangsanxuat')->controller(HangSanXuatController::class)->name('admin.hangsanxuat.')->group(function () {
        Route::get('/', 'getDanhSach')->name('index');
        Route::get('/them', 'getThem')->name('create');
        Route::post('/them', 'postThem')->name('add');
        Route::get('/sua/{id}', 'getSua')->name('edit');
        Route::post('/sua/{id}', 'postSua')->name('update');
        Route::get('/xoa/{id}', 'getXoa')->name('delete');
        Route::post('/nhap', 'postNhap')->name('import');
        Route::get('/xuat', 'getXuat')->name('export');
    });

    // Quản lý Tình trạng
    Route::prefix('tinhtrang')->controller(TinhTrangController::class)->name('admin.tinhtrang.')->group(function () {
        Route::get('/', 'getDanhSach')->name('index')->middleware('role:admin');
        Route::get('/them', 'getThem')->name('create');
        Route::post('/them', 'postThem')->name('add');
        Route::get('/sua/{id}', 'getSua')->name('edit');
        Route::post('/sua/{id}', 'postSua')->name('update');
        Route::get('/xoa/{id}', 'getXoa')->name('delete');
    });

    // Quản lý Sản phẩm
    Route::prefix('sanpham')->controller(SanPhamController::class)->name('admin.sanpham.')->group(function () {
        Route::get('/', 'getDanhSach')->name('index');
        Route::post('/sapxep',  'postSanPham')->name('sort');
        Route::get('/them',  'getThem')->name('create');
        Route::post('/them',  'postThem')->name('add');
        Route::get('/sua/{id}',  'getSua')->name('edit');
        Route::post('/sua/{id}',  'postSua')->name('update');
        Route::get('/xoa/{id}',  'getXoa')->name('delete');
        Route::post('/nhap',  'postNhap')->name('import');
        Route::post('/nhapdlmau',  'postNhapDungLuongMau')->name('importdlmau');
        Route::get('/xuat',  'getXuat')->name('export');
        Route::get('/xuatdlmau',  'getXuatDungLuongMau')->name('exportdlmau');
    });

    // Quản lý Đơn hàng
    Route::prefix('donhang')->controller(DonHangController::class)->name('admin.donhang.')->group(function () {
        Route::get('/', 'getDanhSach')->name('index');
        Route::get('/them', 'getThem')->name('create');
        Route::post('/them', 'postThem')->name('add');
        Route::get('/sua/{id}', 'getSua')->name('edit');
        Route::post('/sua/{id}', 'postSua')->name('update');
        Route::get('/xoa/{id}', 'getXoa')->name('delete');
        Route::get('/hoadon/{donhang_id}', 'getInDonHang')->name('hoadon');
    });

    // Quản lý Đơn hàng chi tiết
    Route::prefix('donhang/chitiet')->controller(DonHangChiTietController::class)->name('admin.donhang.chitiet.')->group(function () {
        Route::get('/', 'getDanhSach')->name('index');
        Route::get('/sua/{id}', 'getSua')->name('edit');
        Route::post('/sua/{id}', 'postSua')->name('update');
        Route::get('/xoa/{id}', 'getXoa')->name('delete');
    });
    // Quản lý Tài khoản người dùng
    Route::prefix('nguoidung')->controller(NguoiDungController::class)->name('admin.nguoidung.')->group(function () {
        Route::get('/', 'getDanhSach')->name('index');
        Route::get('/them', 'getThem')->name('create');
        Route::post('/them', 'postThem')->name('add');
        Route::get('/sua/{id}', 'getSua')->name('edit');
        Route::post('/sua/{id}',  'postSua')->name('update');
        Route::get('/xoa/{id}', 'getXoa')->name('delete');
    });

    //Quản lý bài viết
    Route::prefix('baiviet')->controller(BaiVietController::class)->name('admin.baiviet.')->group(function () {
        Route::get('/', 'getDanhSach')->name('index');
        Route::get('/them', 'getThem')->name('create');
        Route::post('/them', 'postThem')->name('add');
        Route::get('/sua/{id}', 'getSua')->name('edit');
        Route::post('/sua/{id}', 'postSua')->name('update');
        Route::get('/xoa/{id}', 'getXoa')->name('delete');
    });

    Route::get('thongke', [DonHangController::class, 'getThongKe'])->name('admin.thongke.index');

    // Route::prefix('thongke')->controller(HomeController::class)->name('admin.thongke.')->group(function () {
    //     Route::get('/', function () {
    //         return 'hello world';
    //     })->name('index');
    // });
});
