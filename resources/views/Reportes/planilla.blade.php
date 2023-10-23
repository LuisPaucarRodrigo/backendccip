@php
$x = 1;
@endphp
<table>     <tr></tr>
            <thead>
                <tr>
                    <th></th>
                    <th>Nº</th>
                    <th>DNI</th>
                    <th>Nombres</th>
                    <th>REGIMEN PENSIONARIO</th>
                    <th>FECHA INGRESO</th>
                    <th>SUELDO BASICO</th>
                    <th>VACACIONES TRUNCAS</th>
                    <th>SUBSIDIOS POR MATERNIDAD</th>
                    <th>TOTAL INGRESOS</th>
                    <th>TOTAL BASE GRAVADA SISTEMA PENSIONARIO</th>
                    <th>% SNP</th>
                    <th>SNP / ONP</th>
                    <th>% COM</th>
                    <th>COMISIÓN % SOBRE R.A.</th>
                    <th>% SEG</th>
                    <th>PRIMA DE SEGURO</th>
                    <th>% AP OBLI</th>
                    <th>APORTE OBLIGATORIO</th>
                    <th>TOTAL DESCUENTOS</th>
                    <th>NETO A PAGAR</th>
                    <th>TOTAL BASE GRAVADA ESSALUD</th>
                    <th>SALUD 9%</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuarios)
                <tr class="tr">
                    <td></td>
                    <td>{{ $x++ }}</td>
                    <td>{{$usuarios->UsuarioCCIP->dni}}</td>
                    <td>{{$usuarios->UsuarioCCIP->name}} {{$usuarios->UsuarioCCIP->lastname}}</td>
                    <td>{{$usuarios->regimen_pensionario}}</td>
                    <td>{{$usuarios->fecha_ingreso}}</td>
                    <td>{{$usuarios->sueldo_basico}}</td>
                    <td>{{$usuarios->vacaciones_truncas}}</td>
                    <td>{{$usuarios->subsidios_maternidad}}</td>
                    @php
                    $total_ingresos = $usuarios->sueldo_basico + $usuarios->vacaciones_truncas + $usuarios->subsidios_maternidad;
                    @endphp
                    <td>{{$total_ingresos}}</td>
                    <td>{{$total_ingresos}}</td>
                    @php
                    $onp = ($usuarios->regimen_pensionario == 'ONP') ? 0.13 : 0;
                    $onpresult = $total_ingresos * $onp;
                    $onpprint = ($onp == 0) ? " ": "13%";
                    $onpresulprint = ($onp == 0) ? " ": $onpresult;
                    @endphp
                    <td>{{$onpprint}}</td>
                    <td>{{$onpresulprint}}</td>
                    @php
                    $comregimenValues = [];

                    foreach (['PRIMA', 'HABITAT', 'PROFUTURO', 'INTEGRA', 'PRIMAMX', 'HABITATMX', 'PROFUTUROMX', 'INTEGRAMX'] as $afp) {
                        $afpObject = $afps->firstWhere('type', $afp); // Encuentra el objeto que coincide con el tipo

                        if ($afpObject) {
                            $comregimenValues[$afp] = number_format(($afpObject->val_csf) / 100, 4, '.', ',') ;
                        } else {
                            $comregimenValues[$afp] = 0;
                        }
                    }


                    $comregimen = $comregimenValues[$usuarios->regimen_pensionario] ?? 0;

                    $com = ($usuarios->regimen_pensionario == 'ONP') ? 0:$comregimen;
                    $conresult = $total_ingresos * $com;
                    $comprint = ($com == 0) ? " ": strval($com*100).'%';
                    $comresulprint = ($com == 0) ? " ": $conresult;
                    @endphp
                    <td>{{$comprint}}</td>
                    <td>{{$comresulprint}}</td>
                    @php
                    $seg = ($usuarios->regimen_pensionario == 'ONP') ? 0: 0.0184;
                    $segresult = $total_ingresos * $seg;
                    $segprint = ($seg == 0) ? " ": "1.84%";
                    $segresulprint = ($seg == 0) ? " ": $segresult;
                    @endphp
                    <td>{{$segprint }}</td>
                    <td>{{$segresulprint}}</td>
                    @php
                    $obli = ($usuarios->regimen_pensionario == 'ONP') ? 0: 0.1;
                    $obliresult = $total_ingresos * $obli;
                    $obliprint = ($obli == 0) ? " ": "10%";
                    $obliresulprint = ($obli == 0) ? " ": $obliresult;
                    @endphp
                    <td>{{$obliprint}}</td>
                    <td>{{$obliresulprint}}</td>
                    @php
                    $total_descuentos = $onpresult +$conresult + $segresult + $obliresult;
                    $total_print_descuentos = ($usuarios->regimen_pensionario == 'ONP') ? " ":$total_descuentos ;
                    @endphp
                    <td>{{$total_descuentos}}</td>
                    <td>{{number_format($total_ingresos - $total_descuentos,0)}}</td>
                    <td>{{$total_ingresos}}</td>
                    <td>{{$total_ingresos * 0.09}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>