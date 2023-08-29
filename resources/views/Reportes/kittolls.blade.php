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
            <th>Mosquetón</th>
            <th>Pelacable</th>
            <th>Crimpadora</th>
            <th>Limas</th>
            <th>Allen</th>
            <th>Readline</th>
            <th>Impacto</th>
            <th>Dielectricos</th>
            <th>Corte</th>
            <th>Fuerza</th>
            <th>Recto</th>
            <th>Francesas</th>
            <th>Sierra</th>
            <th>Silicona</th>
            <th>Polea</th>
            <th>Wincha</th>
            <th>Eslinga</th>
            <th>Brocas</th>
            <th>Sacabocado</th>
            <th>Extractor</th>
            <th>Maleta Grande</th>
            <th>Maleta Mediana</th>
            <th>Personal</th>
        </tr>
    </thead>
    <tbody>
    @foreach($kittolls as $kittoll)
        <tr>
            <td></td>
            <td>{{ $x++ }}</td>
            <td>{{ $kittoll->control_gastos }}</td> 
            <td>{{ $kittoll->cuadrilla }}</td>     
            <td>{{ $kittoll->fecha_insercion }}</td>
            <td>{{ $kittoll->mosqueton }}</td>
            <td>{{ $kittoll->pelacable }}</td>
            <td>{{ $kittoll->crimpeadora }}</td>
            <td>{{ $kittoll->limas }}</td>
            <td>{{ $kittoll->allen }}</td>
            <td>{{ $kittoll->readline }}</td>
            <td>{{ $kittoll->impacto }}</td>
            <td>{{ $kittoll->dielectricos }}</td>
            <td>{{ $kittoll->corte }}</td>
            <td>{{ $kittoll->fuerza }}</td>
            <td>{{ $kittoll->recto }}</td>
            <td>{{ $kittoll->francesas }}</td>
            <td>{{ $kittoll->sierra }}</td>
            <td>{{ $kittoll->silicona }}</td>
            <td>{{ $kittoll->polea }}</td>
            <td>{{ $kittoll->wincha }}</td>
            <td>{{ $kittoll->eslinga }}</td>
            <td>{{ $kittoll->brocas }}</td>
            <td>{{ $kittoll->sacabocado }}</td>
            <td>{{ $kittoll->extractor }}</td>
            <td>{{ $kittoll->maletagrande }}</td>
            <td>{{ $kittoll->maletamediana }}</td>
            <td>{{ $kittoll->UsuarioCCIP->name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
