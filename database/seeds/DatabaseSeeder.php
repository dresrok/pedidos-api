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
        $this->command->info('Seeders module b');
        $this->call(SocialNetworksTableSeeder::class);
        $this->call(BusinessTypesTableSeeder::class);

        $this->command->info('Seeders module c');
        $this->call(ProfilesTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(MenuProfileTableSeeder::class);
        $this->call(PersonTypesTableSeeder::class);
        $this->call(PersonIdentificationTypesTableSeeder::class);
        $this->call(LocationTypesTableSeeder::class);
        $this->call(AddressTypesTableSeeder::class);

        $this->command->info('Seeders module d');
        $this->call(EstatesTableSeeder::class);
        $this->call(PaymentMethodsTableSeeder::class);

        // $this->command->info('Sample data');
        // $this->call(SampleDataSeeder::class);
    }
}
