<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_estate_order', function (Blueprint $table) {
            $table->integer('estate_id')->unsigned();
            $table->bigInteger('order_id')->unsigned();

            $table->timestamp('estate_order_created_at')->nullable();
            $table->timestamp('estate_order_updated_at')->nullable();

            $table->foreign('estate_id')->references('estate_id')->on('d_estates');
            $table->foreign('order_id')->references('order_id')->on('d_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_estate_order');
    }
}
