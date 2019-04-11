<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('c_menus')->insert([
            [
                'menu_name' => 'Pedidos',
                'menu_uri' => 'pedidos',
                'menu_icon' => 'fas fa-shopping-basket',
                'menu_order' => 1,
                'menu_created_at' => Carbon::now(),
                'menu_updated_at' => Carbon::now()
            ],
            [
                'menu_name' => 'Mi menu',
                'menu_icon' => 'fas fa-book-open',
                'menu_order' => 2,
                'menu_created_at' => Carbon::now(),
                'menu_updated_at' => Carbon::now()
            ],
            [
                'menu_name' => 'Categorías',
                'menu_uri' => 'categorias',
                'menu_icon' => 'fas fa-stream',
                'menu_order' => 1,
                'menu_parent_id' => 2,
                'menu_created_at' => Carbon::now(),
                'menu_updated_at' => Carbon::now()
            ],
            [
                'menu_name' => 'Productos',
                'menu_uri' => 'productos',
                'menu_icon' => 'fas fa-utensils',
                'menu_order' => 2,
                'menu_parent_id' => 2,
                'menu_created_at' => Carbon::now(),
                'menu_updated_at' => Carbon::now()
            ],
            [
                'menu_name' => 'Conceptos',
                'menu_uri' => 'conceptos',
                'menu_icon' => 'fas fa-money-check-alt',
                'menu_order' => 3,
                'menu_created_at' => Carbon::now(),
                'menu_updated_at' => Carbon::now()
            ],
            [
                'menu_name' => 'Mi restaurante',
                'menu_uri' => 'mi-restaurante',
                'menu_icon' => 'fas fa-store-alt',
                'menu_order' => 4,
                'menu_created_at' => Carbon::now(),
                'menu_updated_at' => Carbon::now()
            ],
            [
                'menu_name' => 'Restaurantes',
                'menu_uri' => 'restaurantes',
                'menu_icon' => 'fas fa-store-alt',
                'menu_order' => 1,
                'menu_created_at' => Carbon::now(),
                'menu_updated_at' => Carbon::now()
            ],
            [
                'menu_name' => 'Mis pedidos',
                'menu_uri' => 'mis-pedidos',
                'menu_icon' => 'fas fa-shopping-basket',
                'menu_order' => 2,
                'menu_created_at' => Carbon::now(),
                'menu_updated_at' => Carbon::now()
            ],
            [
                'menu_name' => 'Mi perfil',
                'menu_uri' => 'mi-perfil',
                'menu_icon' => 'fas fa-user-circle',
                'menu_order' => 3,
                'menu_created_at' => Carbon::now(),
                'menu_updated_at' => Carbon::now()
            ]
        ]);
    }
}
