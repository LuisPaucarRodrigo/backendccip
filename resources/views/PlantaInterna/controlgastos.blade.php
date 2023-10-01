@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
<h1>Control de Gastos</h1>

@stop

@section('content')
<div class="container">
    <form action="/home/plantainterna" id="filtroForm" method="post">
        @csrf
        <div class="row">
            <div class="col estado-checkboxes">
                <h3>Estado</h3>
                <select id="estadoSelect" class="form-select" name="stateselect">
                    <option value="Iniciar" @if ($state == 'Iniciar') selected @endif>Iniciar</option>
                    <option value="Proceso" @if ($state == 'Proceso') selected @endif>Proceso</option>
                    <option value="Finalizado" @if ($state == 'Finalizado') selected @endif>Finalizado</option>
                </select>
                </select>
            </div>
            <div class="col meses-checkboxes">
                <h3>Meses</h3>
                <select id="mesesSelect" class="form-select" name="mounthselect">
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
    </form>

</div>
<div class="">
    <div class="row mt-4 justify-content-md-center">
        <div class="col-md-6">
            <table class="col table table-bordered">
            <thead>
                    <tr>
                        <th>Zona</th>
                        <th>1RA</th>
                        <th>2DA</th>
                        <th>AA</th>
                        <th>GEE</th>
                        <th>TX</th>
                        <th>Total General</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recuentoOperaciones as $zona => $operaciones)
                    <tr>
                        <td>{{ $zona }}</td>
                        <td>{{ $operaciones['1RA'] }}</td>
                        <td>{{ $operaciones['2DA'] }}</td>
                        <td>{{ $operaciones['AA'] }}</td>
                        <td>{{ $operaciones['GEE'] }}</td>
                        <td>{{ $operaciones['TX'] }}</td>
                        <td>{{ array_sum($operaciones) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>Total</td>
                        <td>{{ array_sum(array_column($recuentoOperaciones, '1RA')) }}</td>
                        <td>{{ array_sum(array_column($recuentoOperaciones, '2DA')) }}</td>
                        <td>{{ array_sum(array_column($recuentoOperaciones, 'AA')) }}</td>
                        <td>{{ array_sum(array_column($recuentoOperaciones, 'GEE')) }}</td>
                        <td>{{ array_sum(array_column($recuentoOperaciones, 'TX')) }}</td>
                        <td>{{ array_sum(array_map('array_sum', $recuentoOperaciones)) }}</td>
                    </tr>
                </tfoot>
            </table>

        </div>
        <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                    <input type="hidden" name="updateType" value="usuario">
                        <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Gastos Mantenimiento</h3>
                        
                        </div>
                        <canvas id="graficoBarras"></canvas>
                    </div>
                </div>
            </div> 

        <div class="row">
        <div class="col-md-6">
    <table class="col table table-bordered">
        <thead>
            <tr>
                <th>Zona</th>
                <th>Afectado</th>
                <th>Corte</th>
                <th>Incidencia</th>
                <th>Instalacion</th>
                <th>Revision</th>
                <th>RRU Afectada</th>
                <th>Alarma de corte</th>
                <th>Corte Programado</th>
                <th>Log de Alarmas</th>
                <th>Ventana</th>
                <th>Vswr</th>
                <th>Total General</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recuentoOperacionesincidencia as $zona => $operacionesincidencia)
            <tr>
                <td>{{ $zona }}</td>
                <td>{{ $operacionesincidencia['Afectado'] }}</td>
                <td>{{ $operacionesincidencia['Corte'] }}</td>
                <td>{{ $operacionesincidencia['Incidencia'] }}</td>
                <td>{{ $operacionesincidencia['Instalacion'] }}</td>
                <td>{{ $operacionesincidencia['Revision'] }}</td>
                <td>{{ $operacionesincidencia['RRU Afectada'] }}</td>
                <td>{{ $operacionesincidencia['Alarma de corte'] }}</td>
                <td>{{ $operacionesincidencia['Corte Programado'] }}</td>
                <td>{{ $operacionesincidencia['Log de Alarmas'] }}</td>
                <td>{{ $operacionesincidencia['Ventana'] }}</td>
                <td>{{ $operacionesincidencia['Vswr'] }}</td>
                <td>{{ array_sum($operacionesincidencia) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td>Total</td>
                <td>{{ array_sum(array_column($recuentoOperacionesincidencia, 'Afectado')) }}</td>
                <td>{{ array_sum(array_column($recuentoOperacionesincidencia, 'Corte')) }}</td>
                <td>{{ array_sum(array_column($recuentoOperacionesincidencia, 'Incidencia')) }}</td>
                <td>{{ array_sum(array_column($recuentoOperacionesincidencia, 'Instalacion')) }}</td>
                <td>{{ array_sum(array_column($recuentoOperacionesincidencia, 'Revision')) }}</td>
                <td>{{ array_sum(array_column($recuentoOperacionesincidencia, 'RRU Afectada')) }}</td>
                <td>{{ array_sum(array_column($recuentoOperacionesincidencia, 'Alarma de corte')) }}</td>
                <td>{{ array_sum(array_column($recuentoOperacionesincidencia, 'Corte Programado')) }}</td>
                <td>{{ array_sum(array_column($recuentoOperacionesincidencia, 'Log de Alarmas')) }}</td>
                <td>{{ array_sum(array_column($recuentoOperacionesincidencia, 'Ventana')) }}</td>
                <td>{{ array_sum(array_column($recuentoOperacionesincidencia, 'Vswr')) }}</td>
                <td>{{ array_sum(array_map('array_sum', $recuentoOperacionesincidencia)) }}</td>
            </tr>
        </tfoot>
    </table>
</div>

            
        </div>
        <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                    <input type="hidden" name="updateType" value="usuario">
                        <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Gastos Incidencia</h3>
                        
                        </div>
                        <canvas id="graficoBarrasincidencia"></canvas>
                    </div>
                </div>
            </div> 
    </div>
</div>

@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Cuando cambia el select de estado
    $('#estadoSelect').change(function () {
        $('#filtroForm').submit(); // Envía el formulario
    });

    // Cuando cambia el select de meses
    $('#mesesSelect').change(function () {
        $('#filtroForm').submit(); // Envía el formulario
    });
</script>
<script>
    // Datos del conteo
    var datosConteo = {
        labels: ["1RA", "2DA", "AA", "GEE", "TX"],
        datasets: [
            @foreach (['Arequipa', 'Chala', 'MDD1', 'Moquegua', 'MDD2'] as $zona)
            {
                label: "{{ $zona }}",
                backgroundColor: "rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)",
                borderColor: "rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 1)",
                borderWidth: 1,
                data: [
                    {{ $recuentoOperaciones[$zona]['1RA'] ?? 0 }},
                    {{ $recuentoOperaciones[$zona]['2DA'] ?? 0 }},
                    {{ $recuentoOperaciones[$zona]['AA'] ?? 0 }},
                    {{ $recuentoOperaciones[$zona]['GEE'] ?? 0 }},
                    {{ $recuentoOperaciones[$zona]['TX'] ?? 0 }}
                ]
            },
            @endforeach
        ]
    };

    // Configuración del gráfico
    var configuracionGrafico = {
        type: 'bar',
        data: datosConteo,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Operación'
                    }
                }
            }
        }
    };

    // Obtener el contexto del canvas
    var ctx = document.getElementById('graficoBarras').getContext('2d');

    // Crear el gráfico de barras
    var graficoBarras = new Chart(ctx, configuracionGrafico);
