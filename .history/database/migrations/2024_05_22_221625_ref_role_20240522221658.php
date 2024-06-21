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
        Schema::create('REF_ROLE', function (Blueprint $table) {
            $table->unsignedBigInteger('REF_ROLE_ID')->autoIncrement()->primaryKey();
            $table->string('ROLE_NAME', 200);
            $table->string('ITEM_NAME', 100);
            $table->unsignedBigInteger('REF_CATEGORY_ID');
            $table->foreign('REF_CATEGORY_ID')->references('REF_CATEGORY_ID')->on('REF_CATEGORY')->onDelete('cascade');
            $table->string('STOCK');
            $table->decimal('BUY_PRICE_AMT', 17, 2);
            $table->decimal('SELL_PRICE_AMT', 17, 2);
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
