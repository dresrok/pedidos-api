<?php

use Illuminate\Database\Seeder;

Use Carbon\Carbon;

class LocationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('c_location_types')->insert([
            [
                'location_type_name' => 'Calle',
                'location_type_created_at' => Carbon::now(),
                'location_type_updated_at' => Carbon::now(),
            ],
            [
                'location_type_name' => 'Carrera',
                'location_type_created_at' => Carbon::now(),
                'location_type_updated_at' => Carbon::now(),
            ],
            [
                'location_type_name' => 'Avenida',
                'location_type_created_at' => Carbon::now(),
                'location_type_updated_at' => Carbon::now(),
            ],
            [
                'location_type_name' => 'Avenida Carrera',
                'location_type_created_at' => Carbon::now(),
                'location_type_updated_at' => Carbon::now(),
            ],
            [
                'location_type_name' => 'Avenida Calle',
                'location_type_created_at' => Carbon::now(),
                'location_type_updated_at' => Carbon::now(),
            ],
            [
                'location_type_name' => 'Circular',
                'location_type_created_at' => Carbon::now(),
                'location_type_updated_at' => Carbon::now(),
            ],
            [
                'location_type_name' => 'Circunvalar',
                'location_type_created_at' => Carbon::now(),
                'location_type_updated_at' => Carbon::now(),
            ],
            [
                'location_type_name' => 'Diagonal',
                'location_type_created_at' => Carbon::now(),
                'location_type_updated_at' => Carbon::now(),
            ],
            [
                'location_type_name' => 'Manzana',
                'location_type_created_at' => Carbon::now(),
                'location_type_updated_at' => Carbon::now(),
            ],
            [
                'location_type_name' => 'Transversal',
                'location_type_created_at' => Carbon::now(),
                'location_type_updated_at' => Carbon::now(),
            ],
            [
                'location_type_name' => 'Vía',
                'location_type_created_at' => Carbon::now(),
                'location_type_updated_at' => Carbon::now(),
            ]
        ]);
    }
}
