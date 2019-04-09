<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonIdentificationTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_person_identification_types', function (Blueprint $table) {
            $table->increments('person_identification_type_id');

            $table->string('person_identification_type_code', 16);
            $table->string('person_identification_type_description', 64);

            $table->timestamp('person_identification_type_created_at')->nullable();
            $table->timestamp('person_identification_type_updated_at')->nullable();
            $table->softDeletes('person_identification_type_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_person_identification_types');
    }
}
