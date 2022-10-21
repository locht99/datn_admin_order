<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminPacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_packets', function (Blueprint $table) {
            $table->id();
            $table->float('weight', 10, 0)->nullable()->comment('khối lượng của hàng (kg)');
            $table->float('volume', 10, 0)->nullable()->comment('thể tích của hàng (cm3)');
            $table->float('weight_from_volume', 10, 0)->nullable()->comment('khối lượng quy đổi (kg)');
            $table->integer('wood_packing')->nullable()->default(0)->comment('đóng gỗ (true/false)');
            $table->text('note')->nullable()->comment('ghi chú kiện hàng');
            $table->integer('status_id')->nullable()->comment('tình trạng kiện hàng');
            $table->integer('is_delete')->nullable()->default(0);
            $table->decimal('unit_price', 15)->nullable();
            $table->decimal('wood_packing_price', 15)->nullable();
            $table->decimal('other_price', 15)->nullable();
            $table->decimal('total_price', 15)->nullable();
            $table->boolean('paid')->nullable()->default(false);
            $table->text('code')->nullable()->comment('Mã kiện hàng');
            $table->integer('warehouse_id')->nullable()->comment('ID kho hàng');
            $table->integer('partner_id')->nullable();
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
        Schema::dropIfExists('admin_packets');
    }
}
