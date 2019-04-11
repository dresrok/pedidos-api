<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('c_profiles')->insert([
            [
                'profile_machine_name' => 'super_administrador',
                'profile_name' => 'Super Administrador',
                'profile_created_at' => Carbon::now(),
                'profile_updated_at' => Carbon::now(),
            ],
            [
                'profile_machine_name' => 'administrador',
                'profile_name' => 'Administrador',
                'profile_created_at' => Carbon::now(),
                'profile_updated_at' => Carbon::now(),
            ],
            [
                'profile_machine_name' => 'cliente',
                'profile_name' => 'Cliente',
                'profile_created_at' => Carbon::now(),
                'profile_updated_at' => Carbon::now(),
            ]
        ]);
    }
}
