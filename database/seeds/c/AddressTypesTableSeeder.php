<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class AddressTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('c_address_types')->insert([
            [
                'address_type_name' => 'Casa',
                'address_type_created_at' => Carbon::now(),
                'address_type_updated_at' => Carbon::now(),
            ],
            [
                'address_type_name' => 'Apartamento',
                'address_type_created_at' => Carbon::now(),
                'address_type_updated_at' => Carbon::now(),
            ],
            [
                'address_type_name' => 'Oficina',
                'address_type_created_at' => Carbon::now(),
                'address_type_updated_at' => Carbon::now(),
            ],
            [
                'address_type_name' => 'Otro',
                'address_type_created_at' => Carbon::now(),
                'address_type_updated_at' => Carbon::now(),
            ]
        ]);
    }
}
