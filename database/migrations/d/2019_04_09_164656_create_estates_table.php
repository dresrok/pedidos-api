<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_estates', function (Blueprint $table) {
            $table->increments('estate_id');

            $table->string('estate_name', 32);
            $table->string('estate_used_by', 32);

            $table->timestamp('estate_created_at')->nullable();
            $table->timestamp('estate_updated_at')->nullable();
            $table->softDeletes('estate_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_estates');
    }
}
