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
            @php
            $igv = ($operaciones->cuadrilla === 'MDD1' || $operaciones->cuadrilla === 'MDD2') ? 1 : 1.18;
            @endphp
            <td>{{ number_format(abs($operaciones->monto_total) / $igv, 2) }}</td>
            <td>{{ number_format(abs($operaciones->monto_total) - (abs($operaciones->monto_total) / $igv), 2) }}</td>
            <td>{{ $operaciones->monto_total }}</td>
            <td>{{ date('Y-m-d', strtotime($operaciones->fecha_insercion)) }}</td>
            <td>{{ $operaciones->UsuarioCCIP->name }}</td>
            <td>{{ $operaciones->concepto }}</td>
        </tr>
        @endforeach
    </tbody>
</table>