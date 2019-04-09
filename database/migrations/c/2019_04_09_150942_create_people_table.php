<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_people', function (Blueprint $table) {
            $table->bigIncrements('person_id');

            $table->string('person_first_name', 64)->nullable();
            $table->string('person_last_name', 64)->nullable();
            $table->string('person_legal_name', 64)->nullable();
            $table->string('person_identification', 64)->nullable();
            $table->string('person_description', 256)->nullable();

            $table->integer('person_type_id')->unsigned();
            $table->integer('person_identification_type_id')->unsigned();

            $table->timestamp('person_created_at')->nullable();
            $table->timestamp('person_updated_at')->nullable();
            $table->softDeletes('person_deleted_at');

            $table->foreign('person_type_id')->references('person_type_id')->on('c_person_types');
            $table->foreign('person_identification_type_id')->references('person_identification_type_id')->on('c_person_identification_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_people');
    }
}
