<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_users', function (Blueprint $table) {
            $table->bigIncrements('user_id');

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->bigInteger('person_id')->unsigned();
            $table->integer('profile_id')->unsigned();

            $table->timestamp('user_created_at')->nullable();
            $table->timestamp('user_updated_at')->nullable();
            $table->softDeletes('user_deleted_at');

            $table->foreign('person_id')->references('person_id')->on('c_people');
            $table->foreign('profile_id')->references('profile_id')->on('c_profiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_users');
    }
}
