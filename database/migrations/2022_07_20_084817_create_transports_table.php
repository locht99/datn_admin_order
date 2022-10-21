<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transports', function (Blueprint $table) {
            $table->id();
            $table->integer('partner_id');
            $table->integer('user_id');
            $table->integer('order_id');
            $table->integer('packet_id');
            $table->smallInteger('cod')->nullable()->default(0);
            $table->text('cod_note')->nullable();
            $table->string('phone', 15)->nullable();
            $table->text('address')->nullable();
            $table->integer('is_delete')->nullable()->default(0);
            $table->dateTime('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transports');
    }
}
