<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complains', function (Blueprint $table) {
            $table->id();
            $table->integer('partner_id');
            $table->integer('user_id')->nullable();
            $table->text('image')->nullable();
            $table->integer('order_id')->nullable();
            $table->text('reason')->nullable();
            $table->text('method_handle')->nullable();
            $table->integer('situation')->nullable()->default(0);
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
        Schema::dropIfExists('complains');
    }
}
