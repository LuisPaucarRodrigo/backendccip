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
            <th>Placa</th>
            <th>Bocina</th>
            <th>Frenos</th>
            <th>Luces Altas/Bajas</th>
            <th>Intermitentes</th>
            <th>Direccionales</th>
            <th>Retrovisores</th>
            <th>Neumáticos</th>
            <th>Parachoques</th>
            <th>Temperatura</th>
            <th>Aceite</th>
            <th>Combustible</th>
            <th>Aseo del Vehículo</th>
            <th>Puertas</th>
            <th>Parabrisas</th>
            <th>Motor</th>
            <th>Batería</th>
            <th>ImagenFrontal</th>
            <th>ImagenIzquierdo</th>
            <th>ImagenDerecha</th>
            <th>ImagenInterna</th>
            <th>Personal</th>
        </tr>
    </thead>
    <tbody>
    @foreach($statecars as $statecar)
        <tr>
            <td></td>
            <td>{{ $x++ }}</td>
            <td>{{ $statecar->control_gastos }}</td> 
            <td>{{ $statecar->cuadrilla }}</td>     
            <td>{{ $statecar->fecha_insercion }}</td>
            <td>{{ $statecar->placa }}</td>
            <td>{{ $statecar->bocina }}</td>
            <td>{{ $statecar->frenos}}</td>
            <td>{{ $statecar->lucesaltasbajas}}</td>
            <td>{{ $statecar->intermitentes}}</td>
            <td>{{ $statecar->direccionales}}</td>
            <td>{{ $statecar->retrovisores}}</td>
            <td>{{ $statecar->neumaticos}}</td>
            <td>{{ $statecar->parachoques}}</td>
            <td>{{ $statecar->temperatura}}</td>
            <td>{{ $statecar->aceite}}</td>
            <td>{{ $statecar->combustible}}</td>
            <td>{{ $statecar->aseovehiculo}}</td>
            <td>{{ $statecar->puertas}}</td>
            <td>{{ $statecar->parabrisas}}</td>
            <td>{{ $statecar->motor}}</td>
            <td>{{ $statecar->bateria}}</td>
            <td>{{ $statecar->foto_front}}</td>
            <td>{{ $statecar->foto_left}}</td>
            <td>{{ $statecar->foto_right}}</td>
            <td>{{ $statecar->foto_interno}}</td>
            <td>{{ $statecar->UsuarioCCIP->name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
