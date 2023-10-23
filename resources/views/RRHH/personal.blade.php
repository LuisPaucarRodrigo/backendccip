@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
<h1>Usuarios</h1>
@stop

@section('content')

<div class="container">
    <div class="d-flex justify-content-end">
        <a type="button" href="/rrhh/nuevoUsuario" class="btn btn-success">+ Agregar Usuario</a>
        <a type="button" href="/rrhh/informacionpersonal/new" class="btn btn-primary ml-2">Agregar informacion</a>
        <a type="button" href="/rrhh/aporteregimen" class="btn btn-primary ml-2">Valores AFP</a>
        <a type="button" href="/rrhh/informacionpersonal/adicional" class="btn btn-warning ml-2">Agregar informacion adicional</a>
    </div>

    <br>
    <br>
    <table id="example" class="table table-striped">
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
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
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
                <td><a class="btn btn-warning" href="/rrhh/mostrarUsuario/{{$usuarios->id}}">Editar</a></td>
                <td><a class="btn btn-danger" href="/rrhh/delete/{{$usuarios->id}}">Eliminar</a></td>
            </tr>
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
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        function mostrarConfirmacion() {
            var confirmacion = window.confirm("¿Estás seguro de que deseas liquidar?");

            if (confirmacion) {
                window.location.href = "/home/liquidarUsuario";
            } else {
                // Aquí puedes manejar el caso en el que el usuario cancela la acción.
            }
        }
    </script>

    @stop