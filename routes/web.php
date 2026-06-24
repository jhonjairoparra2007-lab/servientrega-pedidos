<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;

// Ruta principal, redirige a la lista de pedidos
Route::get('/', function () {
    return redirect('/pedidos');
});

// Ruta para listar todos los pedidos
Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');

// Ruta para buscar un pedido por ID/guía
Route::get('/pedidos/buscar', [PedidoController::class, 'buscar'])->name('pedidos.buscar');

// Ruta para mostrar el detalle de un pedido específico
Route::get('/pedidos/{id}', [PedidoController::class, 'show'])->name('pedidos.show');
