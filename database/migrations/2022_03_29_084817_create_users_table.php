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
            $table->bigInteger('id', true);
            $table->integer('partner_id');
            $table->string('username', 50);
            $table->string('password', 64);
            $table->string('email', 100)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('language', 5)->nullable();
            $table->integer('point')->nullable()->default(0);
            $table->string('accept_token', 64)->nullable();
            $table->dateTime('last_login')->nullable();
            $table->integer('is_delete')->nullable()->default(0);
            $table->dateTime('create_at')->nullable();
            $table->string('uid');
            $table->integer('vip_level')->nullable()->default(0);
            $table->integer('warehouse_id')->nullable();
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
