<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_categories', function (Blueprint $table) {
            $table->bigIncrements('category_id');
            
            $table->string('category_machine_name', 64);
            $table->string('category_normalized_name', 64);
            $table->string('category_name', 64);
            $table->string('category_image_path', 128)->nullable();
            $table->string('category_thumbnail_path', 128)->nullable();
            $table->integer('category_order');

            $table->bigInteger('subcategory_id')->nullable()->unsigned();
            $table->bigInteger('office_id')->unsigned();

            $table->timestamp('category_created_at')->nullable();
            $table->timestamp('category_updated_at')->nullable();
            $table->softDeletes('category_deleted_at');

            $table->foreign('subcategory_id')->references('category_id')->on('d_categories');
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
        Schema::dropIfExists('d_categories');
    }
}
