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
        //(vnp_Amount, vnp_BankCode, vnp_Command, vnp_CreateDate, vnp_OrderInfo, vnp_SecureHash)
        Schema::create('vnpay_checkout', function (Blueprint $table) {
            $table->id();
            $table->string('vnp_Amount');
            $table->string('vnp_BankCode');
            $table->string('vnp_BankTranNo');
            $table->string('vnp_CardType');
            $table->string('vnp_OrderInfo');
            $table->string('vnp_PayDate');
            $table->double('vnp_TransactionNo');
            $table->text('vnp_SecureHash');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent();
            $table->engine = 'InnoDB';
        });
        /*
            vnp_Amount=2088900000
            vnp_BankCode=NCB
            vnp_BankTranNo=VNP13966660
            vnp_CardType=ATM
            vnp_OrderInfo=Thanh+to%C3%A1n+VNPAY
            vnp_PayDate=20230318212816
            vnp_ResponseCode=00
            vnp_TmnCode=NRCQ8CGP
            vnp_TransactionNo=13966660
            vnp_TransactionStatus=00
            vnp_TxnRef=80
            vnp_SecureHash=416c6bbda833c4a6e2738eff6896e68da7e9b52a829f0b67d8fa0061bec4847e8f901980d4adbdb544fcbb2af010b12f63ae0b790bb47eaceba7dbe9e0b24a76
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_vnpay_checkout');
    }
};
