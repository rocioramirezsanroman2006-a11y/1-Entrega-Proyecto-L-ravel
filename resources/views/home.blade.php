@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card" style="background: linear-gradient(135deg, #FFD6E8 0%, #FFE8F3 100%); border: none;">
                <div class="card-body">
                    <h2 style="color: #8B4D6D;" class="mb-2">💎 ¡Bienvenido, {{ Auth::user()->name }}!</h2>
                    <p style="color: #A87BA8;">Panel de Control - TechPink Hub Gestión Empresarial</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card card-outline" style="border-top: 4px solid #D6E8F5;">
                <div class="card-body text-center">
                    <div style="color: #4D7BA8;" class="mb-2">
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                    <h5 class="card-title" style="color: #8B4D6D;">Total Clientes</h5>
                    <h2 style="color: #4D7BA8;">{{ App\Models\Clientes::count() }}</h2>
                </div>
                <div class="card-footer bg-light" style="background-color: #D6E8F5 !important;">
                    <a href="{{ route('clientes.index') }}" class="btn-clientes btn btn-sm btn-block">Ver todos →</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card card-outline" style="border-top: 4px solid #E8D6F5;">
                <div class="card-body text-center">
                    <div style="color: #7A4D8B;" class="mb-2">
                        <i class="fas fa-user-tie fa-3x"></i>
                    </div>
                    <h5 class="card-title" style="color: #8B4D6D;">Total Empleados</h5>
                    <h2 class="text-info">{{ App\Models\Empleado::count() }}</h2>
                </div>
                <div class="card-footer bg-info text-white text-center">
                    <a href="{{ route('empleados.index') }}" class="text-white">Ver todos →</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card card-warning card-outline">
                <div class="card-body text-center">
                    <div class="text-warning mb-2">
                        <i class="fas fa-box fa-3x"></i>
                    </div>
                    <h5 class="card-title">Total Productos</h5>
                    <h2 class="text-warning">{{ App\Models\Productos::count() }}</h2>
                </div>
                <div class="card-footer bg-warning text-white text-center">
                    <a href="{{ route('productos.index') }}" class="text-white">Ver todos →</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card card-danger card-outline">
                <div class="card-body text-center">
                    <div class="text-danger mb-2">
                        <i class="fas fa-shopping-cart fa-3x"></i>
                    </div>
                    <h5 class="card-title">Total Pedidos</h5>
                    <h2 class="text-danger">{{ App\Models\Pedido::count() }}</h2>
                </div>
                <div class="card-footer bg-danger text-white text-center">
                    <a href="{{ route('pedidos.index') }}" class="text-white">Ver todos →</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title">Acciones Rápidas</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('clientes.create') }}" class="list-group-item list-group-item-action mb-2">
                            <i class="fas fa-plus-circle text-success mr-2"></i> Nuevo Cliente
                        </a>
                        <a href="{{ route('empleados.create') }}" class="list-group-item list-group-item-action mb-2">
                            <i class="fas fa-plus-circle text-info mr-2"></i> Nuevo Empleado
                        </a>
                        <a href="{{ route('productos.create') }}" class="list-group-item list-group-item-action mb-2">
                            <i class="fas fa-plus-circle text-warning mr-2"></i> Nuevo Producto
                        </a>
                        <a href="{{ route('pedidos.create') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-plus-circle text-danger mr-2"></i> Nuevo Pedido
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card card-secondary card-outline">
                <div class="card-header">
                    <h5 class="card-title">Últimos Pedidos</h5>
                </div>
                <div class="card-body">
                    @php
                        $pedidos = App\Models\Pedido::latest()->take(5)->get();
                    @endphp
                    @forelse($pedidos as $pedido)
                        <div class="pb-2 mb-2 border-bottom">
                            <div class="d-flex justify-content-between">
                                <strong>{{ $pedido->numero_pedido }}</strong>
                                <span class="badge badge-{{ $pedido->estado == 'completado' ? 'success' : ($pedido->estado == 'en_proceso' ? 'warning' : ($pedido->estado == 'cancelado' ? 'danger' : 'info')) }}">
                                    {{ ucfirst(str_replace('_', ' ', $pedido->estado)) }}
                                </span>
                            </div>
                            <small class="text-muted">
                                {{ $pedido->fecha_pedido->format('d/m/Y') }} - ${{ number_format($pedido->total, 2) }}
                            </small>
                        </div>
                    @empty
                        <p class="text-muted text-center">No hay pedidos registrados</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}
</style>
@endsection
