<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function comprar($id)
    {
        $producto = Producto::findOrFail($id);

        if ($producto->stock > 0) {
            $producto->stock--;
            $producto->save();
            return redirect()->route('productos.index')->with('success', 'Producto comprado exitosamente.');
        }

        return redirect()->route('productos.index')->with('error', 'Producto sin stock.');
    }

    public function agregarAlCarrito($id)
{
    $producto = Producto::findOrFail($id);
    $carrito = session()->get('carrito', []);

    if (isset($carrito[$id])) {
        $carrito[$id]['cantidad']++;
    } else {
        $carrito[$id] = [
            'nombre' => $producto->nombre,
            'precio' => $producto->precio,
            'cantidad' => 1
        ];
    }

    session(['carrito' => $carrito]);

    return redirect()->route('productos.index')->with('success', 'Producto agregado al carrito.');
}

    public function verCarrito()
    {
        $carrito = session('carrito', []);
        $total = 0;

        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

    return view('productos.carrito', compact('carrito', 'total'));
    }

}
