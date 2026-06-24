@extends('layouts.app')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 1.5rem; color: var(--rojo-servientrega);">Rastreo de Pedidos</h2>

    <!-- Mostrar mensajes de error si existen -->
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
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 1rem;
            }
            th, td {
                padding: 1rem;
                text-align: left;
                border-bottom: 1px solid var(--gris-borde);
            }
            th {
                background-color: var(--gris-claro);
                font-weight: 600;
                color: var(--gris-oscuro);
            }
            tr:hover {
                background-color: #f9f9f9;
            }
            .badge {
                display: inline-block;
                padding: 0.25rem 0.5rem;
                border-radius: 4px;
                background-color: #e2e8f0;
                font-size: 0.85rem;
                text-transform: capitalize;
            }
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
                <!-- Recorremos la variable $pedidos para imprimir cada fila -->
                @if(isset($pedidos) && count($pedidos) > 0)
                    @foreach($pedidos as $pedido)
                        <tr>
                            <td><strong>#{{ $pedido['id'] }}</strong></td>
                            <td>{{ Str::limit($pedido['title'], 40) }}</td>
                            <td><span class="badge">{{ $pedido['category'] }}</span></td>
                            <td>${{ number_format($pedido['price'], 2) }} USD</td>
                            <td>
                                <!-- Botón para ver el detalle del pedido -->
                                <a href="{{ route('pedidos.show', $pedido['id']) }}" class="btn" style="padding: 0.4rem 0.8rem; font-size: 0.9rem;">Ver Detalle</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 2rem;">
                            No se encontraron pedidos con los criterios especificados.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
