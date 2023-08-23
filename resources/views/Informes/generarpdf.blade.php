@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
    <h1>Generar Informes Pdf</h1>
@stop

@section('content')
<form action="/home/informes/generatepdf" enctype="multipart/form-data" method="post">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Usuarios</h3>
                </div>
                <div class="card-body">
                    <select class="form-control" name="usuariospdf" id="select-users">
                        <!-- Aquí puedes llenar las opciones con los usuarios obtenidos de tu API -->
                        @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                        @endforeach
                        <!-- ... Agregar más usuarios aquí ... -->
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rango de Fechas</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="input-start-date">Fecha de inicio:</label>
                        <input type="date" class="form-control" name="fecha_inicio" id="input-start-date">
                    </div>
                    <div class="form-group">
                        <label for="input-end-date">Fecha de fin:</label>
                        <input type="date" class="form-control" name="fecha_fin" id="input-end-date">
                    </div>
                </div>
                
                <!-- Botón de color verde debajo de Usuarios -->
                <button type="submit" class="btn btn-success mt-3">Generar</button>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Aquí puedes agregar el código JavaScript para manejar los eventos del select y el input
        });
    </script>
@stop
