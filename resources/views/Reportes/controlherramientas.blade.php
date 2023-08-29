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
            <th>Juego de Llaves</th>
            <th>Juego de Dados</th>
            <th>Cúter</th>
            <th>Arnés</th>
            <th>Personal</th>
        </tr>
    </thead>
    <tbody>
    @foreach($controltolls as $controltoll)
        <tr>
            <td></td>
            <td>{{ $x++ }}</td>
            <td>{{ $controltoll->control_gastos }}</td> 
            <td>{{ $controltoll->cuadrilla }}</td>     
            <td>{{ $controltoll->fecha_insercion }}</td>
            <td>{{ $controltoll->juegollaves }}</td>
            <td>{{ $controltoll->juegodados }}</td>
            <td>{{ $controltoll->cuter }}</td>
            <td>{{ $controltoll->arnes }}</td>
            <td>{{ $controltoll->UsuarioCCIP->name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
