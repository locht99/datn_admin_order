<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packets', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('partner_id');
            $table->integer('user_id');
            $table->integer('order_id');
            $table->smallInteger('status');
            $table->string('code', 300)->nullable();
            $table->float('weight', 10, 0)->nullable()->default(0)->comment('khối lượng của hàng (kg)');
            $table->float('volume', 10, 0)->nullable()->default(0)->comment('thể tích của hàng (cm3)');
            $table->float('weight_from_volume', 10, 0)->nullable()->default(0)->comment('khối lượng quy đổi (kg)');
            $table->float('price_unit', 10, 0)->nullable()->default(0)->comment('tỉ giá (Nhân dân tệ / Việt nam đồng)');
            $table->integer('quantity_buy')->nullable()->default(0)->comment('số lượng hàng người mua muốn đặt');
            $table->integer('quantity_receive')->nullable()->default(0)->comment('số lượng hàng mua được');
            $table->integer('opt_order_checking')->nullable()->default(0)->comment('lựa chọn hàng ký gửi (true/false)');
            $table->integer('opt_auto_shipping')->nullable()->default(0)->comment('lựa chọn tự động giao hàng (true/false)');
            $table->integer('opt_saving_shipping')->nullable()->default(0)->comment('lựa chọn giao hàng tiết kiệm (đợi nhiều hàng rồi giao 1 lượt) (true/false)');
            $table->integer('opt_express_shipping')->nullable()->default(0)->comment('lựa chọn giao hàng nhanh (có hàng giao luôn) (true/false)');
            $table->integer('opt_inventory')->nullable()->default(0)->comment('lựa chọn kiểm hàng (true/false)');
            $table->integer('opt_wood_packing')->nullable()->default(0)->comment('lựa chọn đóng gỗ (true/false)');
            $table->integer('opt_separate_wood_packing')->nullable()->default(0)->comment('lựa chọn đóng gỗ riêng (true/false)');
            $table->dateTime('time_deposit')->nullable()->comment('thời điểm người mua đặt cọc');
            $table->dateTime('time_bought')->nullable()->comment('thời điểm mình đã mua của nhà bán bên TQ');
            $table->dateTime('time_seller_delivered')->nullable()->comment('thời điểm người bán bên TQ giao cho mình');
            $table->dateTime('time_receive')->nullable()->comment('thời điểm mình đã nhận của người bán bên TQ');
            $table->dateTime('time_transport')->nullable()->comment('thời điểm mình vận chuyển từ kho bên TQ về VN');
            $table->dateTime('time_wait_ship')->nullable()->comment('thời điểm hàng về đến kho ở VN và chờ giao hàng');
            $table->dateTime('time_request_ship')->nullable()->comment('thời điểm người mua hàng yêu cầu giao hàng');
            $table->dateTime('time_shipping')->nullable()->comment('thời điểm người giao hàng bên mình đi giao hàng cho khách');
            $table->dateTime('time_shipped_success')->nullable()->comment('thời điểm khách nhận được hàng');
            $table->dateTime('time_lost')->nullable()->comment('thời điểm hàng bị thất lạc');
            $table->dateTime('time_cancel')->nullable()->comment('thời điểm người mua hủy bỏ hàng');
            $table->integer('is_delete')->nullable()->default(0);
            $table->dateTime('create_at')->nullable();
            $table->boolean('checked')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packets');
    }
}
