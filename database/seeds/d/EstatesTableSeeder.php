<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class EstatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('d_estates')->insert([
            [
                'estate_name' => 'Confirmado',
                'estate_used_by' => 'pedidos',
                'estate_created_at' => Carbon::now(),
                'estate_updated_at' => Carbon::now(),
            ],
            [
                'estate_name' => 'Despachado',
                'estate_used_by' => 'pedidos',
                'estate_created_at' => Carbon::now(),
                'estate_updated_at' => Carbon::now(),
            ],
            [
                'estate_name' => 'Entregado',
                'estate_used_by' => 'pedidos',
                'estate_created_at' => Carbon::now(),
                'estate_updated_at' => Carbon::now(),
            ],
            [
                'estate_name' => 'Cancelado',
                'estate_used_by' => 'pedidos',
                'estate_created_at' => Carbon::now(),
                'estate_updated_at' => Carbon::now(),
            ]
        ]);

        DB::table('d_estates')->insert([
            [
                'estate_name' => 'Generada',
                'estate_used_by' => 'facturas',
                'estate_created_at' => Carbon::now(),
                'estate_updated_at' => Carbon::now(),
            ],
            [
                'estate_name' => 'Pagada',
                'estate_used_by' => 'facturas',
                'estate_created_at' => Carbon::now(),
                'estate_updated_at' => Carbon::now(),
            ]
        ]);
    }
}
