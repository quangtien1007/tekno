<?php

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
		Schema::create('donhang_chitiet', function (Blueprint $table) {
			$table->id();
			$table->foreignId('donhang_id')->constrained('donhang');
			$table->foreignId('sanpham_id')->constrained('sanpham');
			$table->foreignId('mau_id')->constrained('mausanpham');
			$table->foreignId('dungluong_id')->constrained('dungluongsanpham');
			$table->integer('soluongban');
			$table->double('dongiaban');
			$table->dateTime('created_at')->useCurrent();
			$table->dateTime('updated_at')->useCurrent(); //sua thanh useCurrent()
			$table->engine = 'InnoDB';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('donhang_chitiet');
	}
};
