<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_address_types', function (Blueprint $table) {
            $table->increments('address_type_id');

            $table->string('address_type_name', 64);
            
            $table->timestamp('address_type_created_at')->nullable();
            $table->timestamp('address_type_updated_at')->nullable();
            $table->softDeletes('address_type_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_address_types');
    }
}
