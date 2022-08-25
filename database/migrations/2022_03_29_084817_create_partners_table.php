<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('name', 150)->nullable();
            $table->string('phone', 15)->nullable();
            $table->integer('point')->nullable()->default(0);
            $table->integer('is_running')->nullable()->default(1);
            $table->integer('is_delete')->nullable()->default(0);
            $table->dateTime('create_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partners');
    }
}
