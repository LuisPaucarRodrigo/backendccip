@php
    $x = 1;
@endphp
<table>
    <thead>
        <tr></tr>
        <tr>
            <th></th>
            <th>N°</th>
            <th>Zona</th>
            <th>Site</th>
            <th>Titulo</th>
            <th>Operaciones</th>
            <th>Descripcion</th>
            <th>Crq/Incidencias</th>
            <th>Observaciones</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Estado</th>
            <th>Personal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tareas as $tarea)
            <tr>
                <td></td>
                <td>{{ $x++ }}</td>
                <td>{{ $tarea->zona }}</td> 
                <td>{{ $tarea->site }}</td> 
                <td>{{ $tarea->titulo }}</td> 
                <td>{{ $tarea->operaciones }}</td>  
                <td>{{ $tarea->descripcion }}</td>
                <td>{{ $tarea->crqincidencias }}</td>
                <td>{{ $tarea->observaciones }}</td>       
                <td>{{ $tarea->fechaCreacion }}</td>
                <td>{{ $tarea->fechaVencimiento }}</td>
                <td>{{ $tarea->state}}</td>
                <td>{{ $tarea->UsuarioCCIP->name}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
