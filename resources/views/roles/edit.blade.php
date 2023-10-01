@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
<h1>Editar Rol</h1>

@stop

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col">
            <form action="/home/role/update" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $role->id }}">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Ingrese su nombre del rol" value="{{ $role->name }}">
                </div>
                <div class="mb-3">
                    <label for="opciones" class="form-label">Opciones</label>
                    <div>
                        <!-- Ejemplo de bucle foreach para crear casillas de verificación -->
                        @foreach ($permissions as $permission)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $permission->name }}" name="operaciones[]" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                <label class="form-check-label">{{ $permission->description }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Editar Rol</button>
            </form>
            </div>
        </div>
    </div>
@stop

@section('css')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@stop

@section('js')
    
@stop