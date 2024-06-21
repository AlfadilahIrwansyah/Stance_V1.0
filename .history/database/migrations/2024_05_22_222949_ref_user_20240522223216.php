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
        Schema::create('REF_USER', function (Blueprint $table) {
            $table->unsignedBigInteger('REF_USERID')->autoIncrement()->primaryKey();
            $table->string('NAME', 255);
            $table->string('PHONE_NUMBER', 255);
            $table->unsignedBigInteger('REF_ROLE_ID');
            $table->foreign('REF_ROLE_ID')->references('REF_ROLE_ID')->on('REF_ROLE')->onDelete('CASCADE');
            $table->email
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
