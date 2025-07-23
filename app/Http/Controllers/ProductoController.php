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
            'id' => $producto->id,
            'nombre' => $producto->nombre,
            'precio' => $producto->precio,
            'cantidad' => 1
        ];
    }

    session(['carrito' => $carrito]);

    return redirect()->route('carrito.ver')->with('success', 'Producto agregado al carrito');
}


    public function verCarrito()
    {
    $carrito = session()->get('carrito', []);
    return view('carrito', compact('carrito'));
    }
public function finalizarCompra()
{
    $carrito = session('carrito', []);

    if (empty($carrito)) {
        return redirect()->route('carrito.ver')->with('error', 'El carrito está vacío.');
    }

    // Aquí puedes poner lógica para registrar la compra en base de datos, restar stock, etc.
    foreach ($carrito as $item) {
        $producto = Producto::find($item['id']);
        if ($producto && $producto->stock >= $item['cantidad']) {
            $producto->stock -= $item['cantidad'];
            $producto->save();
        } else {
            return redirect()->route('carrito.ver')->with('error', "No hay suficiente stock de {$item['nombre']}");
        }
    }

    // Vaciar el carrito después de comprar
    session()->forget('carrito');

    return redirect()->route('productos.index')->with('success', 'Compra finalizada con éxito. ¡Gracias!');
}


}
