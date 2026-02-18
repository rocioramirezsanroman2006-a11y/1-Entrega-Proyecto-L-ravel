@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-sm-6">
            <h1 class="m-0"><i class="fas fa-box text-warning mr-2"></i>Productos</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('productos.create') }}" class="btn btn-warning btn-lg">
                <i class="fas fa-plus"></i> Nuevo Producto
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

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <strong>¡Error!</strong> {{ $message }}
            <button type="button" class="close" data-dismiss="alert">×</button>
        </div>
    @endif

    <!-- Table Card -->
    <div class="card" style="border-top: 4px solid #D6F5E8;">
        <div class="card-header" style="background-color: #D6F5E8;">
            <h3 class="card-title" style="color: #4D8B7A;">📦 Listado de Productos</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="tablaproductos" class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>PDF</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productos as $producto)
                            <tr>
                                <td><span class="badge badge-warning">{{ $producto->id }}</span></td>
                                <td>
                                    @if($producto->imagen)
                                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen" style="width: 40px; height: 40px; border-radius: 5px; object-fit: cover;">
                                    @else
                                        <span class="badge badge-secondary"><i class="fas fa-box"></i></span>
                                    @endif
                                </td>
                                <td><strong>{{ $producto->nombre }}</strong></td>
                                <td><small>{{ Str::limit($producto->descripcion, 40) }}</small></td>
                                <td><span class="badge badge-secondary">{{ $producto->categoria->nombre ?? 'N/A' }}</span></td>
                                <td><strong class="text-success">€{{ number_format($producto->precio, 2) }}</strong></td>
                                <td>
                                    <span class="badge {{ $producto->stock > 20 ? 'badge-success' : ($producto->stock > 5 ? 'badge-warning' : 'badge-danger') }}">
                                        {{ $producto->stock }}
                                    </span>
                                </td>
                                <td>
                                    @if($producto->archivo_pdf)
                                        <a href="{{ asset('storage/' . $producto->archivo_pdf) }}" target="_blank" class="btn btn-sm btn-outline-danger" title="Ver PDF">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-sm btn-info" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if(auth()->user()->isAdmin())
                                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar este producto?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    <p class="text-muted"><i class="fas fa-inbox fa-3x mb-3"></i><br>No hay productos registrados</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Paginación Laravel -->
        <div class="card-footer">
            {{ $productos->links() }}
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(function() {
        $('#tablaproductos').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            "paging": false,
            "info": false,
            "responsive": true
        });
    });
</script>
@endpush
