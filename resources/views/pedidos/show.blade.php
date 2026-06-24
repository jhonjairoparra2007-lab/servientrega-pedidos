@extends('layouts.app')

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--gris-borde); padding-bottom: 1rem; margin-bottom: 1.5rem;">
        <h2 style="color: var(--rojo-servientrega); margin: 0;">Detalle de la Guía #{{ $pedido->id }}</h2>
        <div style="display: flex; gap: 0.5rem;">
            <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn" style="background-color: #2563eb; padding: 0.4rem 0.8rem; font-size: 0.9rem;">Editar</a>
            <a href="{{ route('pedidos.index') }}" class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.9rem;">Volver</a>
        </div>
    </div>

    <style>
        .detalle-container { display: flex; gap: 2rem; align-items: flex-start; }
        .detalle-imagen { flex: 0 0 300px; background: var(--blanco); padding: 1rem; border: 1px solid var(--gris-borde); border-radius: 8px; text-align: center; }
        .detalle-imagen img { max-width: 100%; height: auto; max-height: 300px; object-fit: contain; }
        .detalle-info { flex: 1; }
        .info-row { margin-bottom: 1rem; }
        .info-label { font-weight: 600; color: var(--gris-oscuro); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.3rem; display: block; }
        .info-value { font-size: 1.1rem; color: #111; }
        .precio-tag { font-size: 1.5rem; font-weight: bold; color: #15803d; }
        @media (max-width: 600px) {
            .detalle-container { flex-direction: column; }
            .detalle-imagen { flex: 1 1 auto; width: 100%; }
        }
    </style>

    <div class="detalle-container">
        <!-- Imagen del producto -->
        <div class="detalle-imagen">
            <img src="{{ $pedido->image }}" alt="Imagen del pedido {{ $pedido->title }}" onerror="this.src='https://via.placeholder.com/300x300.png?text=Sin+Imagen'">
        </div>
        
        <!-- Información del pedido -->
        <div class="detalle-info">
            <div class="info-row">
                <span class="info-label">Producto Transportado</span>
                <div class="info-value">{{ $pedido->title }}</div>
            </div>
            
            <div class="info-row">
                <span class="info-label">Categoría</span>
                <div class="info-value" style="text-transform: capitalize;">{{ $pedido->category ?: 'N/A' }}</div>
            </div>
            
            <div class="info-row">
                <span class="info-label">Descripción del Contenido</span>
                <div class="info-value" style="font-size: 0.95rem; line-height: 1.5; color: #555;">
                    {{ $pedido->description ?: 'Sin descripción' }}
                </div>
            </div>
            
            <div class="info-row">
                <span class="info-label">Valor Declarado</span>
                <div class="info-value precio-tag">
                    ${{ number_format($pedido->price, 2) }} USD
                </div>
            </div>
            
            <!-- Estado simulado (ficticio) -->
            <div class="info-row" style="margin-top: 2rem; padding-top: 1rem; border-top: 1px dashed var(--gris-borde);">
                <span class="info-label">Estado del Envío</span>
                <div class="info-value" style="color: var(--rojo-servientrega); font-weight: bold; display: flex; align-items: center; gap: 0.5rem;">
                    <span style="display: inline-block; width: 12px; height: 12px; border-radius: 50%; background-color: var(--rojo-servientrega);"></span>
                    En Tránsito
                </div>
            </div>
            
            <div class="info-row" style="margin-top: 1rem; font-size: 0.85rem; color: #666;">
                <p><strong>Registrado el:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Última actualización:</strong> {{ $pedido->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
