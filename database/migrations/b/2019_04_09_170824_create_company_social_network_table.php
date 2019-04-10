<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanySocialNetworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_company_social_network', function (Blueprint $table) {
            $table->increments('company_social_network_id');

            $table->string('company_social_network_username', 32);


            $table->integer('social_network_id')->unsigned();
            $table->bigInteger('company_id')->unsigned();

            $table->timestamp('company_social_network_created_at')->nullable();
            $table->timestamp('company_social_network_updated_at')->nullable();

            $table->foreign('social_network_id')->references('social_network_id')->on('b_social_networks');
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
        Schema::dropIfExists('b_company_social_network');
    }
}
