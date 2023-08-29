@php
    $x = 1;
@endphp
<table>
    <thead>
        <tr></tr>
        <tr>
            <th></th>
            <th>N°</th>
            <th>Titulo</th>
            <th>Mensaje</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Estado</th>    
            <th>Prioridad</th>
            <th>Personal</th>
        </tr>
    </thead>
    <tbody>
    @foreach($tareas as $tarea)
        <tr>
            <td></td>
            <td>{{ $x++ }}</td>
            <td>{{ $tarea->titulo }}</td> 
            <td>{{ $tarea->mensaje }}</td>     
            <td>{{ $tarea->fechaCreacion }}</td>
            <td>{{ $tarea->fechaVencimiento }}</td>
            <td>{{ $tarea->state}}</td>
            <td>{{ $tarea->prioridad}}</td>
            <td>{{ $tarea->UsuarioCCIP->name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
