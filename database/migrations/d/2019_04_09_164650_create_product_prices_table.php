<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_product_prices', function (Blueprint $table) {
            $table->bigIncrements('product_price_id');

            $table->double('product_price_amount', 12, 2);

            $table->bigInteger('product_id')->unsigned();

            $table->timestamp('product_price_created_at')->nullable();
            $table->timestamp('product_price_updated_at')->nullable();
            $table->softDeletes('product_price_deleted_at');

            $table->foreign('product_id')->references('product_id')->on('d_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_product_prices');
    }
}
