@php
    $x = 1;
@endphp
<table>
    <thead>
        <tr></tr>
        <tr>
            <th></th>
            <th>N°</th>
            <th>Cuadrilla</th>
            <th>Sitio Atendido</th>
            <th>Comentarios</th>
            <th>Oper_Inc_Crq</th>
            <th>Nro_Oper</th>
            <th>Fecha Traslado</th>
            <th>Usuario</th>
        </tr>
    </thead>
    <tbody>
    @foreach($traslados as $traslados)
        <tr>
            <td></td>
            <td>{{ $x++ }}</td>
            <td>{{ $traslados->cuadrilla}}</td>
            <td>{{ $traslados->sitio_atendido}}</td>
            <td>{{ $traslados->comentarios}}</td>
            <td>{{ $traslados->Oper_Inc_Crq}}</td>
            <td>{{ $traslados->Nro_Oper}}</td>
            <td>{{ $traslados->fecha_insercion}}</td>
            <td>{{ $traslados->UsuarioCCIP->name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
