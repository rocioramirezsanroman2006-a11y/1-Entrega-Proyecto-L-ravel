@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Detalles del Producto</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Nombre:</strong>
                        <p>{{ $producto->nombre }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Descripción:</strong>
                        <p>{{ $producto->descripcion }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Precio:</strong>
                        <p>${{ number_format($producto->precio, 2) }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Stock:</strong>
                        <p>{{ $producto->stock }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Fecha de Creación:</strong>
                        <p>{{ $producto->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary">Editar</a>
                        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
