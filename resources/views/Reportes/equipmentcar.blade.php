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
            <th>Placa</th>
            <th>Extintor</th>
            <th>Botiquín</th>
            <th>Conos</th>
            <th>Gata</th>
            <th>Neumático</th>
            <th>Ca. Remolque</th>
            <th>Ca. Batería</th>
            <th>Reflejante</th>
            <th>Kit</th>
            <th>Alarma</th>
            <th>GPS</th>
            <th>Tacos</th>
            <th>Interna</th>
            <th>Antivuelco</th>
            <th>Portaescalera</th>
            <th>Placa Lateral</th>
            <th>Personal</th>
        </tr>
    </thead>
    <tbody>
    @foreach($equipcars as $equipcar)
        <tr>
            <td></td>
            <td>{{ $x++ }}</td>
            <td>{{ $equipcar->control_gastos }}</td> 
            <td>{{ $equipcar->cuadrilla }}</td>     
            <td>{{ $equipcar->fecha_insercion }}</td>
            <td>{{ $equipcar->placa }}</td>
            <td>{{ $equipcar->extintor }}</td>
            <td>{{ $equipcar->botiquin }}</td>
            <td>{{ $equipcar->conos }}</td>
            <td>{{ $equipcar->gata }}</td>
            <td>{{ $equipcar->neumatico }}</td>
            <td>{{ $equipcar->ca_remolque }}</td>
            <td>{{ $equipcar->ca_bateria }}</td>
            <td>{{ $equipcar->reflejante }}</td>
            <td>{{ $equipcar->kit }}</td>
            <td>{{ $equipcar->alarma }}</td>
            <td>{{ $equipcar->gps }}</td>
            <td>{{ $equipcar->tacos }}</td>
            <td>{{ $equipcar->interna }}</td>
            <td>{{ $equipcar->antivuelco }}</td>
            <td>{{ $equipcar->portaescalera }}</td>
            <td>{{ $equipcar->placalateral }}</td>
            <td>{{ $equipcar->UsuarioCCIP->name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
