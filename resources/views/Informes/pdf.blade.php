<!DOCTYPE html>
<html>
<head>
    <style>
        /* Estilos adicionales para el PDF, si es necesario */
    </style>
</head>
<body>
    <h1>Reporte de Usuarios</h1>
    <p>Fecha de inicio: {{ $fecha_Inicio }}</p>
    <p>Fecha de fin: {{ $fecha_Fin }}</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nro. Factura</th>
                <th>Fecha Factura</th>
                <th>Monto Total</th>
                <th>Kilometraje</th>
                <th>Foto KM</th>
                <th>Foto Factura</th>
                <th>Cuadrilla</th>
                <th>Fecha Combustible</th>
                <th>Usuario ID</th>
                <th>Fecha de Creación</th>
                <th>Fecha de Actualización</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($combustibles as $combustible)
                <tr>
                    <td>{{ $combustible->id }}</td>
                    <td>{{ $combustible->nro_factura }}</td>
                    <td>{{ $combustible->fecha_factura }}</td>
                    <td>{{ $combustible->monto_total }}</td>
                    <td>{{ $combustible->kilometraje }}</td>
                    <td><img src="{{ Str::after($combustible->foto_km, '192.168.1.81:8000/') }}" alt="Foto KM" style="max-width: 100px;"></td>
                    <td><img src="{{ Str::after($combustible->foto_factura, '192.168.1.81:8000/') }}" alt="Foto Factura" style="max-width: 100px;"></td>
                    <td>{{ $combustible->cuadrilla }}</td>
                    <td>{{ $combustible->fecha_combustible }}</td>
                    <td>{{ $combustible->usuario_id }}</td>
                    <td>{{ $combustible->created_at }}</td>
                    <td>{{ $combustible->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
