<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class NewProductsInSale extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('products')->insert([
            [
                'name' => 'Celular 4',
                'price' => 2000.00,
                'description' => 'Lorenzo Ipsulum',
                'quantity' => 50,
            ],
            [
                'name' => 'Celular 5',
                'price' => 2200.00,
                'description' => 'Lorem ipsum dolor',
                'quantity' => 70,
            ],
            [
                'name' => 'Celular 6',
                'price' => 5500.00,
                'description' => 'Lorem ipsum dolor sit amet',
                'quantity' => 45,
            ],
        ]);
    }
}
