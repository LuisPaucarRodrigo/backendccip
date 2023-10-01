@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
    <h1>Personal</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="/rrhh/personal/newregister">
                            @csrf
                            <div class="form-group">
                                <label for="usuario_pensionario">Usuario</label>
                                <select class="form-control" id="usuario_pensionario" name="usuario_pensionario">
                                    <option value="Habitad">Habitad</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="regimen_pensionario">Regimen Pensionario</label>
                                <select class="form-control" id="regimen_pensionario" name="regimen_pensionario">
                                    <option value="Habitad">Habitad</option>
                                    <option value="Integra">Integra</option>
                                    <option value="Prima">Prima</option>
                                    <option value="Profuturo">Profuturo</option>
                                    <option value="Habitad MX">Habitad MX</option>
                                    <option value="Integra MX">Integra MX</option>
                                    <option value="Prima MX">Prima MX</option>
                                    <option value="Profuturo MX">Profuturo MX</option>
                                    <option value="ONP">ONP</option>
                                    <option value="Sin regimen">Sin regimen</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="fecha_ingreso">Fecha de Ingreso</label>
                                <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso">
                            </div>

                            <div class="form-group">
                                <label for="sueldo_base_cuspp">Sueldo Basico</label>
                                <input type="number" class="form-control" id="sueldo_base" name="sueldo_base">
                            </div>

                            <div class="form-group">
                                <label for="institucion_carrera">Institucion Educativa Superior</label>
                                <select class="form-control" id="institucion_carrera" name="institucion_carrera">
                                    <option value="Instituto">Instituto</option>
                                    <option value="Universidad">Universidad</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="donde_estudio">Nombre de Institucion</label>
                                <input type="text" class="form-control" id="donde_estudio" name="donde_estudio">
                            </div>

                            <div class="form-group">
                                <label for="donde_estudio">Carrera</label>
                                <input type="text" class="form-control" id="carrera_estudio" name="carrera_estudio">
                            </div>

                            <div class="form-group">
                                <label for="condicion_magister">Condición</label>
                                <select class="form-control" id="condicion_magister" name="condicion_magister">
                                    <option value="Magister">Magister</option>
                                    <option value="Disenciado">Disenciado</option>
                                </select>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="tiene_carga_familiar" name="tiene_carga_familiar">
                                <label class="form-check-label" for="tiene_carga_familiar">Tiene Carga Familiar</label>
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
