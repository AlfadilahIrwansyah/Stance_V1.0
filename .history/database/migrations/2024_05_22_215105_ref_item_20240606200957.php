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
        Schema::create('REF_ITEM', function (Blueprint $table) {
            $table->unsignedBigInteger('REF_ITEM_ID')->autoIncrement()->primaryKey();
            $table->string('ITEM_CODE', 255)->unique();
            $table->string('ITEM_NAME', 255);
            $table->unsignedBigInteger('REF_CATEGORY_ID');
            $table->foreign('REF_CATEGORY_ID')->references('REF_CATEGORY_ID')->on('REF_CATEGORY')->onDelete('cascade');
            $table->string('STOCK');
            $table->decimal('BUY_PRICE_AMT', 17, 2);
            $table->decimal('SELL_PRICE_AMT', 17,2);
            $table->boolean('IS_SELL')->default('FALSE');
            $table->
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
        Schema::dropIfExists('REF_ITEM');
    }
};
