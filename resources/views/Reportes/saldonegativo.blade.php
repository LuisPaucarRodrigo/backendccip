@php
    $x = 1;
@endphp
<table>
        <thead>
        <tr></tr>
            <tr>
                <th></th>
                <th>N°</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Correo Electrónico</th>
                <th>Monto Total</th>
                <th>Egresos</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($saldonegativos as $saldonegativo)
                <tr>
                    <td></td>
                    <td>{{ $x++ }}</td>
                    <td>{{ $saldonegativo->name }}</td>
                    <td>{{ $saldonegativo->lastname }}</td>
                    <td>{{ $saldonegativo->dni }}</td>
                    <td>{{ $saldonegativo->email }}</td>
                    <td>{{ $saldonegativo->monto_total }}</td>
                    <td>{{ $saldonegativo->egresos }}</td>
                    <td>{{ $saldonegativo->saldo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>