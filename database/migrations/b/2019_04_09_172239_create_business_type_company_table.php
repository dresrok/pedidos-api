<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessTypeCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_business_type_company', function (Blueprint $table) {
            $table->increments('company_business_type_id');

            $table->integer('business_type_id')->unsigned();
            $table->integer('office_id')->unsigned();

            $table->timestamp('company_business_type_created_at')->nullable();
            $table->timestamp('company_business_type_updated_at')->nullable();
            $table->softDeletes('company_business_type_deleted_at');

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
        Schema::dropIfExists('b_business_type_company');
    }
}
