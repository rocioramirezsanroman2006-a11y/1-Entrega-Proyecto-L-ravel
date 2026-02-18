@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Detalles del Empleado</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Nombre:</strong>
                        <p>{{ $empleado->nombre }} {{ $empleado->apellido }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Email:</strong>
                        <p>{{ $empleado->email }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Puesto:</strong>
                        <p>{{ $empleado->puesto }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Salario:</strong>
                        <p>${{ number_format($empleado->salario, 2) }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Teléfono:</strong>
                        <p>{{ $empleado->telefono ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Fecha de Inicio:</strong>
                        <p>{{ $empleado->fecha_contratacion ? $empleado->fecha_contratacion->format('d/m/Y') : 'N/A' }}</p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-primary">Editar</a>
                        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
