<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficeUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_office_user', function (Blueprint $table) {
            $table->increments('user_office_id');

            $table->bigInteger('user_id')->unsigned();
            $table->integer('office_id')->unsigned();

            $table->timestamp('user_office_created_at')->nullable();
            $table->timestamp('user_office_updated_at')->nullable();
            $table->softDeletes('user_office_deleted_at');

            $table->foreign('user_id')->references('user_id')->on('c_users');
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
        Schema::dropIfExists('c_office_user');
    }
}
