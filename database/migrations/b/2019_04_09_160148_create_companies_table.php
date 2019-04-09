<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_companies', function (Blueprint $table) {
            $table->bigIncrements('company_id');

            $table->string('company_legal_name', 128);
            $table->string('company_commercial_name', 128);
            $table->string('company_slug', 128);
            $table->string('company_image', 128)->nullable();
            $table->string('city', 32);
            $table->boolean('company_is_certified');


            $table->timestamp('company_created_at')->nullable();
            $table->timestamp('company_updated_at')->nullable();
            $table->softDeletes('company_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('b_companies');
    }
}
