@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
<a href="/home/role/newrol" class="btn btn-primary float-right">Nuevo Rol</a>
<h1>Listado Roles</h1>

@stop

@section('content')
<div class="container">
    <table class=" table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Role</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{$role -> id}}</td>
                        <td>{{$role -> name}}</td>
                        <td>
                            <a class="btn btn-warning" href="/home/role/edit/{{$role->id}}">Editar</a>
                            <a class="btn btn-danger" href="/home/role/delete/{{$role->id}}">Eliminar</a>
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
    
@stop