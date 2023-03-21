<?php

use App\Models\TinhTrang;
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
		Schema::create('tinhtrang', function (Blueprint $table) {
			$table->id();
			$table->string('tinhtrang');
			$table->dateTime('created_at')->useCurrent();
			$table->dateTime('updated_at')->useCurrentOnUpdate();
			$table->engine = 'InnoDB';
		});

		TinhTrang::create(['tinhtrang' => 'Đơn hàng mới']);
		TinhTrang::create(['tinhtrang' => 'Đã xác nhận']);
		TinhTrang::create(['tinhtrang' => 'Đang giao']);
		TinhTrang::create(['tinhtrang' => 'Đang chuyển hoàn']);
		TinhTrang::create(['tinhtrang' => 'Đã hủy bởi khách hàng']);
		TinhTrang::create(['tinhtrang' => 'Đã hủy bởi shop']);
		TinhTrang::create(['tinhtrang' => 'Đã chuyển hoàn']);
		TinhTrang::create(['tinhtrang' => 'Thành công']);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('tinhtrang');
	}
};
