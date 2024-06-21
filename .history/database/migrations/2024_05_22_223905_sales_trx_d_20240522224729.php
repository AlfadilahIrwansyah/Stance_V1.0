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
            $table->unsignedBigInteger('REF_ITEM_ID');
            $table->foreign('REF_ITEM_ID')->references('REF_ITEM_ID')->ON('REF_ITEM')->onDelete('CASCADE');
            $table->unsignedBigInteger('ITEM_AMT');
            $table->decimal('TOTAL_PRICE_AMT');
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
