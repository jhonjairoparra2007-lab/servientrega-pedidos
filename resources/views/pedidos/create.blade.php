@extends('layouts.app')

@section('content')
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--gris-borde); padding-bottom: 1rem; margin-bottom: 1.5rem;">
        <h2 style="color: var(--rojo-servientrega); margin: 0;">Registrar Nuevo Pedido</h2>
        <a href="{{ route('pedidos.index') }}" class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.9rem;">Cancelar</a>
    </div>

    <!-- Mostrar errores de validación -->
    @if ($errors->any())
        <div class="alert alert-error">
            <ul style="margin-left: 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <style>
        .form-group { margin-bottom: 1.2rem; }
        .form-label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--gris-oscuro); }
        .form-control { width: 100%; padding: 0.8rem; border: 1px solid var(--gris-borde); border-radius: 4px; font-size: 1rem; }
        .form-control:focus { outline: none; border-color: var(--rojo-servientrega); }
        textarea.form-control { resize: vertical; min-height: 100px; }
    </style>

    <form action="{{ route('pedidos.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label">Nombre del Producto / Contenido *</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>
        
        <div class="form-group" style="display: flex; gap: 1rem;">
            <div style="flex: 1;">
                <label class="form-label">Precio Declarado (USD) *</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" required>
            </div>
            <div style="flex: 1;">
                <label class="form-label">Categoría</label>
                <input type="text" name="category" class="form-control" value="{{ old('category') }}">
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label">URL de la Imagen (Opcional)</label>
            <input type="url" name="image" class="form-control" value="{{ old('image') }}" placeholder="https://ejemplo.com/imagen.jpg">
        </div>
        
        <div class="form-group">
            <label class="form-label">Descripción Detallada</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        
        <div style="margin-top: 2rem;">
            <button type="submit" class="btn" style="width: 100%; padding: 1rem; font-size: 1.1rem;">Guardar Pedido</button>
        </div>
    </form>
</div>
@endsection
