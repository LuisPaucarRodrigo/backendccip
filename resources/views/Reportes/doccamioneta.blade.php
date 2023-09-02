@php
    $x = 1;
@endphp
<table>
    <thead>
        <tr></tr>
        <tr>
            <th></th>
            <th>N°</th>
            <th>Control de Gastos</th>
            <th>Cuadrilla</th>
            <th>Fecha de Inserción</th>
            <th>PLaca</th>
            <th>Circulación</th>
            <th>Técnica</th>
            <th>SOAT</th>
            <th>Personal</th>
        </tr>
    </thead>
    <tbody>
    @foreach($doccars as $doccar)
        <tr>
            <td></td>
            <td>{{ $x++ }}</td>
            <td>{{ $doccar->control_gastos }}</td> 
            <td>{{ $doccar->cuadrilla }}</td>     
            <td>{{ $doccar->fecha_insercion }}</td>
            <td>{{ $doccar->placa }}</td>
            <td>{{ $doccar->circulacion }}</td>
            <td>{{ $doccar->tecnica }}</td>
            <td>{{ $doccar->soat }}</td>
            <td>{{ $doccar->UsuarioCCIP->name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
