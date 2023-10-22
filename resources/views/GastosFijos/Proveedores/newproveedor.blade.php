@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
    <h1>Registrar Proveedor</h1>
@stop

@section('content')
<div class="container">
        <form method="POST" action="{{ route('proveedores.newcreate') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="razon_social">Razón Social:</label>
                        <input type="text" class="form-control" id="razon_social" name="razon_social" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="numero_cuenta">Número de Cuenta:</label>
                        <input type="text" class="form-control" id="numero_cuenta" name="numero_cuenta" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                <label for="banco">Banco:</label>
                <input type="text" class="form-control" id="banco" name="banco" required>
            </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="rubro">Rubro:</label>
                <input type="text" class="form-control" id="rubro" name="rubro" required>
            </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">  
                <div class="form-group">
                <label for="subrubro">Subrubro:</label>
                <input type="text" class="form-control" id="subrubro" name="subrubro" required>
            </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="contacto">Contacto:</label>
                <input type="text" class="form-control" id="contacto" name="contacto" required>
            </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
@stop
