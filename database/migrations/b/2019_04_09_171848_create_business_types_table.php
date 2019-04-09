<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_business_types', function (Blueprint $table) {
            $table->increments('business_type_id');

            $table->string('business_type_machine_name', 32);
            $table->string('business_type_normalized_name', 32);
            $table->string('business_type_name', 32);

            $table->timestamp('business_type_created_at')->nullable();
            $table->timestamp('business_type_updated_at')->nullable();
            $table->softDeletes('business_type_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('b_business_types');
    }
}
