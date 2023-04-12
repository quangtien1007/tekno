<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\DungLuongSanPham;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dungluong', function (Blueprint $table) {
            $table->id();
            $table->string('dungluong');
            $table->timestamps();
        });

        DungLuongSanPham::create(['dungluong' => '64GB']);
        DungLuongSanPham::create(['dungluong' => '128GB']);
        DungLuongSanPham::create(['dungluong' => '256GB']);
        DungLuongSanPham::create(['dungluong' => '512GB']);
        DungLuongSanPham::create(['dungluong' => '1TB']);
        DungLuongSanPham::create(['dungluong' => 'null']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dungluong');
    }
};
