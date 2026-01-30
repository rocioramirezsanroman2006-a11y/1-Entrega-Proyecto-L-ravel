@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-sm-6">
            <h1 class="m-0"><i class="fas fa-shopping-cart text-danger mr-2"></i>Pedidos</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('pedidos.create') }}" class="btn btn-danger btn-lg">
                <i class="fas fa-plus"></i> Nuevo Pedido
            </a>
        </div>
    </div>

    <!-- Alert -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i>
            <strong>¡Éxito!</strong> {{ $message }}
            <button type="button" class="close" data-dismiss="alert">×</button>
        </div>
    @endif

    <!-- Table Card -->
    <div class="card" style="border-top: 4px solid #FFD6E8;">
        <div class="card-header" style="background-color: #FFD6E8;">
            <h3 class="card-title" style="color: #8B4D6D;">🛒 Listado de Pedidos ({{ $pedidos->count() }})</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th width="50">ID</th>
                            <th>Número Pedido</th>
                            <th>Cliente</th>
                            <th>Fecha Pedido</th>
                            <th>Fecha Entrega</th>
                            <th width="100">Total</th>
                            <th>Estado</th>
                            <th width="120" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pedidos as $pedido)
                            <tr>
                                <td><span class="badge badge-danger">{{ $pedido->id }}</span></td>
                                <td><strong>{{ $pedido->numero_pedido }}</strong></td>
                                <td>{{ $pedido->cliente->nombre }}</td>
                                <td>{{ $pedido->fecha_pedido->format('d/m/Y') }}</td>
                                <td>{{ $pedido->fecha_entrega ? $pedido->fecha_entrega->format('d/m/Y') : '-' }}</td>
                                <td><strong class="text-success">€{{ number_format($pedido->total, 2) }}</strong></td>
                                <td>
                                    @if($pedido->estado == 'pendiente')
                                        <span class="badge badge-secondary">Pendiente</span>
                                    @elseif($pedido->estado == 'en_proceso')
                                        <span class="badge badge-warning">En Proceso</span>
                                    @elseif($pedido->estado == 'completado')
                                        <span class="badge badge-success">Completado</span>
                                    @else
                                        <span class="badge badge-danger">Cancelado</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-sm btn-info" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar este pedido?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <p class="text-muted"><i class="fas fa-inbox fa-3x mb-3"></i><br>No hay pedidos registrados</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
