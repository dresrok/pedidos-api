<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_invoice_details', function (Blueprint $table) {
            $table->bigIncrements('invoice_detail_id');

            $table->string('invoice_detail_description', 128);
            $table->double('invoice_detail_amount', 12, 2);

            $table->bigInteger('invoice_id')->unsigned();
            $table->bigInteger('order_detail_id')->unsigned();

            $table->timestamp('invoice_detail_created_at')->nullable();
            $table->timestamp('invoice_detail_updated_at')->nullable();
            $table->softDeletes('invoice_detail_deleted_at');

            $table->foreign('invoice_id')->references('invoice_id')->on('d_invoices');
            $table->foreign('order_detail_id')->references('order_detail_id')->on('d_order_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_invoice_details');
    }
}
