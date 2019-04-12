<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_location_types', function (Blueprint $table) {
            $table->increments('location_type_id');

            $table->string('location_type_name', 64);
            
            $table->timestamp('location_type_created_at')->nullable();
            $table->timestamp('location_type_updated_at')->nullable();
            $table->softDeletes('location_type_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_location_types');
    }
}
