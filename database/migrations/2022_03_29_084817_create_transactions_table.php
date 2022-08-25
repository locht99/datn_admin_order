<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('partner_id');
            $table->integer('user_id');
            $table->integer('order_id')->nullable();
            $table->integer('type_id');
            $table->text('content')->nullable();
            $table->decimal('point', 15)->nullable()->default(0);
            $table->integer('is_delete')->nullable()->default(0);
            $table->dateTime('create_at')->nullable();
            $table->decimal('point_transaction', 15)->nullable()->default(0);
            $table->text('code_transaction')->nullable();
            $table->integer('new_column')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
