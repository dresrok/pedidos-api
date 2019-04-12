<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessTypeOfficeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_business_type_office', function (Blueprint $table) {
            $table->integer('business_type_id')->unsigned();
            $table->integer('office_id')->unsigned();

            $table->timestamp('business_type_office_created_at')->nullable();
            $table->timestamp('business_type_office_updated_at')->nullable();
            
            $table->foreign('business_type_id')->references('business_type_id')->on('b_business_types');
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
        Schema::dropIfExists('b_business_type_office');
    }
}
