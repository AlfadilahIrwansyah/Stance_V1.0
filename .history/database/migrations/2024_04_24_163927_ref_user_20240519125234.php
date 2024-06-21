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
        Schema::create('ref_user', function (Blueprint $table) {
            $table->bigIncrements('ref_user_id')->id()->primaryKey();
            $table->string('name');
            $table->string('phone_number');
            $table->unsignedBigInteger('ref_role_id');
            $table->foreign('ref_role_id')->references('ref_role_id')->on('ref_role')->onDelete('cascade');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('is_activated')->nullable()->defaultValue('false');
            $table->timestamps();
            $table->rememberToken();
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
