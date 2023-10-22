@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<h1>Modify AFP</h1>
@stop

@section('content')
<div class="container">
    <h1>Modificar AFPs</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Valor CSF</th>
                <th>Valor PRI-SEG</th>
                <th>Valor APOR-OBLI</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($afps as $afp)
            <tr>
                <td contenteditable="true" class="edit-field" data-field="type">{{ $afp->type }}</td>
                <td contenteditable="true" class="edit-field" data-field="val_csf">{{ $afp->val_csf }}</td>
                <td contenteditable="true" class="edit-field" data-field="val_pri_seg" disabled>{{ $afp->val_pri_seg }}</td>
                <td contenteditable="true" class="edit-field" data-field="val_apor_obli">{{ $afp->val_apor_obli }}</td>
                <td>
                    <button class="btn btn-primary update-btn" data-id="{{ $afp->id }}">Guardar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        // Habilitar edición en línea al hacer clic en una celda
        $('.edit-field').click(function() {
            $(this).attr('contenteditable', true);
        });

        // Procesar el botón "Guardar"
        $('.update-btn').click(function() {
            var afpId = $(this).data('id');
            var updatedData = {};


            // Recopilar los datos actualizados de la fila
            $(this).closest('tr').find('.edit-field').each(function() {
                var field = $(this).data('field');
                var value = $(this).text();
                updatedData[field] = value;
            });

            // Realizar una solicitud AJAX para actualizar los datos
            $.ajax({
                method: 'POST',
                url: '/rrhh/aporteregimen/edit/' + afpId, // Reemplaza con la URL de tu controlador de actualización
                data: updatedData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Agregar el token CSRF como encabezado
                },
                success: function(response) {

                    alert('Datos actualizados con éxito');
                },
                error: function(error) {
                    // Manejar los errores, por ejemplo, mostrar un mensaje de error
                    alert('Error al actualizar los datos');
                }
            });
        });
    });
</script>

@stop