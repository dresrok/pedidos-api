<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_invoices', function (Blueprint $table) {
            $table->bigIncrements('invoice_id');

            $table->datetime('invoice_date');
            $table->integer('invoice_serial');
            $table->string('invoice_number');
            $table->string('invoice_description', 256)->nullable();

            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('person_id')->unsigned();
            $table->integer('payment_method_id')->unsigned();
            $table->integer('office_id')->unsigned();

            $table->timestamp('order_created_at')->nullable();
            $table->timestamp('order_updated_at')->nullable();
            $table->softDeletes('order_deleted_at');

            $table->foreign('order_id')->references('order_id')->on('d_orders');
            $table->foreign('person_id')->references('person_id')->on('c_people');
            $table->foreign('payment_method_id')->references('payment_method_id')->on('d_payment_methods');
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
        Schema::dropIfExists('d_invoices');
    }
}
