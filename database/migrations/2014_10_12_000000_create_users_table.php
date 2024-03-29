<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('uuid')->unique();
            $table->string('user_parent_uuid');
            $table->string('user_name')->unique();
            $table->string('password');
            $table->string('full_name');
            $table->string('sex');
            $table->string('phone_number');
            $table->string('email');
            $table->string('address');
            $table->string('avatar_img_path');
            $table->string('remember_token');
            $table->string('device_token');
            $table->string('soft_deleted');
            $table->string('device_token');
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
        Schema::dropIfExists('users');
    }
}
