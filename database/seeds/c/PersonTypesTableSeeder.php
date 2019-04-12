<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class PersonTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('c_person_types')->insert([
            [
                'person_type_code' => 'NAT',
                'person_type_description' => 'Persona Natural',
                'person_type_created_at' => Carbon::now(),
                'person_type_updated_at' => Carbon::now()
            ],
            [
                'person_type_code' => 'JUD',
                'person_type_description' => 'Persona Jurídica',
                'person_type_created_at' => Carbon::now(),
                'person_type_updated_at' => Carbon::now()
                ]
        ]);
    }
}
