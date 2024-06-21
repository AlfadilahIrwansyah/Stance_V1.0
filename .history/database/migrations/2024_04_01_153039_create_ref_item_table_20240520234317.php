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
        Schema::create('ref_item', function (Blueprint $table) {
            $table->bigIncrements('ref_item_id')->id()->primaryKey();
            $table->string('item_code');
            $table->string('item_name');
            $table->string('item_category');
            $table->UAN('stock');
            $table->unsignedDecimal('buy_price_amt');
            $table->unsignedDecimal('sell_price_amt');
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
        Schema::dropIfExists('ref_item');
    }
};
