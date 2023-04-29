<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;


class QuyenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'quantrivien', 'display_name' => 'Quản trị viên', 'group' => 'Hệ thống', 'guard_name' => 'web'],
            ['name' => 'nhanvien', 'display_name' => 'Nhân viên', 'group' => 'Hệ thống', 'guard_name' => 'web'],
            ['name' => 'khachhang', 'display_name' => 'Khách hàng', 'group' => 'Khách hàng', 'guard_name' => 'web'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate($role);
        }

        $Admin = User::whereEmail('admin@gmail.com')->first();

        if (!$Admin) {
            $Admin = User::factory()->create(['email' => 'admin@gmail.com']);
        }
        $Admin->assignRole('quantrivien');


        $permissions = [
            ['name' => 'them-user', 'display_name' => 'Thêm tài khoản', 'group' => 'Tài khoản', 'guard_name' => 'web'],
            ['name' => 'sua-user', 'display_name' => 'Sửa tài khoản', 'group' => 'Tài khoản', 'guard_name' => 'web'],
            ['name' => 'xem-user', 'display_name' => 'Xem tài khoản', 'group' => 'Tài khoản', 'guard_name' => 'web'],
            ['name' => 'xoa-user', 'display_name' => 'Xóa tài khoản', 'group' => 'Tài khoản', 'guard_name' => 'web'],

            ['name' => 'them-quyen', 'display_name' => 'Thêm quyền', 'group' => 'Quyền', 'guard_name' => 'web'],
            ['name' => 'sua-quyen', 'display_name' => 'Sửa quyền', 'group' => 'Quyền', 'guard_name' => 'web'],
            ['name' => 'xem-quyen', 'display_name' => 'Xem quyền', 'group' => 'Quyền', 'guard_name' => 'web'],
            ['name' => 'xoa-quyen', 'display_name' => 'Xóa quyền', 'group' => 'Quyền', 'guard_name' => 'web'],

            ['name' => 'them-lsp', 'display_name' => 'Thêm loại sản phẩm', 'group' => 'Loại sản phẩm', 'guard_name' => 'web'],
            ['name' => 'sua-lsp', 'display_name' => 'Sửa loại sản phẩm', 'group' => 'Loại sản phẩm', 'guard_name' => 'web'],
            ['name' => 'xem-lsp', 'display_name' => 'Xem loại sản phẩm', 'group' => 'Loại sản phẩm', 'guard_name' => 'web'],
            ['name' => 'xoa-lsp', 'display_name' => 'Xóa loại sản phẩm', 'group' => 'Loại sản phẩm', 'guard_name' => 'web'],

            ['name' => 'them-sp', 'display_name' => 'Thêm sản phẩm', 'group' => 'Sản phẩm', 'guard_name' => 'web'],
            ['name' => 'sua-sp', 'display_name' => 'Sửa sản phẩm', 'group' => 'Sản phẩm', 'guard_name' => 'web'],
            ['name' => 'xem-sp', 'display_name' => 'Xem sản phẩm', 'group' => 'Sản phẩm', 'guard_name' => 'web'],
            ['name' => 'xoa-sp', 'display_name' => 'Xóa sản phẩm', 'group' => 'Sản phẩm', 'guard_name' => 'web'],

            ['name' => 'them-hsx', 'display_name' => 'Thêm hãng sản xuất', 'group' => 'Hãng sản xuất', 'guard_name' => 'web'],
            ['name' => 'sua-hsx', 'display_name' => 'Sửa hãng sản xuất', 'group' => 'Hãng sản xuất', 'guard_name' => 'web'],
            ['name' => 'xem-hsx', 'display_name' => 'Xem hãng sản xuất', 'group' => 'Hãng sản xuất', 'guard_name' => 'web'],
            ['name' => 'xoa-hsx', 'display_name' => 'Xóa hãng sản xuất', 'group' => 'Hãng sản xuất', 'guard_name' => 'web'],

            ['name' => 'them-baiviet', 'display_name' => 'Thêm bài viết', 'group' => 'Bài viết', 'guard_name' => 'web'],
            ['name' => 'sua-baiviet', 'display_name' => 'Sửa bài viết', 'group' => 'Bài viết', 'guard_name' => 'web'],
            ['name' => 'xem-baiviet', 'display_name' => 'Xem bài viết', 'group' => 'Bài viết', 'guard_name' => 'web'],
            ['name' => 'xoa-baiviet', 'display_name' => 'Xóa bài viết', 'group' => 'Bài viết', 'guard_name' => 'web'],

            ['name' => 'them-tinhtrang', 'display_name' => 'Thêm tình trạng', 'group' => 'Trạng thái', 'guard_name' => 'web'],
            ['name' => 'sua-tinhtrang', 'display_name' => 'Sửa tình trạng', 'group' => 'Trạng thái', 'guard_name' => 'web'],
            ['name' => 'xem-tinhtrang', 'display_name' => 'Xem tình trạng', 'group' => 'Trạng thái', 'guard_name' => 'web'],
            ['name' => 'xoa-tinhtrang', 'display_name' => 'Xóa tình trạng', 'group' => 'Trạng thái', 'guard_name' => 'web'],

            ['name' => 'them-donhang', 'display_name' => 'Thêm đơn hàng', 'group' => 'Đơn hàng', 'guard_name' => 'web'],
            ['name' => 'sua-donhang', 'display_name' => 'Sửa đơn hàng', 'group' => 'Đơn hàng', 'guard_name' => 'web'],
            ['name' => 'xem-donhang', 'display_name' => 'Xem đơn hàng', 'group' => 'Đơn hàng', 'guard_name' => 'web'],
            ['name' => 'xoa-donhang', 'display_name' => 'Xóa đơn hàng', 'group' => 'Đơn hàng', 'guard_name' => 'web'],

        ];

        foreach ($permissions as $item) {
            Permission::updateOrCreate($item);
        }
    }
}
