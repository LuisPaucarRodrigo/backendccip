@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
    <h1>Habitaciones</h1>
@stop

@section('content')
    <div class="container mt-5">
        @if(session('message'))
            <div class="alert {{ session('message_type', 'alert-success') }}">{{ session('message') }}</div>
        @endif
        <h2>Listado de Alquileres</h2>
        <div class="mb-3">
            <a href="/gastosfijos/alquileres/newregistro/Habitaciones" class="btn btn-primary">Nuevo Alquiler</a>
        </div>
        <div class="row">
            @foreach ($alquileres as $alquiler)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $alquiler['imagen_url'] }}" class="card-img-top" alt="{{ $alquiler['nombre_cliente'] }}">
                    <div class="card-body">
                        <p class="card-text"><strong>Nombre del Proveedor:</strong> {{ $alquiler['proveedor'] }}</p>
                        <p class="card-text"><strong>Control de Gastos:</strong> {{ $alquiler['control_gastos'] }}</p>
                        <p class="card-text"><strong>Zona:</strong> {{ $alquiler['zona'] }}</p>
                        <p class="card-text"><strong>Inicio de Alquiler:</strong> {{ $alquiler['inicio_alquiler'] }}</p>
                        <p class="card-text"><strong>Fin de Alquiler:</strong> {{ $alquiler['fin_alquiler'] }}</p>
                        <p class="card-text"><strong>Costo de Alquiler:</strong> S/{{ number_format($alquiler['costo_alquiler'], 2) }}</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $alquiler['id'] }}">Realizar Pago</button>
                    </div>
                </div>
                <div class="modal fade select" id="staticBackdrop{{ $alquiler['id'] }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="/gastosfijos/alquileres/pago">
                                @csrf
                                <input type="hidden" name="type" value="Habitaciones">
                                <input type="hidden" name="id" value="{{ $alquiler['id'] }}">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Realizar Pago</b></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body pt-0">
                                    <!-- Spinner que muestra más información al seleccionar una opción -->
                                    <div class="mt-0">
                                        <label class="col-form-label">Seleccionar opción</label>
                                        <select id="opcionSelect" class="form-select opcionSelect" name="opcion">
                                            <option value="" selected>Seleccione una opción</option>
                                            <option value="cuadrilla">Cuadrilla</option>
                                            <option value="otros">Otros</option>
                                        </select>
                                        <!-- Información adicional basada en la opción seleccionada -->
                                        <div id="cuadrillaForm" class="mt-3 cuadrillaForm" style="display: none;">
                                            <label class="col-form-label">Proveedor</label>
                                            <input name="proveedor" type="text" class="form-control" disabled value="{{ $alquiler['proveedor'] }}">

                                            <label class="col-form-label">Monto</label>
                                            <input name="monto" type="text" class="form-control" required placeholder="0.0">        

                                            <label class="col-form-label">Fecha</label>
                                            <input name="fecha" type="date" class="form-control" required>
                                            
                                            <label class="col-form-label">Número de Operación</label>
                                            <input name="operacion" type="text" class="form-control" required>

                                            <label class="col-form-label">Descripcion</label>
                                            <textarea name="descripcion" class="form-control" required></textarea>
                                            
                                            <!-- <label class="col-form-label">Zona</label>
                                            <select name="zona" class="form-select" required>
                                                <option value="Arequipa" selected>Arequipa</option>
                                                <option value="Moquegua">Moquegua</option>
                                                <option value="Chala">Chala</option>
                                                <option value="MDD1">MDD1</option>
                                                <option value="MDD2">MDD2</option>
                                            </select> -->
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-success" value="Pagar">
                                            </div>
                                        </div>
                                        <!-- Formulario para la Opción 2 -->
                                        <div id="otrosForm" class="mt-3 otrosForm" style="display: none;">
                                            <label class="col-form-label">Texto</label>
                                            <textarea name="texto_opcion2" class="form-control"></textarea>
                                            
                                            <label class="col-form-label">Cuadrilla</label>
                                            <select name="cuadrilla_opcion2" class="form-select">
                                                <option value="" selected>Seleccione una cuadrilla</option>
                                                <option value="cuadrilla1">Cuadrilla 1</option>
                                                <option value="cuadrilla2">Cuadrilla 2</option>
                                            </select>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-success" value="Pagar">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modals = document.querySelectorAll('.select');
            
            modals.forEach(modal => {
                const opcionSelect = modal.querySelector('.opcionSelect');
                const cuadrillaForm = modal.querySelector('.cuadrillaForm');
                const otrosForm = modal.querySelector('.otrosForm');
    
                opcionSelect.addEventListener('change', function () {
                    if (opcionSelect.value === 'cuadrilla') {
                        cuadrillaForm.style.display = 'block';
                        otrosForm.style.display = 'none';
                    } else if (opcionSelect.value === 'otros') {
                        cuadrillaForm.style.display = 'none';
                        otrosForm.style.display = 'block';
                    } else {
                        cuadrillaForm.style.display = 'none';
                        otrosForm.style.display = 'none';
                    }
                });
            });
        });
    </script>
@stop
