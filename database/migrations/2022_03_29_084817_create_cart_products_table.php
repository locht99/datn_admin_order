<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_products', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('partner_id');
            $table->integer('user_id');
            $table->integer('cart_id');
            $table->string('source', 1000)->nullable()->default('')->comment('tên trang bán hàng');
            $table->bigInteger('product_id')->nullable();
            $table->string('product_name', 1000)->nullable()->default('');
            $table->string('propertiesId', 150)->nullable()->default('');
            $table->string('properties', 300)->nullable()->default('');
            $table->decimal('price_cn', 15)->nullable()->default(0);
            $table->decimal('price', 15)->nullable()->default(0);
            $table->decimal('original_price', 15)->nullable()->default(0);
            $table->decimal('promotion_price', 15)->nullable()->default(0);
            $table->string('price_table', 1000)->nullable()->default('');
            $table->integer('quantity')->nullable()->default(0);
            $table->integer('quantity_min')->nullable()->default(0);
            $table->integer('stock')->nullable();
            $table->string('url', 1000)->nullable()->default('');
            $table->string('image', 1000)->nullable()->default('');
            $table->string('image_detail', 1000)->nullable()->default('');
            $table->text('note')->nullable();
            $table->integer('is_delete')->nullable()->default(0);
            $table->dateTime('create_at')->nullable();
            $table->decimal('unit_price_cn', 15)->nullable()->comment('giá 1 sản phẩm trung quốc');
            $table->decimal('unit_price_vn', 15)->nullable()->comment('giá 1 sản phẩm việt nam');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_products');
    }
}
