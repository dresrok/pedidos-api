<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_addresses', function (Blueprint $table) {
            $table->bigIncrements('address_id');

            $table->string('address_name', 64)->nullable();
            $table->string('address_location_i', 8);
            $table->string('address_location_ii', 8);
            $table->string('address_location_iii', 8);
            $table->string('address_description', 64);
            $table->string('address_district', 64);
            $table->string('address_phone', 32);

            $table->integer('address_type_id')->unsigned();
            $table->integer('location_type_id')->unsigned();
            $table->bigInteger('person_id')->nullable()->unsigned();
            $table->integer('office_id')->nullable()->unsigned();
            
            $table->timestamp('address_created_at')->nullable();
            $table->timestamp('address_updated_at')->nullable();
            $table->softDeletes('address_deleted_at');

            $table->foreign('address_type_id')->references('address_type_id')->on('c_address_types');
            $table->foreign('location_type_id')->references('location_type_id')->on('c_location_types');
            $table->foreign('person_id')->references('person_id')->on('c_people');
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
        Schema::dropIfExists('c_addresses');
    }
}
