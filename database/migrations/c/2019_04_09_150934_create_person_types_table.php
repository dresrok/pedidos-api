<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_person_types', function (Blueprint $table) {
            $table->increments('person_type_id');

            $table->string('person_type_code', 16);
            $table->string('person_type_description', 64);

            $table->timestamp('person_type_created_at')->nullable();
            $table->timestamp('person_type_updated_at')->nullable();
            $table->softDeletes('person_type_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_person_types');
    }
}
