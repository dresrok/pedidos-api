<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_estate_invoice', function (Blueprint $table) {
            $table->integer('estate_id')->unsigned();
            $table->bigInteger('invoice_id')->unsigned();

            $table->timestamp('estate_invoice_created_at')->nullable();
            $table->timestamp('estate_invoice_updated_at')->nullable();

            $table->foreign('estate_id')->references('estate_id')->on('d_estates');
            $table->foreign('invoice_id')->references('invoice_id')->on('d_invoices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_estate_invoice');
    }
}
