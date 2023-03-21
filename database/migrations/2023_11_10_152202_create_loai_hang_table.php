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
        Schema::create('loai_hang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loaisanpham_id')->constrained('loaisanpham');
            // $table->foreignId('hangsanxuat_id')->constrained('hangsanxuat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loai_hang');
    }
};
