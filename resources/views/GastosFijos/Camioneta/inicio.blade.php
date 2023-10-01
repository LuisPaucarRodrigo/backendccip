@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
    <h1>Camioneta</h1>
@stop

@section('content')
    <div class="container mt-5">
        <h2>Listado de Alquileres</h2>
        <div class="mb-3">
            <a href="/gastosfijos/camioneta/newrent" class="btn btn-primary">Nuevo Alquiler</a>
        </div>
        <div class="row">
            @foreach ($alquileres as $alquiler)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $alquiler['imagen_url'] }}" class="card-img-top" alt="{{ $alquiler['nombre_cliente'] }}">
                    <div class="card-body">
                        <h3 class="card-title">{{ $alquiler['nombre'] }}</h3>
                        <p class="card-text"><strong>Control de Gastos:</strong> {{ $alquiler['control_gastos'] }}</p>
                        <p class="card-text"><strong>Zona:</strong> {{ $alquiler['zona'] }}</p>
                        <p class="card-text"><strong>Inicio de Alquiler:</strong> {{ $alquiler['inicio_alquiler'] }}</p>
                        <p class="card-text"><strong>Fin de Alquiler:</strong> {{ $alquiler['fin_alquiler'] }}</p>
                        <p class="card-text"><strong>Costo de Alquiler:</strong> ${{ number_format($alquiler['costo_alquiler'], 2) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
@stop
