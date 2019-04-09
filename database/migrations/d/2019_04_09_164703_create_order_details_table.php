<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_order_details', function (Blueprint $table) {
            $table->bigIncrements('order_detail_id');

            $table->integer('order_detail_quantity');

            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('concept_id')->unsigned();

            $table->timestamp('order_detail_created_at')->nullable();
            $table->timestamp('order_detail_updated_at')->nullable();
            $table->softDeletes('order_detail_deleted_at');

            $table->foreign('order_id')->references('order_id')->on('d_orders');
            $table->foreign('product_id')->references('product_id')->on('d_products');
            $table->foreign('concept_id')->references('concept_id')->on('d_concepts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_order_details');
    }
}
