<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_offices', function (Blueprint $table) {
            $table->increments('office_id');

            $table->string('office_name', 256);
            $table->string('office_email', 64)->nullable();
            $table->string('office_open_from', 8)->nullable();
            $table->string('office_open_to', 8)->nullable();
            $table->string('office_delivery_time', 16)->nullable();
            $table->double('office_minimum_order_price', 8, 2)->nullable();
            $table->string('city', 32);

            $table->bigInteger('company_id')->unsigned();

            $table->timestamp('office_created_at')->nullable();
            $table->timestamp('office_updated_at')->nullable();
            $table->softDeletes('office_deleted_at');

            $table->foreign('company_id')->references('company_id')->on('b_companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('b_offices');
    }
}
