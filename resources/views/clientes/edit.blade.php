@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Modificar Cliente</h1>
    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre" class="control-label">Nombre</label>
            <div>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" required>
                @error('nombre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="apellido" class="control-label">Apellido</label>
            <div>
                <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido" name="apellido" value="{{ old('apellido', $cliente->apellido) }}" required>
                @error('apellido')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="control-label">Correo Electrónico</label>
            <div>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $cliente->email) }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="telefono" class="control-label">Teléfono</label>
            <div>
                <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono', $cliente->telefono) }}">
                @error('telefono')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="direccion" class="control-label">Dirección</label>
            <div>
                <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion" value="{{ old('direccion', $cliente->direccion) }}">
                @error('direccion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="foto" class="control-label">Foto de Perfil</label>
            <div>
                @if ($cliente->foto)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $cliente->foto) }}" alt="Foto actual" style="max-width: 150px; border-radius: 5px;">
                        <p class="text-muted">Foto actual</p>
                    </div>
                @endif
                <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*">
                <small class="form-text text-muted">Archivos permitidos: JPEG, PNG, JPG, GIF (máx. 2MB)</small>
                @error('foto')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
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
