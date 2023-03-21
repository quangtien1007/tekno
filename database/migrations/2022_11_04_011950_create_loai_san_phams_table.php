<?php

use App\Models\LoaiSanPham;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('loaisanpham', function (Blueprint $table) {
			$table->id();
			$table->string('tenloai');
			$table->string('tenloai_slug');
			$table->integer('parent_id');
			$table->string('hinhanh')->nullable();
			$table->dateTime('created_at')->useCurrent();
			$table->dateTime('updated_at')->useCurrent();
			$table->engine = 'InnoDB';
		});

		LoaiSanPham::create(['tenloai' => 'Điện thoại', 'tenloai_slug' => 'dien-thoai', 'parent_id' => '0', 'hinhanh' => '<i class="fa-solid fa-mobile-screen-button"></i>']);
		LoaiSanPham::create(['tenloai' => 'Tablet', 'tenloai_slug' => 'tablet', 'parent_id' => '0', 'hinhanh' =>  '<i class="fa-solid fa-tablet-screen-button"></i>']);
		LoaiSanPham::create(['tenloai' => 'Laptop', 'tenloai_slug' => 'laptop', 'parent_id' => '0', 'hinhanh' =>  '<i class="fa-solid fa-laptop"></i>']);
		LoaiSanPham::create(['tenloai' => 'Chuột, bàn phím', 'tenloai_slug' => 'chuot-ban-phim', 'parent_id' => '0', 'hinhanh' =>  '<i class="fa-solid fa-computer-mouse"></i>']);
		LoaiSanPham::create(['tenloai' => 'Củ, cáp sạc', 'tenloai_slug' => 'cu-cap-sac', 'parent_id' => '0', 'hinhanh' => '<i class="fa-solid fa-charging-station"></i>']);
		LoaiSanPham::create(['tenloai' => 'Tai nghe', 'tenloai_slug' => 'tai-nghe', 'parent_id' => '0', 'hinhanh' => '<i class="fa-solid fa-headphones"></i>']);
		LoaiSanPham::create(['tenloai' => 'Thiết bị lưu trữ', 'tenloai_slug' => 'thiet-bi-luu-tru', 'parent_id' => '0', 'hinhanh' => '<i class="fa-solid fa-hard-drive"></i>']);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('loaisanpham');
	}
};
