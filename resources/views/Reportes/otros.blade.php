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
        <th>Ruc</th>
        <th>Tipo de Doc</th>
        <th>Nro de Doc</th>
        <th>Fecha Doc</th>
        <th>Autorizacion</th>
        <th>Descripcion</th>
        <th>Imagen</th>
        <th>Monto</th>
        <th>Fecha Insercion</th>
        <th>Usuario</th>
    </tr>
    </thead>
    <tbody>
    @foreach($otros as $otros)
        <tr>
            <td></td>
            <td>{{ $x++ }}</td>
            <td>{{ $otros->control_gastos }}</td> 
            <td>{{ $otros->cuadrilla }}</td>
            <td>{{ $otros->ruc }}</td>
            <td>{{ $otros->tipo_documento }}</td>
            <td>{{ $otros->numero_documento }}</td>
            <td>{{ $otros->fecha_documento }}</td>
            <td>{{ $otros->autorizacion }}</td>
            <td>{{ $otros->descripcion }} </td>
            <td>{{ $otros->foto_otros }}</td>   
            <td>{{ $otros->monto_total }}</td>
            <td>{{ $otros->fecha_insercion }}</td>
            <td>{{ $otros->UsuarioCCIP->name }}</td>
        </tr>
        @php
            $x = $x+1;
        @endphp
    @endforeach
    </tbody>
</table>
