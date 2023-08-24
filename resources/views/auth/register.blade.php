@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
    <h1>Nuevo Usuario</h1>
@stop

@section('content')

<section class="vh-100" style="background-color: #508bfc;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <form action="/register" method="post">
                            @csrf
                            <h3 class="mb-5">Registrarse</h3>

                            <div class="form-outline mb-4">
                                <input type="text" name="name" class="form-control form-control-lg" />
                                <label class="form-label" for="typeEmailX-2">Nombre</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="email" name="email" class="form-control form-control-lg" />
                                <label class="form-label" for="typeEmailX-2">Email</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" name="password" class="form-control form-control-lg" />
                                <label class="form-label" for="typePasswordX-2">Contraseña</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" name="password_confirmation" class="form-control form-control-lg" />
                                <label class="form-label" for="typePasswordX-2">Confirma contraseña</label>
                            </div>

                            <div class="form-outline mb-4">
                                <select name="role" class="form-select form-select-lg">
                                    <option value="Admin">Admin</option>
                                    <option value="Asistente">Asistente</option>
                                </select>
                                <label class="form-label" for="role">Rol</label>
                            </div>

                            <input class="btn btn-primary btn-lg btn-block" type="submit" value="Registrarse">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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

