@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
    <h1>Proveedores</h1>
@stop

@section('content')
<div class="container">
    <h1>Listado de Proveedores</h1>
    <a href="{{ route('proveedores.create') }}" class="btn btn-success">Agregar Nuevo Proveedor</a>
    <table class="table">
        <thead>
            <tr>
                <th>Razón Social</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>N de Cuenta</th>
                <th>Banco</th>
                <th>Rubro</th>
                <th>SubRubro</th>
                <th>Contacto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $supplier)
            <tr>
                <td>{{ $supplier->razon_social }}</td>
                <td>{{ $supplier->telefono }}</td>
                <td>{{ $supplier->correo }}</td>
                <td>{{ $supplier->numero_cuenta }}</td>
                <td>{{ $supplier->banco }}</td>
                <td>{{ $supplier->rubro }}</td>
                <td>{{ $supplier->subrubro }}</td>
                <td>{{ $supplier->contacto }}</td>
                <td>
                    <a href="{{ route('proveedores.edit', $supplier->id) }}" class="btn btn-primary">Editar</a>
                    <form action="{{ route('proveedores.delete', $supplier->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
@stop
