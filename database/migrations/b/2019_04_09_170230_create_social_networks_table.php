<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_social_networks', function (Blueprint $table) {
            $table->increments('social_network_id');

            $table->string('social_network_name', 32);
            $table->string('social_network_url', 64);
            $table->string('social_network_icon', 32);

            $table->timestamp('social_network_created_at')->nullable();
            $table->timestamp('social_network_updated_at')->nullable();
            $table->softDeletes('social_network_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('b_social_networks');
    }
}
