<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('partner_id');
            $table->integer('user_id');
            $table->integer('order_status_id');
            $table->bigInteger('shop_id')->nullable()->default(0);
            $table->string('shop_name', 150)->nullable()->default('');
            $table->string('shop_url', 1000)->nullable()->default('')->comment('địa chỉ shop');
            $table->decimal('global_shipping_fee', 15)->nullable()->default(0);
            $table->decimal('china_shipping_fee', 15)->nullable()->default(0);
            $table->decimal('purchase_fee', 15)->nullable()->default(0);
            $table->decimal('inventory_fee', 15)->nullable()->default(0);
            $table->decimal('wood_packing_fee', 15)->nullable()->default(0);
            $table->decimal('separately_wood_packing_fee', 15)->nullable()->default(0);
            $table->decimal('high_value_fee', 15)->nullable()->default(0);
            $table->decimal('checking_order_fee', 15)->nullable()->default(0);
            $table->decimal('auto_shipping_fee', 15)->nullable()->default(0);
            $table->decimal('saving_shipping_fee', 15)->nullable()->default(0);
            $table->decimal('express_shipping_fee', 15)->nullable()->default(0);
            $table->decimal('items_price_cny', 15)->nullable()->default(0);
            $table->decimal('items_price_vnd', 15)->nullable()->default(0);
            $table->decimal('total_price', 15)->nullable()->default(0);
            $table->decimal('deposit_amount', 15)->nullable()->default(0);
            $table->text('note')->nullable();
            $table->string('source', 20)->nullable()->default('');
            $table->float('is_delete', 10, 0)->nullable()->default(0);
            $table->text('cancel_note')->nullable();
            $table->boolean('payed')->nullable()->default(false);
            $table->string('source_order_id')->nullable();
            $table->string('waybill_code_link', 500)->nullable();
            $table->text('method_receive')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
