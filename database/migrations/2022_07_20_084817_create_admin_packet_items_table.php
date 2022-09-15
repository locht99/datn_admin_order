<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminPacketItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_packet_items', function (Blueprint $table) {
            $table->id();
            $table->text('waybill_code')->nullable()->comment('mã vận đơn');
            $table->integer('order_id')->nullable()->comment('đơn hàng');
            $table->integer('admin_packet_id')->nullable()->comment('kiện hàng');
            $table->dateTime('created_at')->nullable();
            $table->integer('is_delete')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_packet_items');
    }
}
