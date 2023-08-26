@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
    <h1>Nuevo Usuario</h1>
@stop

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg p-5">
                    <h3 class="mb-4 text-center">Registrarse</h3>
                    <form action="/register" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirma contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Rol</label>
                            <select name="role" class="form-select">
                                <option value="Admin">Admin</option>
                                <option value="Asistente">Asistente</option>
                            </select>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Registrarse</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
@stop

