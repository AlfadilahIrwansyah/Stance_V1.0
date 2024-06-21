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
        Schema::create('SALES_TRX_H', function (Blueprint $table) {
            $table->unsignedBigInteger('SALES_TRX_H_ID')->autoIncrement()->primaryKey();
            $table->unsignedBigInteger('TOTAL_ITEM');
            $table->string('SALES_TRX_NO')->unique()
            $table->decimal('TOTAL_TRX_AMT', 17,2);
            $table->unsignedBigInteger('REF_USER_ID');
            $table->foreign('REF_USER_ID')->references('REF_USER_ID')->on('REF_USER')->onDelete('CASCADE');
            $table->date('TRX_DATE');
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
        Schema::dropIfExists('SALES_TRX_H');
    }
};
