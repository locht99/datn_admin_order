<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_transactions', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('type_id');
            $table->integer('user_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('packet_id')->nullable();
            $table->date('date')->nullable();
            $table->text('content')->nullable();
            $table->decimal('point_cn', 15)->nullable();
            $table->decimal('point_vn', 15)->nullable();
            $table->decimal('exchange_rate', 15)->nullable();
            $table->decimal('surplus', 15)->nullable();
            $table->integer('is_delete')->nullable()->default(0);
            $table->dateTime('create_at')->nullable();
            $table->integer('admin_packet_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_transactions');
    }
}
