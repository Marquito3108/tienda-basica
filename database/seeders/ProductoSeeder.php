<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder

{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    Producto::create([
        'nombre' => 'Camiseta',
        'descripcion' => 'Camiseta de algodón talla M',
        'precio' => 199.99,
        'stock' => 10,
    ]);

    Producto::create([
        'nombre' => 'Pantalón',
        'descripcion' => 'Pantalón de mezclilla azul',
        'precio' => 349.50,
        'stock' => 5,
    ]);

    Producto::create([
        'nombre' => 'Zapatos',
        'descripcion' => 'Zapatos de cuero negro',
        'precio' => 799.00,
        'stock' => 8,
    ]);
}

}
