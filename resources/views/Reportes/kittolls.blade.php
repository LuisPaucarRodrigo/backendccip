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
            <th>Cantidad Mosqueton</th>
            <th>Pelacable</th>
            <th>Cantidad Pelacable</th>
            <th>Crimpadora RJ45</th>
            <th>Cantidad RJ45</th>
            <th>Crimpadora Terminales</th>
            <th>Cantidad Terminales</th>
            <th>Limas</th>
            <th>Cantidad Limas</th>
            <th>Allen</th>
            <th>Cantidad Allen</th>
            <th>Readline</th>
            <th>Cantidad Readline</th>
            <th>Desarmadores Impacto</th>
            <th>Cantidad Impacto</th>
            <th>Desarmadores Dielectricos</th>
            <th>Cantidad Dielectricos</th>
            <th>Corte</th>
            <th>Cantidad Corte</th>
            <th>Fuerza</th>
            <th>Cantidad Fuerza</th>
            <th>Recto</th>
            <th>Cantidad Recto</th>
            <th>Francesas</th>
            <th>Cantidad Francesas</th>
            <th>Sierra</th>
            <th>Cantidad Sierra</th>
            <th>Silicona</th>
            <th>Cantidad Silicona</th>
            <th>Polea</th>
            <th>Cantidad Polea</th>
            <th>Wincha</th>
            <th>Cantidad Wincha</th>
            <th>Eslinga</th>
            <th>Cantidad Eslinga</th>
            <th>Brocas</th>
            <th>Cantidad Brocas</th>
            <th>Sacabocado</th>
            <th>Cantidad Sacabocado</th>
            <th>Extractor</th>
            <th>Cantidad Extractor</th>
            <th>Juego Llaves</th>
            <th>Cantidad Llaves</th>
            <th>Cuter</th>
            <th>Cantidad Cuter</th>
            <th>Llave Thor</th>
            <th>Cantidad Thor</th>
            <th>Maleta Grande</th>
            <th>Cantidad M.Grande</th>
            <th>Maleta Mediana</th>
            <th>Cantidad M.Mediana</th>
            <th>Otros</th>
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
            <td>{{ $kittoll->amountmosqueton }}</td>
            <td>{{ $kittoll->pelacable }}</td>
            <td>{{ $kittoll->amountpelacable }}</td>
            <td>{{ $kittoll->crimpeadora }}</td>
            <td>{{ $kittoll->amountcrimpeadora }}</td>
            <td>{{ $kittoll->crimpeadorater }}</td>
            <td>{{ $kittoll->amountcrimpeadorater }}</td>
            <td>{{ $kittoll->limas }}</td>
            <td>{{ $kittoll->amountlimas }}</td>
            <td>{{ $kittoll->allen }}</td>
            <td>{{ $kittoll->amountallen }}</td>
            <td>{{ $kittoll->readline }}</td>
            <td>{{ $kittoll->amountreadline }}</td>
            <td>{{ $kittoll->impacto }}</td>
            <td>{{ $kittoll->amountimpacto }}</td>
            <td>{{ $kittoll->dielectricos }}</td>
            <td>{{ $kittoll->amountdielectricos }}</td>
            <td>{{ $kittoll->corte }}</td>
            <td>{{ $kittoll->amountcorte }}</td>
            <td>{{ $kittoll->fuerza }}</td>
            <td>{{ $kittoll->amountfuerza }}</td>
            <td>{{ $kittoll->recto }}</td>
            <td>{{ $kittoll->amountrecto }}</td>
            <td>{{ $kittoll->francesas }}</td>
            <td>{{ $kittoll->amountfrancesas }}</td>
            <td>{{ $kittoll->sierra }}</td>
            <td>{{ $kittoll->amountsierra }}</td>
            <td>{{ $kittoll->silicona }}</td>
            <td>{{ $kittoll->amountsilicona }}</td>
            <td>{{ $kittoll->polea }}</td>
            <td>{{ $kittoll->amountpolea }}</td>
            <td>{{ $kittoll->wincha }}</td>
            <td>{{ $kittoll->amountwincha }}</td>
            <td>{{ $kittoll->eslinga }}</td>
            <td>{{ $kittoll->amounteslinga }}</td>
            <td>{{ $kittoll->brocas }}</td>
            <td>{{ $kittoll->amountbrocas }}</td>
            <td>{{ $kittoll->sacabocado }}</td>
            <td>{{ $kittoll->amountsacabocado }}</td>
            <td>{{ $kittoll->extractor }}</td>
            <td>{{ $kittoll->amountextractor }}</td>
            <td>{{ $kittoll->juegollaves }}</td>
            <td>{{ $kittoll->amountjuegollaves }}</td>
            <td>{{ $kittoll->cuter }}</td>
            <td>{{ $kittoll->amountcuter }}</td>
            <td>{{ $kittoll->thor }}</td>
            <td>{{ $kittoll->amountthor }}</td>
            <td>{{ $kittoll->maletagrande }}</td>
            <td>{{ $kittoll->amountmaletagrande }}</td>
            <td>{{ $kittoll->maletamediana }}</td>
            <td>{{ $kittoll->amountmaletamediana }}</td>
            <td>{{ $kittoll->otros }}</td>
            <td>{{ $kittoll->UsuarioCCIP->name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
