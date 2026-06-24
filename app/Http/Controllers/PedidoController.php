<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PedidoController extends Controller
{
    /**
     * Muestra la lista de todos los pedidos.
     * Consume la API de Fake Store para simular los pedidos de Servientrega.
     */
    public function index()
    {
        try {
            // Realiza la petición GET a la API
            $response = Http::get('https://fakestoreapi.com/products');
            
            // Convierte la respuesta a un arreglo de PHP
            $pedidos = $response->json();
            
            // Retorna la vista pasando los datos de los pedidos
            return view('pedidos.index', compact('pedidos'));
        } catch (\Exception $e) {
            // Manejo de errores si la API falla
            $pedidos = [];
            $error = 'Error al conectar con el servidor de pedidos. Por favor, intente más tarde.';
            return view('pedidos.index', compact('pedidos', 'error'));
        }
    }

    /**
     * Busca un pedido específico por su ID (simulado como número de guía).
     */
    public function buscar(Request $request)
    {
        $guia = $request->input('guia');
        
        if (!$guia) {
            return redirect()->route('pedidos.index');
        }

        try {
            // Para la búsqueda en esta API, obtenemos todos y filtramos
            // Alternativamente podríamos llamar a https://fakestoreapi.com/products/{id}
            $response = Http::get('https://fakestoreapi.com/products/' . $guia);
            
            if ($response->successful() && $response->json()) {
                $pedido = $response->json();
                // Lo envolvemos en un arreglo para que la vista index pueda iterar como siempre
                $pedidos = [$pedido];
            } else {
                $pedidos = []; // No se encontró
            }

            return view('pedidos.index', compact('pedidos'));
        } catch (\Exception $e) {
            $pedidos = [];
            $error = 'Error al buscar la guía. Por favor, intente más tarde.';
            return view('pedidos.index', compact('pedidos', 'error'));
        }
    }

    /**
     * Muestra el detalle de un pedido específico.
     */
    public function show($id)
    {
        try {
            // Obtenemos los detalles de un producto específico mediante su ID
            $response = Http::get('https://fakestoreapi.com/products/' . $id);
            
            if ($response->successful() && $response->json()) {
                $pedido = $response->json();
                return view('pedidos.show', compact('pedido'));
            }
            
            // Si no se encuentra el producto, redirigir con un mensaje
            return redirect()->route('pedidos.index')->with('error', 'Pedido no encontrado.');
        } catch (\Exception $e) {
            return redirect()->route('pedidos.index')->with('error', 'Error al consultar el detalle del pedido.');
        }
    }
}
