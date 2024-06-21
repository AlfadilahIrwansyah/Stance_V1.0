<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_data', function (Blueprint $table) {
            $table->increments('sales_id')->id()->primaryKey();
            $table->unsignedBigInteger('ref_item_id');
            $table->foreign('ref_item_id')->references('ref_item_id')->on('ref_item')->onDelete('cascade');;
            $table->unsignedBigInteger('amount');
            $table->date('date_sale');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_data');
    }
};
