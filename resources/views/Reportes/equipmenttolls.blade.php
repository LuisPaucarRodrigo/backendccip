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
            <th>Hidrolavadora</th>
            <th>Sopladora</th>
            <th>Megómetro</th>
            <th>Teleurómetro</th>
            <th>Aperimétrica</th>
            <th>Manómetro</th>
            <th>Pirometro</th>
            <th>Laptop</th>
            <th>Taladro</th>
            <th>Brujula</th>
            <th>Inclinómetro</th>
            <th>Linterna</th>
            <th>Power Meter</th>
            <th>Pistola</th>
            <th>Pértiga</th>
            <th>Cúter</th>
            <th>Escalera</th>
            <th>Extensión</th>
            <th>Pistola de Estaño</th>
            <th>Escalera Tijera</th>
            <th>Carrito</th>
            <th>Personal</th>
        </tr>
    </thead>
    <tbody>
    @foreach($equiptolls as $equiptoll)
        <tr>
            <td></td>
            <td>{{ $x++ }}</td>
            <td>{{ $equiptoll->control_gastos }}</td> 
            <td>{{ $equiptoll->cuadrilla }}</td>     
            <td>{{ $equiptoll->fecha_insercion }}</td>
            <td>{{ $equiptoll->hidrolavadora }}</td>
            <td>{{ $equiptoll->sopladora }}</td>
            <td>{{ $equiptoll->megometro }}</td>
            <td>{{ $equiptoll->telurometro }}</td>
            <td>{{ $equiptoll->aperimetrica }}</td>
            <td>{{ $equiptoll->manometro }}</td>
            <td>{{ $equiptoll->pirometro }}</td>
            <td>{{ $equiptoll->laptop }}</td>
            <td>{{ $equiptoll->taladro }}</td>
            <td>{{ $equiptoll->brujula }}</td>
            <td>{{ $equiptoll->inclinometro }}</td>
            <td>{{ $equiptoll->linterna }}</td>
            <td>{{ $equiptoll->powermeter }}</td>
            <td>{{ $equiptoll->pistola }}</td>
            <td>{{ $equiptoll->pertiga }}</td>
            <td>{{ $equiptoll->cuter }}</td>
            <td>{{ $equiptoll->escalera }}</td>
            <td>{{ $equiptoll->extension }}</td>
            <td>{{ $equiptoll->pistolaestano }}</td>
            <td>{{ $equiptoll->escaleratijera }}</td>
            <td>{{ $equiptoll->carrito }}</td>
            <td>{{ $equiptoll->UsuarioCCIP->name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
