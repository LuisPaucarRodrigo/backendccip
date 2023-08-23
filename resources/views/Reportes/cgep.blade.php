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
            <th>Nro Factura</th>
            <th>Fecha Factura</th>
            <th>Monto Total</th>
            <th>Estacion</th>
            <th>Foto Factura</th>
            <th>Foto Galonera</th>
            <th>Fecha Insercion</th>
            <th>Personal</th>
        </tr>
    </thead>
    <tbody>
    @foreach($cgep as $cgep)
        <tr>
            <td></td>
            <td>{{ $x++ }}</td>
            <td>{{ $cgep->cuadrilla }}</td>     
            <td>{{ $cgep->ruc }}</td>      
            <td>{{ $cgep->nro_factura }}</td>
            <td>{{ $cgep->fecha_factura }}</td>
            <td>{{ $cgep->monto_total}}</td>
            <td>{{ $cgep->estacion}}</td>
            <td>{{ $cgep->foto_factura}}</td>
            <td>{{ $cgep->foto_galonera}}</td>
            <td>{{ $cgep->fecha_insercion }}</td>
            <td>{{ $cgep->UsuarioCCIP->name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
