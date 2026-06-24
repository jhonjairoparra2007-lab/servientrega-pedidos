@extends('layouts.app')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
        <h2 style="color: var(--rojo-servientrega); margin: 0;">Rastreo y Gestión de Pedidos</h2>
        <a href="{{ route('pedidos.create') }}" class="btn" style="background-color: #15803d;">+ Nuevo Pedido</a>
    </div>

    <!-- Mostrar mensajes de éxito o error -->
    @if(session('success'))
        <div class="alert" style="background-color: #dcfce7; color: #166534; border: 1px solid #bbf7d0;">
            {{ session('success') }}
        </div>
    @endif
    @if(isset($error) || session('error'))
        <div class="alert alert-error">
            {{ $error ?? session('error') }}
        </div>
    @endif

    <!-- Formulario de búsqueda por número de guía -->
    <form action="{{ route('pedidos.buscar') }}" method="GET" class="search-form">
        <input type="text" name="guia" class="search-input" placeholder="Ingrese número de guía (ej. 1, 2, 3...)" required value="{{ request('guia') }}">
        <button type="submit" class="btn">Buscar Guía</button>
        @if(request()->has('guia'))
            <a href="{{ route('pedidos.index') }}" class="btn btn-outline" style="text-decoration: none;">Ver Todos</a>
        @endif
    </form>

    <!-- Tabla de resultados -->
    <div style="overflow-x: auto;">
        <style>
            table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
            th, td { padding: 1rem; text-align: left; border-bottom: 1px solid var(--gris-borde); }
            th { background-color: var(--gris-claro); font-weight: 600; color: var(--gris-oscuro); }
            tr:hover { background-color: #f9f9f9; }
            .badge { display: inline-block; padding: 0.25rem 0.5rem; border-radius: 4px; background-color: #e2e8f0; font-size: 0.85rem; text-transform: capitalize; }
            .acciones-btns { display: flex; gap: 0.5rem; flex-wrap: wrap; }
            .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.85rem; }
            .btn-edit { background-color: #2563eb; }
            .btn-edit:hover { background-color: #1d4ed8; }
            .btn-delete { background-color: #dc2626; border: none; color: white; cursor: pointer; border-radius: 4px; transition: 0.3s; padding: 0.3rem 0.6rem; font-size: 0.85rem; }
            .btn-delete:hover { background-color: #b91c1c; }
        </style>
        
        <table>
            <thead>
                <tr>
                    <th>Guía (ID)</th>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Precio Declarado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($pedidos) && count($pedidos) > 0)
                    @foreach($pedidos as $pedido)
                        <tr>
                            <td><strong>#{{ $pedido->id }}</strong></td>
                            <td>{{ Str::limit($pedido->title, 40) }}</td>
                            <td><span class="badge">{{ $pedido->category ?: 'Sin categoría' }}</span></td>
                            <td>${{ number_format($pedido->price, 2) }} USD</td>
                            <td>
                                <div class="acciones-btns">
                                    <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-sm">Ver</a>
                                    <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-sm btn-edit">Editar</a>
                                    <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de que desea eliminar este pedido?');" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 2rem;">
                            No se encontraron pedidos en el sistema.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
