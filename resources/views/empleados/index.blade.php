@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-sm-6">
            <h1 class="m-0"><i class="fas fa-user-tie text-info mr-2"></i>Empleados</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('empleados.create') }}" class="btn btn-info btn-lg">
                <i class="fas fa-plus"></i> Nuevo Empleado
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
    <div class="card" style="border-top: 4px solid #E8D6F5;">
        <div class="card-header" style="background-color: #E8D6F5;">
            <h3 class="card-title" style="color: #7A4D8B;">👔 Listado de Empleados</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="tablaemp" class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Puesto</th>
                            <th>Departamento</th>
                            <th>Salario</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($empleados as $empleado)
                            <tr>
                                <td><span class="badge badge-info">{{ $empleado->id }}</span></td>
                                <td><strong>{{ $empleado->nombre }}</strong></td>
                                <td><a href="mailto:{{ $empleado->email }}">{{ $empleado->email }}</a></td>
                                <td>{{ $empleado->puesto }}</td>
                                <td><span class="badge badge-secondary">{{ $empleado->departamento }}</span></td>
                                <td><strong class="text-success">€{{ number_format($empleado->salario, 2) }}</strong></td>
                                <td class="text-center">
                                    <a href="{{ route('empleados.show', $empleado->id) }}" class="btn btn-sm btn-info" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if(auth()->user()->isAdmin())
                                    <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar este empleado?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <p class="text-muted"><i class="fas fa-inbox fa-3x mb-3"></i><br>No hay empleados registrados</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Paginación Laravel -->
        <div class="card-footer">
            {{ $empleados->links() }}
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(function() {
        $('#tablaemp').DataTable({
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
