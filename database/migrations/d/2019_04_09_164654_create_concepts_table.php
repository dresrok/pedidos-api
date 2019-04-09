<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConceptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_concepts', function (Blueprint $table) {
            $table->bigIncrements('concept_id');
            
            $table->tinyInteger('concept_factor');
            $table->string('concept_name', 32);
            $table->string('concept_description', 128)->nullable();
            $table->string('concept_formula', 128)->nullable();
            $table->double('concept_amount', 12, 2);

            $table->timestamp('concept_created_at')->nullable();
            $table->timestamp('concept_updated_at')->nullable();
            $table->softDeletes('concept_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_concepts');
    }
}
