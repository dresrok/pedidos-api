<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_orders', function (Blueprint $table) {
            $table->bigIncrements('order_id');

            $table->datetime('order_date');
            $table->integer('order_serial');
            $table->string('order_number');

            $table->bigInteger('person_id')->unsigned();
            $table->bigInteger('address_id')->unsigned();
            $table->integer('office_id')->unsigned();

            $table->timestamp('order_created_at')->nullable();
            $table->timestamp('order_updated_at')->nullable();
            $table->softDeletes('order_deleted_at');

            $table->foreign('person_id')->references('person_id')->on('c_people');
            $table->foreign('address_id')->references('address_id')->on('c_addresses');
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
        Schema::dropIfExists('d_orders');
    }
}
