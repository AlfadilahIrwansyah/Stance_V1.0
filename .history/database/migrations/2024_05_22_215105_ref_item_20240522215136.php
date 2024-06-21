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
            $table->increments('REF_ITEM_ID')->id()->primaryKey();
            $table->string('item_code');
            $table->string('item_name');
            $table->string('item_category');
            $table->string('stock');
            $table->decimal('buy_price_amt');
            $table->decimal('sell_price_amt');
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
        //
    }
};
