@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
<div class="container-fluid">
  <div class="d-flex justify-content-between">
    <h1>Estadísticas</h1>
    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Configuración</button> --}}
  </div>
</div>
@stop

@section('content')
<form id="formAnual" method="post" action="/home/general/config">
  @csrf
  <div class="row">

    <div class="col-lg-4 col-md-6 col-12">
      <!-- Tarjeta de Gastos Total Mensual -->
      <div class="card">
        <div class="card-body">
          {{-- <form id="formAnual" method="post" action="/home/general/config">
            @csrf --}}
            <input type="hidden" name="updateType" value="anual">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    Gastos Anual</h3>
                <div class="input-group" style="max-width: 100px;">
                    <input type="number" id="yearSpinnerAnual" class="form-control" min="1900" max="2099" step="1" name="year" value="{{ $year }}">
                </div>
            </div>
          {{-- </form> --}}
          <div class="display-4 mt-4">S/{{ $gastosPorAnual }}</div> <!-- Monto del gasto total mensual -->
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12">
      <!-- Tarjeta de Gastos Acumulados -->
      <div class="card">
        <div class="card-body">
          {{-- <form id="formMensual" method="post" action="/home/general/config">
            @csrf --}}
            <input type="hidden" name="updateType" value="mensual">
            <div class="d-flex justify-content-between align-items-center">
              <h3 class="card-title">Gastos Mensual</h3>
              {{-- <i class="fas fa-dollar-sign fa-2x"></i> <!-- Icono de gráfico de barras --> --}}
              <div class="input-group" style="max-width: 128px;">
                <select id="monthSelect" class="form-control" name="month">
                  <option value="1" {{ $month === '1' ? 'selected' : '' }}>Enero</option>
                  <option value="2" {{ $month === '2' ? 'selected' : '' }}>Febrero</option>
                  <option value="3" {{ $month === '3' ? 'selected' : '' }}>Marzo</option>
                  <option value="4" {{ $month === '4' ? 'selected' : '' }}>Abril</option>
                  <option value="5" {{ $month === '5' ? 'selected' : '' }}>Mayo</option>
                  <option value="6" {{ $month === '6' ? 'selected' : '' }}>Junio</option>
                  <option value="7" {{ $month === '7' ? 'selected' : '' }}>Julio</option>
                  <option value="8" {{ $month === '8' ? 'selected' : '' }}>Agosto</option>
                  <option value="9" {{ $month === '9' ? 'selected' : '' }}>Septiembre</option>
                  <option value="10" {{ $month === '10' ? 'selected' : '' }}>Octubre</option>
                  <option value="11" {{ $month === '11' ? 'selected' : '' }}>Noviembre</option>
                  <option value="12" {{ $month === '12' ? 'selected' : '' }}>Diciembre</option>
                </select>
              </div>  
            </div>
          {{-- </form> --}}
          <div class="display-4 mt-4">S/{{ $gastosPorMes }}</div> <!-- Monto del gasto acumulado -->
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12">
      <!-- Usuarios registrados CCIP -->
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Usuarios CCIP</h3>
            <i class="fas fa-user fa-2x"></i> <!-- Icono de gráfico de barras -->
          </div>
          <div class="display-4 mt-4">{{ $countuser }}</div> <!-- Monto del gasto acumulado -->
        </div>
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Gastos</h3>
          <canvas id="gastosChart"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          {{-- <form id="formMensualUsuario" method="post" action="/home/general/config">
            @csrf --}}
            <input type="hidden" name="updateType" value="usuario">
            <div class="d-flex justify-content-between align-items-center">
              <h3 class="card-title">Gastos Usuario</h3>
              {{-- <i class="fas fa-dollar-sign fa-2x"></i> <!-- Icono de gráfico de barras --> --}}
              <div class="input-group" style="max-width: 128px;">
                <select id="UserSelect" class="form-control" name="usuario">
                  @foreach($users as $user)
                  {{-- <option value="1" {{ $month === '1' ? 'selected' : '' }}>Enero</option> --}}
                  <option value="{{ $user->id }}" {{ $user->id == $usuario ? 'selected' : ($loop->first ? 'selected' : '') }}>{{ $user->name }}</option>
                  @endforeach
                </select>
              </div>  
            </div>
            <canvas id="gastosChartUsuario"></canvas>
          {{-- </form> --}}
        </div>
      </div>
    </div>
  </div>
</form>
@stop

@section('css')
    
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script>
  var ctx = document.getElementById('gastosChart').getContext('2d');
  var gastosChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Combustible', 'Peaje', 'Otros', 'Combustible GEP'],
      datasets: [{
        label: 'Operaciones',
        data: [
        @foreach($gastosPorCampo as $campo => $gasto)
        {{ $gasto }},
        @endforeach
        ],// Reemplaza estos valores con tus datos de gastos
        backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545'],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
</script>

<script>
  var ctx = document.getElementById('gastosChartUsuario').getContext('2d');
  var gastosChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Combustible', 'Peaje', 'Otros', 'Combustible GEP'],
      datasets: [{
        label: 'Operaciones',
        data: [
        @foreach($gastosPorCampoUsuario as $campo => $gasto)
        {{ $gasto }},
        @endforeach
        ],// Reemplaza estos valores con tus datos de gastos
        backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545'],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
</script>

<script>
  // Obtener los elementos de formulario y agregar un listener para el evento "change"
  const formAnual = document.getElementById('formAnual');
  const yearSpinnerAnual = document.getElementById('yearSpinnerAnual');
  const monthSelect = document.getElementById('monthSelect');
  const UserSelect = document.getElementById('UserSelect');
  
  yearSpinnerAnual.addEventListener('change', () => {
      formAnual.submit(); // Enviar automáticamente el formulario cuando cambie el año
  });

  // const formMensual = document.getElementById('formMensual');
  // const monthSelect = document.getElementById('monthSelect');
  monthSelect.addEventListener('change', () => {
    formAnual.submit(); // Enviar automáticamente el formulario cuando cambie el mes
  });

  // const formMensualUsuario = document.getElementById('formMensualUsuario');
  // const UserSelect = document.getElementById('UserSelect');
  UserSelect.addEventListener('change', () => {
    formAnual.submit(); // Enviar automáticamente el formulario cuando cambie el mes
  });
</script>

{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script> --}}
@stop
