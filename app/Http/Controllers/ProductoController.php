<?php

namespace App\Http\Controllers;
use App\Models\HistorialCompra;
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

        // Guardar en historial
        HistorialCompra::create([
            'producto' => $producto->nombre,
            'precio' => $producto->precio,
            'cantidad' => 1
        ]);

        $producto->save();
        return redirect()->route('productos.index')->with('success', 'Producto comprado exitosamente.');
    }

    return redirect()->route('productos.index')->with('error', 'Producto sin stock.');
}


public function agregarAlCarrito($id)
{
    $producto = Producto::findOrFail($id);

    // Validar stock
    if ($producto->stock <= 0) {
        return redirect()->route('productos.index')->with('error', 'Este producto ya no tiene stock.');
    }

    $carrito = session()->get('carrito', []);

    // Agregar o aumentar cantidad
    if (isset($carrito[$id])) {
        $carrito[$id]['cantidad']++;
    } else {
        $carrito[$id] = [
            'nombre' => $producto->nombre,
            'precio' => $producto->precio,
            'cantidad' => 1
        ];
    }

    // 🔹 Descontar stock inmediato
    $producto->stock--;
    $producto->save();

    session(['carrito' => $carrito]);

    return redirect()->route('productos.index')->with('success', 'Producto agregado al carrito y stock actualizado.');
}


public function verCarrito()
    {
    $carrito = session()->get('carrito', []);
    return view('carrito', compact('carrito'));
    }

public function finalizarCompra()
{
    $carrito = session('carrito', []);

    if (count($carrito) === 0) {
        return redirect()->route('carrito.ver')->with('error', 'El carrito está vacío.');
    }

    foreach ($carrito as $id => $item) {
        // Guardar cada producto en el historial
        HistorialCompra::create([
            'producto' => $item['nombre'],
            'precio' => $item['precio'],
            'cantidad' => $item['cantidad']
        ]);

        // Nota: el stock ya se descontó al agregar, así que no lo tocamos aquí
    }

    // Vaciar carrito
    session()->forget('carrito');

    // 🔹 Redirigir al listado con mensaje
    return redirect()->route('productos.index')->with('success', '✅ Compra finalizada con éxito.');
}





public function verHistorial()
{
    $historial = HistorialCompra::orderBy('created_at', 'desc')->get();
    return view('productos.historial', compact('historial'));
}




}
