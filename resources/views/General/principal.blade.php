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
            <input type="hidden" name="updateType" value="anual">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    Gastos Anual</h3>
                <div class="input-group" style="max-width: 100px;">
                    <input type="number" id="yearAnual" class="form-control" min="1900" max="2099" step="1" name="year" value="{{ $year }}">
                </div>
            </div>
          <div id="gastosTotalesAnuales" class="display-4 mt-4">S/{{ $gastosPorAnual }}</div> <!-- Monto del gasto total mensual -->
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12">
      <!-- Tarjeta de Gastos Acumulados -->
      <div class="card">
        <div class="card-body">
          <input type="hidden" name="updateType" value="mensual">
          <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Gastos Mensual</h3>
            <div class="input-group" style="max-width: 128px;">
              <select id="monthSelect" class="form-control" name="month">
                <option value="1" {{ $month2 === '1' ? 'selected' : '' }}>Enero</option>
                <option value="2" {{ $month2 === '2' ? 'selected' : '' }}>Febrero</option>
                <option value="3" {{ $month2 === '3' ? 'selected' : '' }}>Marzo</option>
                <option value="4" {{ $month2 === '4' ? 'selected' : '' }}>Abril</option>
                <option value="5" {{ $month2 === '5' ? 'selected' : '' }}>Mayo</option>
                <option value="6" {{ $month2 === '6' ? 'selected' : '' }}>Junio</option>
                <option value="7" {{ $month2 === '7' ? 'selected' : '' }}>Julio</option>
                <option value="8" {{ $month2 === '8' ? 'selected' : '' }}>Agosto</option>
                <option value="9" {{ $month2 === '9' ? 'selected' : '' }}>Septiembre</option>
                <option value="10" {{ $month2 === '10' ? 'selected' : '' }}>Octubre</option>
                <option value="11" {{ $month2 === '11' ? 'selected' : '' }}>Noviembre</option>
                <option value="12" {{ $month2 === '12' ? 'selected' : '' }}>Diciembre</option>
              </select>
            </div>  
          </div>
          <div id="gastosTotalesMensual" class="display-4 mt-4">S/{{ $gastosPorMes }}</div> <!-- Monto del gasto acumulado -->
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12">
      <!-- Usuarios registrados CCIP -->
      <div class="card">
        <div class="card-body">
        <input type="hidden" name="updateType" value="mensual">
          <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Gastos Mensual por zona</h3>
            <div class="input-group" style="max-width: 128px;">
              <select id="zonaSelect" class="form-control" name="zona">
                <option value="Arequipa" {{ $zona === 'Arequipa' ? 'selected' : '' }}>Arequipa</option>
                <option value="Chala" {{ $zona === 'Chala' ? 'selected' : '' }}>Chala</option>
                <option value="Moquegua" {{ $zona === 'Moquegua' ? 'selected' : '' }}>Moquegua</option>
                <option value="MDD1" {{ $zona === 'MDD1' ? 'selected' : '' }}>MDD1</option>
                <option value="MDD2" {{ $zona === 'MDD2' ? 'selected' : '' }}>MDD2</option>
              </select>
            </div>  
          </div>
          <div id="gastosTotalesMensualCuadrilla" class="display-4 mt-4">S/{{ $gastosPorCuadrilla }}</div> <!-- Monto del gasto acumulado -->
        </div>
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <input type="hidden" name="updateType" value="usuario">
            <div class="d-flex justify-content-between align-items-center">
              <h3 class="card-title">Gastos</h3>
              <div class="input-group" style="max-width: 128px;">
                <select id="ConceptSelect" class="form-control" name="concepto">
                    <option value="Combustible" {{ $concept == 'Combustible' ? 'selected' : '' }}>Combustible</option>
                    <option value="CombustibleGep" {{ $concept == 'CombustibleGep' ? 'selected' : '' }}>Cgep</option>
                    <option value="Peaje" {{ $concept == 'Peaje' ? 'selected' : '' }}>Peaje</option>
                    <option value="Otros" {{ $concept == 'Otros' ? 'selected' : '' }}>Otros</option>
                </select>
              </div>  
            </div>
          <canvas id="gastosChart"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <input type="hidden" name="updateType" value="usuario">
            <div class="d-flex justify-content-between align-items-center">
              <h3 class="card-title">Gastos Usuario</h3>
              <div class="input-group" style="max-width: 280px;">
              <input id="gastototalusers" class="form-control" type="text" disabled value="S/{{ $gastototalusers }}">
                <select id="UserSelect" class="form-control" name="usuario">
                  @foreach($users as $user)
                  <option value="{{ $user->id }}" {{ $user->id == $usuario ? 'selected' : ($loop->first ? 'selected' : '') }}>{{ $user->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <canvas id="gastosChartUsuario"></canvas>
        </div>
      </div>
    </div> 
  </div>
</form>
@stop

@section('css')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script>
  var ctxchart = document.getElementById('gastosChart').getContext('2d');
  var gastosChart = new Chart(ctxchart, {
      type: 'bar',
      data: {
          labels: [
              'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
              'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
          ],
          datasets: [{
              label: 'Operaciones',
              data: [
                  @foreach($gastosPorCampo as $mes => $gasto)
                      {{ $gasto }},
                  @endforeach
              ],
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
    var ctxchartjs = document.getElementById('gastosChart').getContext('2d');
    var gastosChart;
    var csrfToken = '{{ csrf_token() }}';

    $('#ConceptSelect,#zonaSelect,#yearAnual,#monthSelect').on('change', function() {
      var conceptoSeleccionado = $('#ConceptSelect').val();
      var zonaSeleccionada = $('#zonaSelect').val();
      var monthselect = $('#monthSelect').val();
      var yearAnual = $('#yearAnual').val();
        $.ajax({
            type: 'POST',
            url: '/home/general/actualizar',
            data: {
                concepto: conceptoSeleccionado,
                zona:zonaSeleccionada,
                month:monthselect,
                year:yearAnual,
                _token: csrfToken 
            },
            success: function(data) {
                if (gastosChart) {
                  gastosChart.destroy();
                }
                $('#gastosTotalesAnuales').html('S/' + data.gastosPorAnual);
                $('#gastosTotalesMensual').html('S/' + data.gastosPorMes);
                $('#gastosTotalesMensualCuadrilla').html('S/' + data.gastosPorCuadrilla);
                

                gastosChart = new Chart(ctxchartjs, {
                    type: 'bar',
                    data: {
                        labels: [
                            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                        ],
                        datasets: [{
                            label: 'Operaciones',
                            data: Object.values(data.gastosPorCampojs),
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
            },
            error: function() {
                // Manejo de errores si es necesario
            }
        });
    });
</script>

<script>
  var ctxusers= document.getElementById('gastosChartUsuario').getContext('2d');
  var gastosChartusers = new Chart(ctxusers, {
    type: 'bar',
    data: {
      labels: ['Combustible', 'Peaje', 'Otros', 'Combustible GEP'],
      datasets: [{
        label: 'Operaciones',
        data: [
        @foreach($gastosPorCampoUsuario as $campo => $gastousers)
        {{ $gastousers }},
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
    var ctxusersjs = document.getElementById('gastosChartUsuario').getContext('2d');
    var gastosChartusers;
    var csrfToken = '{{ csrf_token() }}';

    $('#UserSelect,#zonaSelect,#yearAnual,#monthSelect').on('change', function() {
        var conceptoSeleccionadousers = $('#UserSelect').val();
        var zonaSeleccionadausers = $('#zonaSelect').val();
        var monthSelectusers = $('#monthSelect').val();
        var yearAnualusers = $('#yearAnual').val();
        $.ajax({
            type: 'POST',
            url: '/home/general/actualizar/users',
            data: {
                usuario: conceptoSeleccionadousers,
                zona:zonaSeleccionadausers,
                month:monthSelectusers,
                year:yearAnualusers,
                _token: csrfToken 
            },
            success: function(datausers) {
                if (gastosChartusers) {
                  gastosChartusers.destroy();
                }
                $('#gastototalusers').val('S/' + datausers.gastototalusers);
                
                gastosChartusers = new Chart(ctxusersjs, {
                    type: 'bar',
                    data: {
                      labels: ['Combustible', 'Peaje', 'Otros', 'Combustible GEP'],
                        datasets: [{
                            label: 'Gastos Usuario',
                            data: Object.values(datausers.gastosPorCampoUsuariojs),
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
            },
            error: function() {
                // Manejo de errores si es necesario
            }
        });
    });
</script>
@stop
