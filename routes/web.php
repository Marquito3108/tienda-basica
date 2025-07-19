<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::get('/productos', [ProductoController::class, 'index']);


Route::post('/productos/comprar/{id}', [ProductoController::class, 'comprar'])->name('comprar');


