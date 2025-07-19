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
            $producto->stock -= 1;
            $producto->save();
            return redirect('/productos')->with('success', 'Producto comprado exitosamente.');
        }

        return redirect('/productos')->with('error', 'Producto sin stock.');
    }
}

