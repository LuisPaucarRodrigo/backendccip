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
            <th>Carro Anticaidas</th>
            <th>Cantidad Anticaidas</th>
            <th>Linea Vida</th>
            <th>Cantidad Linea Vida</th>
            <th>Linea Posicionamiento</th>
            <th>Cantidad Posicionamiento</th>
            <th>Arnés</th>
            <th>Cantidad Arnes</th>
            <th>Personal</th>
        </tr>
    </thead>
    <tbody>
    @foreach($controlepps as $controlepp)
        <tr>
            <td></td>
            <td>{{ $x++ }}</td>
            <td>{{ $controlepp->control_gastos }}</td> 
            <td>{{ $controlepp->cuadrilla }}</td>     
            <td>{{ $controlepp->fecha_insercion }}</td>
            <td>{{ $controlepp->carroanticaidas }}</td>
            <td>{{ $controlepp->amountcarroanticaidas }}</td>
            <td>{{ $controlepp->lineavida }}</td>
            <td>{{ $controlepp->amountlineavida }}</td>
            <td>{{ $controlepp->lineaposicionamiento }}</td>
            <td>{{ $controlepp->amountlineaposicionamiento }}</td>
            <td>{{ $controlepp->arnes }}</td>
            <td>{{ $controlepp->amountarnes }}</td>
            <td>{{ $controlepp->UsuarioCCIP->name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
