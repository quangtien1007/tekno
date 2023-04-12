<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\MauSanPham;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mau', function (Blueprint $table) {
            $table->id();
            $table->string('mau');
            $table->timestamps();
        });

        MauSanPham::create(['mau' => 'Đen']);
        MauSanPham::create(['mau' => 'Trắng']);
        MauSanPham::create(['mau' => 'Xanh']);
        MauSanPham::create(['mau' => 'Đỏ']);
        MauSanPham::create(['mau' => 'Vàng']);
        MauSanPham::create(['mau' => 'null']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mau');
    }
};
