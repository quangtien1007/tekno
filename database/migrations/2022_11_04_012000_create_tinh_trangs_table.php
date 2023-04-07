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
            $table->string('badge');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrentOnUpdate();
            $table->engine = 'InnoDB';
        });

        TinhTrang::create(['tinhtrang' => 'Đơn hàng mới', 'badge' => 'badge text-bg-info']);
        TinhTrang::create(['tinhtrang' => 'Đã xác nhận', 'badge' => 'badge text-bg-primary']);
        TinhTrang::create(['tinhtrang' => 'Đang giao', 'badge' => 'badge text-bg-warning']);
        TinhTrang::create(['tinhtrang' => 'Đang chuyển hoàn', 'badge' => 'badge text-bg-warning']);
        TinhTrang::create(['tinhtrang' => 'Đã hủy bởi khách hàng', 'badge' => 'badge text-bg-danger']);
        TinhTrang::create(['tinhtrang' => 'Đã hủy bởi shop', 'badge' => 'badge text-bg-danger']);
        TinhTrang::create(['tinhtrang' => 'Đã chuyển hoàn', 'badge' => 'badge text-bg-success']);
        TinhTrang::create(['tinhtrang' => 'Thành công', 'badge' => 'badge text-bg-success']);
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
