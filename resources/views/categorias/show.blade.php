@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Detalles de la Categoría</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Nombre:</strong>
                        <p>{{ $categoria->nombre }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Descripción:</strong>
                        <p>{{ $categoria->descripcion ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Fecha de Creación:</strong>
                        <p>{{ $categoria->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-primary">Editar</a>
                        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
