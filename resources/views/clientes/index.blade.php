@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-sm-6">
            <h1 class="m-0"><i class="fas fa-users text-primary mr-2"></i>Clientes</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('clientes.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-plus"></i> Nuevo Cliente
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
    <div class="card" style="border-top: 4px solid #D6E8F5;">
        <div class="card-header" style="background-color: #D6E8F5;">
            <h3 class="card-title" style="color: #4D7BA8;">👥 Listado de Clientes</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="tableclientes" class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Ciudad</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clientes as $cliente)
                            <tr>
                                <td><span class="badge badge-primary">{{ $cliente->id }}</span></td>
                                <td>
                                    @if($cliente->foto)
                                        <img src="{{ asset('storage/' . $cliente->foto) }}" alt="Foto" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                    @else
                                        <span class="badge badge-secondary"><i class="fas fa-user"></i></span>
                                    @endif
                                </td>
                                <td><strong>{{ $cliente->nombre }}</strong></td>
                                <td><a href="mailto:{{ $cliente->email }}">{{ $cliente->email }}</a></td>
                                <td>
                                    <a href="tel:{{ $cliente->telefono }}">{{ $cliente->telefono }}</a>
                                </td>
                                <td>{{ $cliente->ciudad ?? 'N/A' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-sm btn-info" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if(auth()->user()->isAdmin())
                                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar este cliente?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <p class="text-muted"><i class="fas fa-inbox fa-3x mb-3"></i><br>No hay clientes registrados</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Paginación Laravel -->
        <div class="card-footer">
            {{ $clientes->links() }}
        </div>
    </div>
@endsection

@push('js')
<script>
    $(function() {
        $('#tableclientes').DataTable({
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
