@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Alerta de error -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="justify-content-between">
            <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#notificationmodal">+ Notificar</a>
            <button type="button" class="btn btn-warning text-end" onclick="mostrarConfirmacion()">Liquidar</button>
        </div>
        <div class="modal fade" id="notificationmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="notificationmodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="/home/notification">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Enviar notificación</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="notificationTitle">Título:</label>
                                <input type="text" class="form-control" id="notificationTitle" name="notificationTitle">
                            </div>
                            <div class="form-group">
                                <label for="notificationText">Notificación:</label>
                                <textarea class="form-control" id="notificationText" name="notificationText" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Enviar</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <br>
        <br>
        <table id="example" class="table table-striped" >
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Nombre de Usuario</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Depositos Acumulado del Mes</th>
                    <th scope="col">Egresos Acumulados del Mes</th>
                    <th scope="col">Saldo</th>
                    <th scope="col">Recargar</th>
                </tr>
            </thead>
            <tbody>
            @foreach($usuarios as $usuarios)
                <tr class="tr">
                    <td>{{$usuarios->name}}</td>
                    <td>{{$usuarios->lastname}}</td>
                    <td>{{$usuarios->dni}}</td>
                    <td>{{$usuarios->username}}</td>
                    <td>{{$usuarios->email}}</td>
                    <td>{{$usuarios->estado}}</td>
                    <td>S/{{$usuarios->monto_total}}</td>
                    <td>S/{{$usuarios->egresos}}</td>
                    <td>S/{{$usuarios->saldo}}</td>
                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$usuarios->id}}">Recargar</button></td>
                </tr>
                <div class="modal fade select" id="staticBackdrop{{$usuarios->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="/home/recargar/users">
                                @csrf
                                <input type="hidden" name="usuario_id" value="{{$usuarios->id}}">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Realizar recarga</b></h1>
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
                                            <label class="col-form-label">Usuario</label>
                                            <input name="usuario_cuadrilla" type="text" class="form-control" disabled value="{{$usuarios->name}}">

                                            <label class="col-form-label">Monto</label>
                                            <input name="recarga" type="text" class="form-control" required placeholder="0.0">        

                                            <label class="col-form-label">Fecha</label>
                                            <input name="dateCuadrilla" type="date" class="form-control" required>
                                            
                                            <label class="col-form-label">Número de Operación</label>
                                            <input name="operationCuadrilla" type="text" class="form-control" required>

                                            <label class="col-form-label">Texto</label>
                                            <textarea name="textCuadrilla" class="form-control" required></textarea>
                                            
                                            <label class="col-form-label">Cuadrilla</label>
                                            <select name="selectCuadrilla" class="form-select" required>
                                                <option value="" selected>Seleccione una cuadrilla</option>
                                                <option value="Arequipa">Arequipa</option>
                                                <option value="Moquegua">Moquegua</option>
                                                <option value="Chala">Chala</option>
                                                <option value="MDD1">MDD1</option>
                                                <option value="MDD2">MDD2</option>
                                            </select>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-success" value="Recargar">
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
                                                <input type="submit" class="btn btn-success" value="Recargar">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
        <div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@stop

@section('js')
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
    <script>
        function mostrarConfirmacion() {
            var confirmacion = window.confirm("¿Estás seguro de que deseas liquidar?");
            
            if (confirmacion) {
                window.location.href = "/rrhh/liquidarUsuario";
            } else {
                // Aquí puedes manejar el caso en el que el usuario cancela la acción.
            }
        }
    </script>

@stop

