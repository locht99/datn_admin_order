<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('partner_id');
            $table->integer('user_id');
            $table->integer('order_id');
            $table->bigInteger('product_id')->nullable()->default(0);
            $table->string('source', 1000)->nullable()->default('')->comment('tên trang bán hàng');
            $table->string('product_name', 1000)->nullable()->default('')->comment('tên sản phẩm trên trang bán hàng');
            $table->string('propertiesId', 150)->nullable()->default('')->comment('id của các đặc điểm sản phẩm');
            $table->string('properties', 300)->nullable()->default('')->comment('đặc điểm của sản phẩm');
            $table->decimal('original_price', 15)->nullable()->default(0);
            $table->decimal('promotion_price', 15)->nullable()->default(0);
            $table->decimal('price', 15)->nullable()->default(0);
            $table->string('price_table', 1000)->nullable()->default('')->comment('bảng config giá tiền ứng với số lượng');
            $table->integer('quantity_min')->nullable()->default(0)->comment('số lượng mua tối thiểu');
            $table->integer('quantity_bought')->nullable()->default(0)->comment('số lượng người dùng mua');
            $table->integer('quantity_received')->nullable()->default(0)->comment('số lượng mình mua được');
            $table->integer('stock')->nullable()->default(0)->comment('số lượng hàng còn trong kho');
            $table->string('url', 1000)->nullable()->default('')->comment('link mua hàng');
            $table->string('image_link', 1000)->nullable()->default('')->comment('link ảnh đại diện của hàng');
            $table->string('image_detail', 1000)->nullable()->default('');
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
        Schema::dropIfExists('order_products');
    }
}
