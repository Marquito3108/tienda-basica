<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;

// Ruta principal redirige a productos
Route::get('/', function () {
    return redirect()->route('productos.index');
});

// Rutas de productos
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::post('/productos/comprar/{id}', [ProductoController::class, 'comprar'])->name('productos.comprar');
Route::post('/productos/agregar-carrito/{id}', [ProductoController::class, 'agregarAlCarrito'])->name('productos.carrito.agregar');
Route::get('/carrito', [ProductoController::class, 'verCarrito'])->name('carrito.ver');

// Opcional: si decides usar un controlador exclusivo para el carrito
Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::get('/carrito', [CarritoController::class, 'ver'])->name('carrito.ver');
Route::post('/carrito/finalizar', [CarritoController::class, 'finalizar'])->name('carrito.finalizar');
Route::post('/carrito/finalizar', [ProductoController::class, 'finalizarCompra'])->name('carrito.finalizar');

