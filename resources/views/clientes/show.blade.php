@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Detalles del Cliente</h3>
                </div>
                <div class="card-body">
                    @if($cliente->foto)
                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/' . $cliente->foto) }}" alt="Foto del cliente" 
                                 style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 3px solid #FFD6E8;">
                        </div>
                    @endif
                    <div class="mb-3">
                        <strong>Nombre:</strong>
                        <p>{{ $cliente->nombre }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Apellido:</strong>
                        <p>{{ $cliente->apellido }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Email:</strong>
                        <p>{{ $cliente->email }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Teléfono:</strong>
                        <p>{{ $cliente->telefono }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Dirección:</strong>
                        <p>{{ $cliente->direccion }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Fecha de Registro:</strong>
                        <p>{{ $cliente->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary">Editar</a>
                        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection