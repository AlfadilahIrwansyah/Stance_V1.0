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
        Schema::create('REF_CUST', function (Blueprint $table) {
            $table->unsignedBigInteger('REF_CUST_ID')->autoIncrement()->primaryKey();
            $table->string('CUST_NAME', 255);
            $table->string('CUST_PHONE_NUMBER', 255);
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
