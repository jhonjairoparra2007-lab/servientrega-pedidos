<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoController extends Controller
{
    /**
     * Muestra la lista de todos los pedidos desde la base de datos local.
     */
    public function index()
    {
        $pedidos = Pedido::orderBy('id', 'desc')->get();
        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Muestra el formulario para crear un nuevo pedido.
     */
    public function create()
    {
        return view('pedidos.create');
    }

    /**
     * Guarda un nuevo pedido en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|url',
        ]);

        $data = $request->all();
        
        // Si no envía imagen, ponemos una por defecto para mantener el diseño
        if (empty($data['image'])) {
            $data['image'] = 'https://via.placeholder.com/300x300.png?text=Sin+Imagen';
        }

        Pedido::create($data);

        return redirect()->route('pedidos.index')->with('success', 'Pedido creado exitosamente.');
    }

    /**
     * Muestra el detalle de un pedido específico.
     */
    public function show(Pedido $pedido)
    {
        return view('pedidos.show', compact('pedido'));
    }

    /**
     * Muestra el formulario para editar un pedido existente.
     */
    public function edit(Pedido $pedido)
    {
        return view('pedidos.edit', compact('pedido'));
    }

    /**
     * Actualiza el pedido en la base de datos.
     */
    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|url',
        ]);

        $data = $request->all();
        
        if (empty($data['image'])) {
            $data['image'] = 'https://via.placeholder.com/300x300.png?text=Sin+Imagen';
        }

        $pedido->update($data);

        return redirect()->route('pedidos.index')->with('success', 'Pedido actualizado exitosamente.');
    }

    /**
     * Elimina el pedido de la base de datos.
     */
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('pedidos.index')->with('success', 'Pedido eliminado exitosamente.');
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

        $pedido = Pedido::find($guia);
        
        if ($pedido) {
            $pedidos = collect([$pedido]);
        } else {
            $pedidos = collect([]);
            return view('pedidos.index', compact('pedidos'))->with('error', 'Pedido no encontrado.');
        }

        return view('pedidos.index', compact('pedidos'));
    }
}
