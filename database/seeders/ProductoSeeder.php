<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        $productos = [
            ['nombre' => 'Camisa', 'precio' => 250, 'stock' => 10],
            ['nombre' => 'Pantalón', 'precio' => 350, 'stock' => 5],
            ['nombre' => 'Gorra', 'precio' => 100, 'stock' => 15],
            ['nombre' => 'Zapatos', 'precio' => 500, 'stock' => 3],
            ['nombre' => 'Mochila', 'precio' => 400, 'stock' => 7],
        ];

        foreach ($productos as $prod) {
            Producto::create($prod);
        }
    }
}
