<?php

use Illuminate\Database\Seeder;

Use Carbon\Carbon;

class MenuProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('c_menu_profile')->insert([
            ['profile_id' => 1, 'menu_id' => 1, 'menu_profile_created_at' => Carbon::now(), 'menu_profile_updated_at' => Carbon::now()],
            ['profile_id' => 1, 'menu_id' => 2, 'menu_profile_created_at' => Carbon::now(), 'menu_profile_updated_at' => Carbon::now()],
            ['profile_id' => 1, 'menu_id' => 3, 'menu_profile_created_at' => Carbon::now(), 'menu_profile_updated_at' => Carbon::now()],
            ['profile_id' => 1, 'menu_id' => 4, 'menu_profile_created_at' => Carbon::now(), 'menu_profile_updated_at' => Carbon::now()],
            ['profile_id' => 1, 'menu_id' => 5, 'menu_profile_created_at' => Carbon::now(), 'menu_profile_updated_at' => Carbon::now()],
            ['profile_id' => 1, 'menu_id' => 6, 'menu_profile_created_at' => Carbon::now(), 'menu_profile_updated_at' => Carbon::now()],
            ['profile_id' => 1, 'menu_id' => 7, 'menu_profile_created_at' => Carbon::now(), 'menu_profile_updated_at' => Carbon::now()],
            ['profile_id' => 1, 'menu_id' => 8, 'menu_profile_created_at' => Carbon::now(), 'menu_profile_updated_at' => Carbon::now()],
            ['profile_id' => 1, 'menu_id' => 9, 'menu_profile_created_at' => Carbon::now(), 'menu_profile_updated_at' => Carbon::now()],
        ]);

        DB::table('profile_menus')->insert([
            ['profile_id' => 2, 'menu_id' => 1, 'menu_profile_created_at' => Carbon::now(), 'menu_profile_updated_at' => Carbon::now()],
            ['profile_id' => 2, 'menu_id' => 2, 'menu_profile_created_at' => Carbon::now(), 'menu_profile_updated_at' => Carbon::now()],
            ['profile_id' => 2, 'menu_id' => 3, 'menu_profile_created_at' => Carbon::now(), 'menu_profile_updated_at' => Carbon::now()],
            ['profile_id' => 2, 'menu_id' => 4, 'menu_profile_created_at' => Carbon::now(), 'menu_profile_updated_at' => Carbon::now()],
            ['profile_id' => 2, 'menu_id' => 5, 'menu_profile_created_at' => Carbon::now(), 'menu_profile_updated_at' => Carbon::now()],
            ['profile_id' => 2, 'menu_id' => 6, 'menu_profile_created_at' => Carbon::now(), 'menu_profile_updated_at' => Carbon::now()]
        ]);

        DB::table('profile_menus')->insert([
            ['profile_id' => 3, 'menu_id' => 7, 'menu_profile_created_at' => Carbon::now(), 'menu_profile_updated_at' => Carbon::now()],
            ['profile_id' => 3, 'menu_id' => 8, 'menu_profile_created_at' => Carbon::now(), 'menu_profile_updated_at' => Carbon::now()],
            ['profile_id' => 3, 'menu_id' => 9, 'menu_profile_created_at' => Carbon::now(), 'menu_profile_updated_at' => Carbon::now()]
        ]);
    }
}
