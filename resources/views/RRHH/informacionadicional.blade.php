@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
    <h1>Planilla</h1>
@stop

@section('content')
@php
    $x = 1;
@endphp
<div class="container">
    <form action="/rrhh/informacionadicional" method="post">
        @csrf
        <div class="form-group">
            <label for="usuario_id">Usuario</label>
            <select class="form-control" id="usuario_id" name="usuario_id">s
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="vacaciones_truncas">VACACIONES TRUNCAS</label>
            <input type="text" class="form-control" id="vacaciones_truncas" name="vacaciones_truncas" placeholder="Ingrese las vacaciones truncas">
        </div>

        <div class="form-group">
            <label for="subsidios_maternidad">SUBSIDIOS POR MATERNIDAD</label>
            <input type="text" class="form-control" id="subsidios_maternidad" name="subsidios_maternidad" placeholder="Ingrese los subsidios por maternidad">
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
@stop
