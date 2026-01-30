@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Detalles del Pedido</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>ID Pedido:</strong>
                        <p>#{{ $pedido->id }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Cliente:</strong>
                        <p>{{ $pedido->cliente->nombre }} {{ $pedido->cliente->apellido }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Fecha del Pedido:</strong>
                        <p>{{ $pedido->fecha_pedido->format('d/m/Y') }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Total:</strong>
                        <p>€{{ number_format($pedido->total, 2) }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Estado:</strong>
                        <p>
                            @if($pedido->estado == 'pendiente')
                                <span class="badge badge-warning">Pendiente</span>
                            @elseif($pedido->estado == 'completado')
                                <span class="badge badge-success">Completado</span>
                            @else
                                <span class="badge badge-danger">Cancelado</span>
                            @endif
                        </p>
                    </div>
                    <div class="mb-3">
                        <strong>Notas:</strong>
                        <p>{{ $pedido->notas ?? 'N/A' }}</p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-primary">Editar</a>
                        <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
