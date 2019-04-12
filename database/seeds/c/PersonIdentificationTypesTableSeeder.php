<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class PersonIdentificationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('c_person_identification_types')->insert([
            [
                'person_identification_type_code' => 'CC',
                'person_identification_type_description' => 'Cédula de Ciudadanía',
                'person_identification_type_created_at' => Carbon::now(),
                'person_identification_type_updated_at' => Carbon::now()
            ],
            [
                'person_identification_type_code' => 'NIT',
                'person_identification_type_description' => 'Número de Identificación Tributaria',
                'person_identification_type_created_at' => Carbon::now(),
                'person_identification_type_updated_at' => Carbon::now(),
            ]
        ]);
    }
}
