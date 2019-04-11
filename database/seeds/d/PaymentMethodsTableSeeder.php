<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('d_payment_methods')->insert([
            [
                'payment_method_name' => 'Efectivo',
                'payment_method_description' => 'Pago en efectivo',
                'payment_method_created_at' => Carbon::now(),
                'payment_method_updated_at' => Carbon::now(),
            ]
        ]);
    }
}
