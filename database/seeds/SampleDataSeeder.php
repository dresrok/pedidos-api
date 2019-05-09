<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companyId = DB::table('b_companies')->insertGetId([
            'company_legal_name' => 'Café Central',
            'company_identification' => '012345678-9',
            'company_slug' => 'cafe-central',
            'city' => 'Ibagué',
            'company_is_certified' => true,
            'company_created_at' => Carbon::now(),
            'company_updated_at' => Carbon::now(),
        ]);

        $officeId = DB::table('b_offices')->insertGetId([
            'office_name' => 'Café Central',
            'city' => 'Ibagué',
            'company_id' => $companyId,
            'office_created_at' => Carbon::now(),
            'office_updated_at' => Carbon::now(),
        ]);

        $personId = DB::table('c_people')->insertGetId([
            'person_first_name' => 'Javier',
            'person_last_name' => 'Café',
            'person_identification' => '123456789',
            'person_type_id' => 1,
            'person_identification_type_id' => 1,
            'person_created_at' => Carbon::now(),
            'person_updated_at' => Carbon::now(),
        ]);

        $userId = DB::table('c_users')->insertGetId([
            'email' => 'javier@gmail.com',
            'password' => bcrypt('secret'),
            'person_id' => $personId,
            'profile_id' => 2,
            'user_created_at' => Carbon::now(),
            'user_updated_at' => Carbon::now(),
        ]);

        DB::table('c_office_user')->insertGetId([
            'user_id' => $userId,
            'office_id' => $officeId,
            'office_user_created_at' => Carbon::now(),
            'office_user_updated_at' => Carbon::now(),
        ]);
    }
}
