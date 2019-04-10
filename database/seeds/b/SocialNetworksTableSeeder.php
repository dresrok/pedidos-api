<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class SocialNetworksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('b_social_networks')->insert([
            [
                'social_network_name' => 'Facebook',
                'social_network_url' => 'https://www.facebook.com/',
                'social_network_icon' => 'fab fa-facebook',
                'social_network_created_at' => Carbon::now(),
                'social_network_updated_at' => Carbon::now()
            ],
            [
                'social_network_name' => 'Twitter',
                'social_network_url' => 'https://twitter.com/',
                'social_network_icon' => 'fab fa-twitter',
                'social_network_created_at' => Carbon::now(),
                'social_network_updated_at' => Carbon::now()
            ],
            [
                'social_network_name' => 'Instagram',
                'social_network_url' => 'https://www.instagram.com/',
                'social_network_icon' => 'fab fa-instagram',
                'social_network_created_at' => Carbon::now(),
                'social_network_updated_at' => Carbon::now()
            ]
        ]);
    }
}
