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
        /*
        PAYERID,FIRSTNAME,LASTNAME,EMAIL,L_QTY0,L_TAXAMT0,L_AMT0,L_DESC0,
        */
        Schema::create('paypal_checkout', function (Blueprint $table) {
            $table->id();
            $table->string('PAYERID');
            $table->string('FIRSTNAME');
            $table->string('LASTNAME');
            $table->string('EMAIL');
            $table->integer('L_QTY0');
            $table->double('L_TAXAMT0');
            $table->double('L_AMT0');
            $table->text('L_DESC0');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent();
            $table->engine = 'InnoDB';
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
