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
            $table->string('REF_ITEM_CATEGORY_ID');
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
        Schema::dropIfExists('ref_user');

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['ref_role_id']);
            $table->dropColumn('ref_role_id');
        });
    }
};
