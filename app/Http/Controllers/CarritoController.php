<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CarritoController extends Controller
{
    public function agregar($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }

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

        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    public function ver()
    {
        $carrito = session()->get('carrito', []);
        return view('carrito', compact('carrito'));
    }

    public function finalizar()
    {
        session()->forget('carrito');
        return redirect()->route('productos.index')->with('success', 'Compra finalizada. ¡Gracias!');
    }
}
