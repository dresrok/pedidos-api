<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_payment_methods', function (Blueprint $table) {
            $table->increments('payment_method_id');

            $table->string('payment_method_name', 32);
            $table->string('payment_method_description', 128)->nullable();
            
            $table->timestamp('payment_method_created_at')->nullable();
            $table->timestamp('payment_method_updated_at')->nullable();
            $table->softDeletes('payment_method_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_payment_methods');
    }
}
