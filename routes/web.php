<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::post('/productos/comprar/{id}', [ProductoController::class, 'comprar'])->name('productos.comprar');

Route::get('/', function () {
    return redirect()->route('productos.index');



Route::get('/', fn() => redirect()->route('productos.index'));

Route::post('/productos/agregar-carrito/{id}', [ProductoController::class, 'agregarAlCarrito'])->name('productos.carrito.agregar');
Route::get('/carrito', [ProductoController::class, 'verCarrito'])->name('carrito.ver');

});
