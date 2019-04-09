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
            $table->increments('profile_menu_id');

            $table->integer('profile_id')->unsigned();
            $table->integer('menu_id')->unsigned();

            $table->timestamp('profile_menu_created_at')->nullable();
            $table->timestamp('profile_menu_updated_at')->nullable();
            $table->softDeletes('profile_menu_deleted_at');

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
