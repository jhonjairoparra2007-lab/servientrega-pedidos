<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;

// Ruta principal, redirige a la lista de pedidos
Route::get('/', function () {
    return redirect('/pedidos');
});

// Ruta para buscar un pedido por ID/guía (Debe ir antes del resource para no chocar con show)
Route::get('/pedidos/buscar', [PedidoController::class, 'buscar'])->name('pedidos.buscar');

// Rutas CRUD automáticas para Pedidos (index, create, store, show, edit, update, destroy)
Route::resource('pedidos', PedidoController::class);
