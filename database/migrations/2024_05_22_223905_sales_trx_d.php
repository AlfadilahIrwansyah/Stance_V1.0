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
        Schema::create('SALES_TRX_D', function (Blueprint $table) {
            $table->unsignedBigInteger('SALES_TRX_D_ID')->autoIncrement()->primaryKey();
            $table->unsignedBigInteger('SALES_TRX_H_ID');
            $table->foreign('SALES_TRX_H_ID')->references('SALES_TRX_H_ID')->on('SALES_TRX_H')->onDelete('CASCADE');
            $table->unsignedBigInteger('REF_ITEM_ID');
            $table->foreign('REF_ITEM_ID')->references('REF_ITEM_ID')->on('REF_ITEM')->onDelete('CASCADE');
            $table->unsignedBigInteger('ITEM_AMT');
            $table->decimal('TOTAL_PRICE_AMT', 17, 2);
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
        Schema::dropIfExists('SALES_TRX_D');
    }
};