</script>

<script>
    // Datos del conteo
    var datosConteo = {
        labels: ["Afectado", "Corte", "Incidencia", "Instalacion", "Revision", "RRU Afectada", "Alarma de corte", "Corte Programado", "Log de Alarmas", "Ventana", "Vswr"],
        datasets: [
            @foreach (['Arequipa', 'Chala', 'MDD1', 'Moquegua', 'MDD2'] as $zona)
            {
                label: "{{ $zona }}",
                backgroundColor: "rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)",
                borderColor: "rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 1)",
                borderWidth: 1,
                data: [
                    {{ $recuentoOperacionesincidencia[$zona]['Afectado'] ?? 0 }},
                    {{ $recuentoOperacionesincidencia[$zona]['Corte'] ?? 0 }},
                    {{ $recuentoOperacionesincidencia[$zona]['Incidencia'] ?? 0 }},
                    {{ $recuentoOperacionesincidencia[$zona]['Instalacion'] ?? 0 }},
                    {{ $recuentoOperacionesincidencia[$zona]['Revision'] ?? 0 }},
                    {{ $recuentoOperacionesincidencia[$zona]['RRU Afectada'] ?? 0 }},
                    {{ $recuentoOperacionesincidencia[$zona]['Alarma de corte'] ?? 0 }},
                    {{ $recuentoOperacionesincidencia[$zona]['Corte Programado'] ?? 0 }},
                    {{ $recuentoOperacionesincidencia[$zona]['Log de Alarmas'] ?? 0 }},
                    {{ $recuentoOperacionesincidencia[$zona]['Ventana'] ?? 0 }},
                    {{ $recuentoOperacionesincidencia[$zona]['Vswr'] ?? 0 }}
                ]
            },
            @endforeach
        ]
    };

    // Configuración del gráfico
    var configuracionGrafico = {
        type: 'bar',
        data: datosConteo,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Operación'
                    }
                }
            }
        }
    };

    // Obtener el contexto del canvas
    var ctx = document.getElementById('graficoBarrasincidencia').getContext('2d');

    // Crear el gráfico de barras
    var graficoBarras = new Chart(ctx, configuracionGrafico);
</script>

@stop