@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
    <h1>Generar Reportes Excel</h1>
@stop

@section('content')
    <div class="container col-12 col-md-8 col-lg-6 col-xl-7">
        <div class="card-body p-5 text-center">
            <form action="/home/generate" enctype="multipart/form-data" method="post" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label class="form-label" for="exampleInputEmail1">Desde:</label>
                    <input class="form-control text-center" type="date" name="inicio" aria-describedby="emailHelp" value="{{ old('inicio') }}">
                    @if ($errors->get('inicio'))
                        @foreach ($errors->get('inicio') as $error)
                            <p class="text-danger">
                                {{$error}}
                            </p>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="exampleInputPassword1" >Hasta:</label>
                    <input class="form-control text-center" type="date" name="fin" aria-describedby="emailHelp" value="{{ old('fin') }}" >
                    @if ($errors->get('fin'))
                        @foreach ($errors->get('fin') as $error)
                            <p class="text-danger">
                                {{$error}}
                            </p>
                        @endforeach
                    @endif
                    <br>
                </div>
                <div class="container text-center">
                    <div class="col align-self-center">
                        <label class="form-label" >Tabla</label>
                        <select class="form-select" id="tabla" aria-label="Default select example" name="tabla" required>
                            <option value="Operaciones" selected>General</option>
                            <option value="Combustible">Combustible</option>
                            <option value="2">Traslado</option>
                            <option value="Peaje">Peaje</option>
                            <option value="Otros">Otros</option>
                            <option value="Cgep">Cgep</option>
                            <option value="6">Recargas</option>
                            <option value="7">Tareas</option>
                            <option value="8">Control Kit Herramientas</option>
                            <option value="9">Control Equipos de Herramientas</option>
                            <option value="10">Control de EPP</option>
                            <option value="11">Documentos Movil</option>
                            <option value="12">Checklist Equipamento Movil</option>
                            <option value="13">Checklist Unidad Movil</option>
                        </select>
                    </div>
                    <br>
                </div>
                <div class="container text-center">
                    <div class="col align-self-center">
                        <select class="form-select" id="tabla" aria-label="Default select example" name="usuarios" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $usuario ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                </div>
                <div class="row">
                    <div class="col">
                        <button class="btn btn-success" name="submit" value="generar" id="btn" type="submit">Generar Excel</button>
                        <button class="btn btn-warning" name="submit" value="previsualizacion" type="submit">Previsualizacion</button>
                    </div>
                </div>
            </form>
            @if(isset($result)) <!-- Verifica si tienes datos para mostrar -->
            <div class="mt-5">
                <h2>Tabla de Gastos</h2>
                <table class="table">
                    <thead>
                        <tr>
                        @foreach($columnas as $columnaNombre => $columnaTitulo)
                            <th>{{ $columnaTitulo }}</th>
                        @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalMonto = 0; 
                        @endphp
                        @foreach($result as $dato)
                        <tr>
                            <td>{{ $dato->id }}</td>
                            <td>{{ $dato->monto_total }}</td>
                            <td>{{ $dato->fecha_documento }}</td>
                            <td>{{ $dato->cuadrilla }}</td>
                            <td>{{ $dato->concepto }}</td>
                            @php
                                $totalMonto += $dato->monto_total;
                            @endphp
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>Total: {{ $totalMonto }}</p>
                <p>Recarga total: {{ $recargatotal->monto_total }}</p>
            </div>
            @endif
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
@stop
