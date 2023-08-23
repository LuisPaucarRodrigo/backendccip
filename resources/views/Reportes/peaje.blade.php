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
        <th>Nro de factura</th>
        <th>Fecha Factura</th>
        <th>Foto factura</th>
        <th>lugar de llegada</th>
        <th>Monto total</th>
        <th>Fecha Insercion</th>
        <th>Personal</th>
    </tr>
    </thead>
    <tbody>
    @foreach($peajes as $peajes)
        <tr>
            <td></td>
            <td>{{ $x++ }}</td>
            <td>{{ $peajes->cuadrilla }}</td>
            <td>{{ $peajes->ruc }}</td>
            <td>{{ $peajes->nro_factura }}</td>
            <td>{{ $peajes->fecha_factura }} </td>
            <td>{{ $peajes->foto_factura }}</td>
            <td>{{ $peajes->lugar_llegada }}</td>
            <td>{{ $peajes->monto_total }}</td>
            <td>{{ $peajes->fecha_insercion }}</td>
            <td>{{ $peajes->UsuarioCCIP->name }}</td>
        </tr>
        @php
            $x = $x+1;
        @endphp
    @endforeach
    </tbody>
</table>
