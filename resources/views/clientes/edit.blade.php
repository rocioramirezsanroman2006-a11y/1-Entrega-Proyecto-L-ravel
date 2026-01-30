@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Modificar Usuario</h1>
    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST" class="form-horizontal">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre" class="control-label">Nombre</label>
            <div>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" required>
                @if ($errors->has('nombre'))
                    <span class="text-danger">{{ $errors->first('nombre') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="apellido" class="control-label">Apellido</label>
            <div>
                <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido', $cliente->apellido) }}" required>
                @if ($errors->has('apellido'))
                    <span class="text-danger">{{ $errors->first('apellido') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="control-label">Correo Electrónico</label>
            <div>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $cliente->email) }}" required>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="telefono" class="control-label">Teléfono</label>
            <div>
                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $cliente->telefono) }}">
                @if ($errors->has('telefono'))
                    <span class="text-danger">{{ $errors->first('telefono') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="direccion" class="control-label">Dirección</label>
            <div>
                <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion', $cliente->direccion) }}">
                @if ($errors->has('direccion'))
                    <span class="text-danger">{{ $errors->first('direccion') }}</span>
                @endif
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Guardar Cambios</button>
            <a href="{{ route('clientes.index') }}" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
</div>
@endsection

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
