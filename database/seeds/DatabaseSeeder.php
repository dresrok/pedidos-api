<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->info('Seeders module b');
        $this->call(SocialNetworksTableSeeder::class);
        $this->call(BusinessTypesTableSeeder::class);

        $this->info('Seeders module c');
        $this->call(ProfilesTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(MenuProfileTableSeeder::class);
        $this->call(PersonTypesTableSeeder::class);
        $this->call(PersonIdentificationTypesTableSeeder::class);
        $this->call(LocationTypesTableSeeder::class);
        $this->call(AddressTypesTableSeeder::class);

        $this->info('Seeders module d');
        $this->call(PaymentMethodsTableSeeder::class);
    }
}
