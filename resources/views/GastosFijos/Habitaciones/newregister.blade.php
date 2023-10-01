@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
    <h1>Habitaciones</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Agregar Información</div>
                    <div class="card-body">
                        <form method="POST" action="/gastosfijos/habitaciones/saverent">
                            @csrf
                            <div class="form-group">
                                <label for="zona">Control de Gastos</label>
                                <select id="control_gastos" class="form-control" name="control_gastos">
                                    <option value="Cicsa_claro_pint" {{ $controlgastos === 'Cicsa_claro_pint' ? 'selected' : '' }}>Cicsa Claro Pint</option>
                                    <option value="Cicsa_claro_pxt" {{ $controlgastos === 'Cicsa_claro_pxt' ? 'selected' : '' }}>Cicsa Claro Pxt</option>
                                    <option value="Cicsa_gtd" {{ $controlgastos === 'Cicsa_gtd' ? 'selected' : '' }}>Cicsa Gtd</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="zona">Zona</label>
                                <select id="zonaSelect" class="form-control" name="zona">
                                    <option value="Arequipa" {{ $zona === 'Arequipa' ? 'selected' : '' }}>Arequipa</option>
                                    <option value="Mazuko" {{ $zona === 'Mazuko' ? 'selected' : '' }}>Mazuko</option>
                                    <option value="Chala" {{ $zona === 'Chala' ? 'selected' : '' }}>Chala</option>
                                    <option value="Moquegua" {{ $zona === 'Moquegua' ? 'selected' : '' }}>Moquegua</option>
                                    <option value="Puerto" {{ $zona === 'Puerto' ? 'selected' : '' }}>Puerto</option>
                                </select>
                            </div>



                            <div class="form-group">
                                <label for="nombre">Nombre del Cliente:</label>
                                <input type="text" class="form-control" id="nombre" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="inicio_alquiler">Inicio de Alquiler</label>
                                <input type="date" class="form-control" id="inicio_alquiler" name="inicio_alquiler">
                            </div>

                            <div class="form-group">
                                <label for="fin_alquiler">Fin de Alquiler</label>
                                <input type="date" class="form-control" id="fin_alquiler" name="fin_alquiler">
                            </div>

                            <div class="form-group">
                                <label for="costo_alquiler">Costo de Alquiler</label>
                                <input type="number" class="form-control" id="costo_alquiler" name="costo_alquiler" placeholder="0.00">
                            </div>

                            <div class="form-group">
                                <label for="garantia">Garantía</label>
                                <input type="number" class="form-control" id="garantia" name="garantia" placeholder="0.00">
                            </div>

                            <div class="form-group">
                                <label for="contrato">Contrato</label>
                                <input type="text" class="form-control" id="contrato" name="contrato">
                            </div>

                            <div class="form-group">
                                <label for="fecha_pago">Fecha de Pago</label>
                                <input type="date" class="form-control" id="fecha_pago" name="fecha_pago">
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
@stop
