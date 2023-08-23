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
            <th>Ruc</th>
            <th>Tipo de Doc</th>
            <th>Nro Factura o Recibo</th>
            <th>Fecha Documento</th>
            <th>Valor de Venta</th>
            <th>IGV</th>
            <th>Monto Total</th>
            <th>Fecha Insercion</th>
            <th>Personal</th>
            <th>Concepto</th>
        </tr>
    </thead>
    <tbody>
    @foreach($operaciones as $operaciones)
        <tr>
            <td></td>
            <td>{{ $x++ }}</td>
            <td>{{ $operaciones->cuadrilla }}</td>
            <td>{{ $operaciones->ruc }}</td>
            <td>{{ $operaciones->tipo_documento }}</td>
            <td>{{ $operaciones->nro_documento }}</td>
            <td>{{ $operaciones->fecha_documento }}</td>
            <td>{{abs($operaciones->gasto)/1.18}}</td>
            <td>{{abs($operaciones->gasto)-(abs($operaciones->gasto)/1.18)}}</td>
            <td>{{abs($operaciones->gasto)}}</td>
            <td>{{ $operaciones->fecha_insercion }}</td>
            <td>{{ $operaciones->UsuarioCCIP->name }}</td>
            <td>{{ $operaciones->concepto }}</td>
        </tr>
        @php
            $x = $x+1;
        @endphp
    @endforeach
    </tbody>
</table>
