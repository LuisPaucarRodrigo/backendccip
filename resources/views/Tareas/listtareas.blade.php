@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
<h1>Panel de Administración de Tareas</h1>

@stop

@section('content')
  <div class="container mt-4">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarTareaModal">
      + Agregar
    </button>
      <form id="formTask" action="/home/tareas/user" method="post">
        @csrf
          <div class="form-group">
              <label for="usuario">Seleccione un Usuario:</label>
              <select id="UserSelect" class="form-control" name="usuario_id">
                @foreach($users as $user)
                {{-- <option value="1" {{ $month === '1' ? 'selected' : '' }}>Enero</option> --}}
                <option value="{{ $user->id }}" {{ $user->id == $usuario ? 'selected' : ($loop->first ? 'selected' : '') }}>{{ $user->name }}</option>
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
                                              
                                                <label class="form-check-label" for="tarea{{ $task->id }}Check">
                                                    {{ ucfirst($task->prioridad) }}
                                                </label>
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
                        <label for="titulo">Título de la Tarea:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="form-group">
                      <label for="prioridad">Prioridad de la Tarea:</label>
                      <select class="form-control" id="prioridad" name="prioridad">
                          <option value="alta">Alta</option>
                          <option value="media">Media</option>
                          <option value="baja">Baja</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="fechaCreacion">Fecha de Creación:</label>
                      <input type="date" class="form-control" id="fechaCreacion" name="fechaCreacion" min="<?= date('Y-m-d'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="fechaVencimiento">Fecha de Vencimiento:</label>
                        <input type="date" class="form-control" id="fechaVencimiento" name="fechaVencimiento" min="<?= date('Y-m-d'); ?>"  required>
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
  // Obtener los elementos de formulario y agregar un listener para el evento "change"
  const UserSelect = document.getElementById('UserSelect');
  UserSelect.addEventListener('change', () => {
    formTask.submit(); // Enviar automáticamente el formulario cuando cambie el mes
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stop