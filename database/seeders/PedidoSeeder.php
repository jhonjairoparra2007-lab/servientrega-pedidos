<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Pedido;

class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener productos de la API para popular la base de datos inicial
        $response = Http::get('https://fakestoreapi.com/products');
        
        if ($response->successful()) {
            $productos = $response->json();
            
            foreach ($productos as $producto) {
                Pedido::create([
                    'title' => $producto['title'],
                    'price' => $producto['price'],
                    'category' => $producto['category'],
                    'description' => $producto['description'],
                    'image' => $producto['image'],
                ]);
            }
        }
    }
}
