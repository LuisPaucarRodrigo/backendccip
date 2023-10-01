@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
    <h1>Actualizar Tarea</h1>
@stop

@section('content')
    <div class="container">
    <form method="post" action="/home/tareas/user/update">
                  @csrf
                    <input name="id" type="hidden" class="form-control" value="{{$user->id }}"> 
                    <div class="form-group">
                        <label for="usuario">Usuario:</label>
                        <input type="text" class="form-control" disabled value="{{$user->name }}"> 
                    </div>
                    <div class="form-group">
                      <label class="col-form-label">Site</label>
                      <input name="site" type="text" class="form-control" value="{{$reditask->site }}" required>  
                    </div>
                    <div class="form-group">
                        <label for="zona">Zona:</label>
                        <select name="selectCuadrilla" class="form-select" required>
                        <option value="Arequipa" {{ $reditask->zona == 'Arequipa' ? 'selected' : '' }}>Arequipa</option>
                        <option value="Moquegua" {{ $reditask->zona == 'Moquegua' ? 'selected' : '' }}>Moquegua</option>
                        <option value="Chala" {{ $reditask->zona == 'Chala' ? 'selected' : '' }}>Chala</option>
                        <option value="MDD1" {{ $reditask->zona == 'MDD1' ? 'selected' : '' }}>MDD1</option>
                        <option value="MDD2" {{ $reditask->zona == 'MDD2' ? 'selected' : '' }}>MDD2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="titulo">Tarea:</label>
                        <select id="selectTarea" name="selectTarea" class="form-select" required>
                            <option value="Mantenimiento" {{ $reditask->titulo == 'Mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                            <option value="Incidencia" {{ $reditask->titulo == 'Incidencia' ? 'selected' : '' }}>Incidencia</option>
                        </select>
                        </select>
                    </div>
                    <div class="form-group mantenimiento-checkboxes">
                      <label for="operacion">Operación:</label>
                      <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="check1" name="operaciones[]" value="1RA" {{ in_array('1RA', json_decode($reditask->operaciones)) ? 'checked' : '' }}>
                          <label class="form-check-label" for="check1">1RA</label>
                      </div>
                      <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="check2" name="operaciones[]" value="2DA" {{ in_array('2DA', json_decode($reditask->operaciones)) ? 'checked' : '' }}>
                          <label class="form-check-label" for="check2">2DA</label>
                      </div>
                      <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="check3" name="operaciones[]" value="AA" {{ in_array('AA', json_decode($reditask->operaciones)) ? 'checked' : '' }}>
                          <label class="form-check-label" for="check3">AA</label>
                      </div>
                      <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="check4" name="operaciones[]" value="GEE" {{ in_array('GEE', json_decode($reditask->operaciones)) ? 'checked' : '' }}>
                          <label class="form-check-label" for="check4">GEE</label>
                      </div>
                      <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="check5" name="operaciones[]" value="GEP" {{ in_array('TX', json_decode($reditask->operaciones)) ? 'checked' : '' }}>
                          <label class="form-check-label" for="check5">TX</label>
                      </div>
                    </div>

                    <div class="form-group incidencias-checkboxes">
                      <label for="operacion">Operación:</label>
                        <!-- Checkboxes para Incidencias (inicialmente ocultos) -->
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check7" name="operaciones[]" value="Afectado" {{ in_array('Afectado', json_decode($reditask->operaciones)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="check7">Afectado</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check7" name="operaciones[]" value="Corte" {{ in_array('Corte', json_decode($reditask->operaciones)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="check8">Corte</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check7" name="operaciones[]" value="Incidencia" {{ in_array('Incidencia', json_decode($reditask->operaciones)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="check9">Incidencia</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check7" name="operaciones[]" value="Instalacion" {{ in_array('Instalacion', json_decode($reditask->operaciones)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="check10">Instalacion</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check7" name="operaciones[]" value="Revision" {{ in_array('Revision', json_decode($reditask->operaciones)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="check11">Revision</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check7" name="operaciones[]" value="RRU Afectada" {{ in_array('RRU Afectada', json_decode($reditask->operaciones)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="check12">RRU Afectada</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check7" name="operaciones[]" value="Alarma de corte" {{ in_array('Alarma de corte', json_decode($reditask->operaciones)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="check12">Alarma de Corte</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check7" name="operaciones[]" value="Corte Programado" {{ in_array('Corte Programado', json_decode($reditask->operaciones)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="check12">Corte Programado</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check7" name="operaciones[]" value="Log de Alarmas" {{ in_array('Log de Alarmas', json_decode($reditask->operaciones)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="check12">Log de Alarmas</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check7" name="operaciones[]" value="Ventana" {{ in_array('Ventana', json_decode($reditask->operaciones)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="check12">Ventana</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="check7" name="operaciones[]" value="Vswr" {{ in_array('Vswr', json_decode($reditask->operaciones)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="check12">Vswr</label>
                        </div>
                        <!-- Agrega más checkboxes para Incidencias aquí -->
                    </div>

                    <div class="form-group">
                      <label for="fechaCreacion">Fecha de Creación:</label>
                      <input type="date" class="form-control" id="fechaCreacion" name="fechaCreacion" min="<?= date('Y-m-d'); ?>" value="{{$reditask->fechaCreacion }}" required>
                    </div>
                    <div class="form-group">
                        <label for="fechaVencimiento">Fecha de Vencimiento:</label>
                        <input type="date" class="form-control" id="fechaVencimiento" name="fechaVencimiento" min="<?= date('Y-m-d'); ?>" value="{{$reditask->fechaVencimiento }}" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción de la Tarea:</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"  required>{{$reditask->descripcion }}</textarea>
                    </div>
                    <div class="modal-footer">
                    <div class="form-check">
                        <a href="/home/tareas" class="btn btn-warning">Regresar</a> 
                        <button type="submit" class="btn btn-primary">Guardar Tarea</button>
                    </div>

                </div>
                </form>    
    </div>
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@stop

@section('js')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const selectTarea = document.getElementById("selectTarea");
    const mantenimientoCheckboxes = document.querySelector(".mantenimiento-checkboxes");
    const incidenciasCheckboxes = document.querySelector(".incidencias-checkboxes");
    selectTarea.addEventListener("change", function () {
        if (selectTarea.value === "Mantenimiento") {
            mantenimientoCheckboxes.style.display = "block";
            incidenciasCheckboxes.style.display = "none";
        } else if (selectTarea.value === "Incidencia") {
            mantenimientoCheckboxes.style.display = "none";
            incidenciasCheckboxes.style.display = "block";
        }
    });
    selectTarea.dispatchEvent(new Event("change"));
});
</script>
@stop