<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('partner_id');
            $table->integer('user_id');
            $table->string('source', 20)->nullable()->default('');
            $table->bigInteger('shop_id')->nullable()->default(0);
            $table->string('shop_name', 150)->nullable()->default('');
            $table->string('shop_url', 1000)->nullable()->default('');
            $table->decimal('total_price', 15)->nullable()->default(0);
            $table->smallInteger('opt_signed_order')->nullable()->default(0);
            $table->smallInteger('opt_auto_ship')->nullable()->default(0);
            $table->smallInteger('opt_saving_transport')->nullable()->default(0);
            $table->smallInteger('opt_express_ship')->nullable()->default(0);
            $table->smallInteger('opt_checking')->nullable()->default(0);
            $table->smallInteger('opt_wood_pack')->nullable()->default(0);
            $table->smallInteger('opt_private_wood_pack')->nullable()->default(0);
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
        Schema::dropIfExists('carts');
    }
}
