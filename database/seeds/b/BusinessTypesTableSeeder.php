<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class BusinessTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('b_business_types')->insert([
            [
                'business_type_machine_name' => 'cafe',
                'business_type_normalized_name' => 'cafe',
                'business_type_name' => 'Café',
                'business_type_created_at' => Carbon::now(),
                'business_type_updated_at' => Carbon::now()
            ],
            [
                'business_type_machine_name' => 'restaurante',
                'business_type_normalized_name' => 'restaurante',
                'business_type_name' => 'Restaurante',
                'business_type_created_at' => Carbon::now(),
                'business_type_updated_at' => Carbon::now()
            ]
        ]);
    }
}
