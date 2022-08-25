<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_transactions', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('type_name', 200)->nullable();
            $table->string('code_language', 50)->nullable();
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
        Schema::dropIfExists('type_transactions');
    }
}
