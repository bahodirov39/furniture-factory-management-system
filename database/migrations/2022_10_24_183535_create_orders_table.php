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
            $table->integer('user_id');
            $table->string('status_id');
            $table->string('door_number')->nullable()->default(null);
            $table->string('door_type')->nullable()->default(null);
            $table->integer('all_money')->nullable()->default(null);
            $table->integer('given_money')->nullable()->default(null);
            $table->dateTime('finish_at')->nullable()->default(null);
            $table->string('file')->nullable()->default(null);
            $table->string('description')->nullable()->default(null);
            $table->timestamps();
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
