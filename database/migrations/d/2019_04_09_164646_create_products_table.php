<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_products', function (Blueprint $table) {
            $table->bigIncrements('product_id');

            $table->string('product_machine_name', 64);
            $table->string('product_normalized_name', 64);
            $table->string('product_name', 64);
            $table->string('product_description', 128)->nullable();
            $table->string('product_image_name', 256)->nullable();

            $table->bigInteger('category_id')->unsigned();
            $table->integer('office_id')->unsigned();

            $table->timestamp('product_created_at')->nullable();
            $table->timestamp('product_updated_at')->nullable();
            $table->softDeletes('product_deleted_at');

            $table->foreign('category_id')->references('category_id')->on('d_categories');
            $table->foreign('office_id')->references('office_id')->on('b_offices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_products');
    }
}
