@php
    $x = 1;
@endphp
<table>
    <thead>
        <tr></tr>
        <tr>
            <th></th>
            <th>N°</th>
            <th>Opcion</th>
            <th>Cuadrilla</th>
            <th>Monto</th>
            <th>N. Operacion</th>
            <th>Fecha Recarga</th>    
            <th>Concepto</th>
            <th>Personal</th>
        </tr>
    </thead>
    <tbody>
    @foreach($recarga as $recarga)
        <tr>
            <td></td>
            <td>{{ $x++ }}</td>
            <td>{{ $recarga->opcion }}</td> 
            <td>{{ $recarga->cuadrilla }}</td>     
            <td>{{ $recarga->monto }}</td>
            <td>{{ $recarga->numero_operacion }}</td>
            <td>{{ $recarga->fecha_recarga}}</td>
            <td>{{ $recarga->concepto}}</td>
            <td>{{ $recarga->UsuarioCCIP->name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
