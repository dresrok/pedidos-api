<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_menu_profile', function (Blueprint $table) {
            $table->integer('profile_id')->unsigned();
            $table->integer('menu_id')->unsigned();

            $table->timestamp('menu_profile_created_at')->nullable();
            $table->timestamp('menu_profile_updated_at')->nullable();

            $table->foreign('profile_id')->references('profile_id')->on('c_profiles');
            $table->foreign('menu_id')->references('menu_id')->on('c_menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_menu_profile');
    }
}
