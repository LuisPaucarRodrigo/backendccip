@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
<h1>Panel de Administración de Tareas</h1>

@stop

@section('content')
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarTareaModal">
        + Agregar
    </button>

    <form id="formTask" action="/home/tareas/user" method="post">
        @csrf
        <div class="form-group">
            <label for="usuario">Seleccione un Usuario:</label>
            <select id="UserSelect" class="form-control" name="usuario_id">
                <option value="0" {{ $usuario == '0' ? 'selected' : '' }}>Todos los usuarios</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == $usuario ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
    </form>

    <h4>Tareas del Usuario</h4>
    <div class="accordion" id="accordionExample">
        @foreach(["Iniciar", "Proceso", "Finalizado"] as $estado)
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{ $estado }}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $estado }}" aria-expanded="false" aria-controls="collapse{{ $estado }}">
                    {{ $estado }}
                </button>
            </h2>
            <div id="collapse{{ $estado }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $estado }}" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <ul class="list-group">
                        @foreach($tasks as $task)
                        @if($task->state == $estado)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                {{ $task->titulo }}
                                <div class="form-check">
                                    <a class="btn btn-primary mx-1" href="/home/tareas/user/redirectupdate/{{ $task->id }}">Modificar</a>
                                    <a class="btn btn-danger mx-1" href="/home/tareas/user/delete/{{ $task->id }}">Eliminar</a>
                                </div>
                            </div>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <form action="/home/tareas/import/export" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="archivo" class="form-label">Seleccionar Archivo</label>
            <input type="file" class="form-control" id="archivo" name="archivo">
        </div>
        <button name="importar" type="submit" class="btn btn-primary">Importar</button>
        <button name="export" type="submit" class="btn btn-success">Exportar</button>
    </form>
</div>

<div class="modal fade" id="agregarTareaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Tarea</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/home/registertask">
                    @csrf
                    <div class="form-group">
                        <label for="usuario">Usuario:</label>
                        <select id="UserSelect" class="form-control" name="usuario_id">
                            @foreach($users as $user)
                            {{-- <option value="1" {{ $month === '1' ? 'selected' : '' }}>Enero</option> --}}
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Site</label>
                        <input name="site" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="zona">Zona:</label>
                        <select name="selectCuadrilla" class="form-select" required>
                            <option value="Arequipa">Arequipa</option>
                            <option value="Moquegua">Moquegua</option>
                            <option value="Chala">Chala</option>
                            <option value="MDD1">MDD1</option>
                            <option value="MDD2">MDD2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="titulo">Tarea:</label>
                        <select id="selectTarea" name="selectTarea" class="form-select" required>
                            <option value="Mantenimiento">Mantenimiento</option>
                            <option value="Incidencia">Incidencia</option>
                        </select>
                    </div>
                    <div class="form-group mantenimiento-checkboxes">
                        <label for="operacion">Operación:</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check1" name="operaciones[]" value="1RA">
                            <label class="form-check-label" for="check1">1RA</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check2" name="operaciones[]" value="2DA">
                            <label class="form-check-label" for="check2">2DA</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check3" name="operaciones[]" value="AA">
                            <label class="form-check-label" for="check3">AA</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check4" name="operaciones[]" value="GEE">
                            <label class="form-check-label" for="check4">GEE</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check5" name="operaciones[]" value="TX">
                            <label class="form-check-label" for="check5">TX</label>
                        </div>
                    </div>
                    <div class="form-group incidencias-checkboxes">
                        <label for="operacion">Operación:</label>
                        <!-- Checkboxes para Incidencias (inicialmente ocultos) -->
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check7" name="operaciones[]" value="Afectado">
                            <label class="form-check-label" for="check7">Afectado</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check7" name="operaciones[]" value="Corte">
                            <label class="form-check-label" for="check8">Corte</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check7" name="operaciones[]" value="Incidencia">
                            <label class="form-check-label" for="check9">Incidencia</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check7" name="operaciones[]" value="Instalacion">
                            <label class="form-check-label" for="check10">Instalacion</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check7" name="operaciones[]" value="Revision">
                            <label class="form-check-label" for="check11">Revision</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check7" name="operaciones[]" value="RRU Afectada">
                            <label class="form-check-label" for="check12">RRU Afectada</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check1" name="operaciones[]" value="Alarma de corte">
                            <label class="form-check-label" for="check1">Alarma de Corte</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check2" name="operaciones[]" value="Corte Programado">
                            <label class="form-check-label" for="check2">Corte Programado</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check3" name="operaciones[]" value="Log de Alarmas">
                            <label class="form-check-label" for="check3">Log de Alarmas</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check4" name="operaciones[]" value="Ventana">
                            <label class="form-check-label" for="check4">Ventana</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check5" name="operaciones[]" value="Vswr">
                            <label class="form-check-label" for="check5">Vswr</label>
                        </div>
                        <!-- Agrega más checkboxes para Incidencias aquí -->
                    </div>
                    <div class="form-group">
                        <label for="fechaCreacion">Fecha de Creación:</label>
                        <input type="date" class="form-control" id="fechaCreacion" name="fechaCreacion" min="<?= date('Y-m-d'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="fechaVencimiento">Fecha de Vencimiento:</label>
                        <input type="date" class="form-control" id="fechaVencimiento" name="fechaVencimiento" min="<?= date('Y-m-d'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción de la Tarea:</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar Tarea</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

@stop

@section('js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectTarea = document.getElementById("selectTarea");
        const mantenimientoCheckboxes = document.querySelector(".mantenimiento-checkboxes");
        const incidenciasCheckboxes = document.querySelector(".incidencias-checkboxes");
        selectTarea.addEventListener("change", function() {
            if (selectTarea.value === "Mantenimiento") {
                mantenimientoCheckboxes.style.display = "block";
                incidenciasCheckboxes.style.display = "none";

            } else if (selectTarea.value === "Incidencia") {
                mantenimientoCheckboxes.style.display = "none";
                incidenciasCheckboxes.style.display = "block";
            }
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');

            // Recorrer los checkboxes y deseleccionarlos
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        });
        selectTarea.dispatchEvent(new Event("change"));
    });
</script>
<script>
    const UserSelect = document.getElementById('UserSelect');
    UserSelect.addEventListener('change', () => {
        formTask.submit();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stop