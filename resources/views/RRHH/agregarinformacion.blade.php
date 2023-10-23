@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
    <h1>Personal</h1>
@stop

@section('content')
<div class="container">

    <form method="POST" action="/rrhh/personal/informacionpersonal" enctype="multipart/form-data">
        @csrf

        <h3>Datos Personales</h3>

        <div class="form-group">
                <label for="usuario_id">Seleccionar Usuario:</label>
                <select name="usuario_id" id="usuario_id" class="form-control" required>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="imagen">Foto de personal:</label>
                <input type="file" name="imagen" id="imagen" class="form-control">
            </div>

            <!-- Contenedor para la imagen recortada -->
            <div class="form-group" >
                <label>Imagen Recortada:</label>
                <div id="imagenRecortada" style="max-width: 100%; height: auto;"></div>
            </div>

            <input type="hidden" name="imagen_recortada" id="imagen_recortada_input">

            <!-- Botón para abrir la ventana de recorte -->
            <button type="button" class="btn btn-primary" id="abrirRecorte">Recortar Imagen</button>

        <div class="form-group">
            <label for="sexo">Sexo:</label>
            <select name="sexo" id="sexo" class="form-control" required>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
            </select>
        </div>

        <div class="form-group">
            <label for="estado_civil">Estado Civil:</label>
            <select name="estado_civil" id="estado_civil" class="form-control" required>
                <option value="Casado(a)">Casado(a)</option>
                <option value="Soltero(a)">Soltero(a)</option>
                <option value="Viudo(a)">Viudo(a)</option>
                <option value="Divorciado(a)">EDivorciado(a)</option>
                <option value="Conviviente">Conviviente</option>
            </select>
        </div>

        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="telefono_movil1">Telefono móvil 1:</label>
            <input type="text" name="telefono_movil1" id="telefono_movil1" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="telefono_movil2">Telefono móvil 2:</label>
            <input type="text" name="telefono_movil2" id="telefono_movil2" class="form-control">
        </div>

        <div class="form-group">
            <label for="correo_personal">Correo personal:</label>
            <input type="email" name="correo_personal" id="correo_personal" class="form-control" required>
        </div>
        <h3>Informacion de contrato</h3>
        <div class="form-group">
            <label for="regimen_pensionario">Regimen Pensionario:</label>
            <select name="regimen_pensionario" id="regimen_pensionario" class="form-control" required>
                <option value="ONP">ONP</option>
                <option value="INTEGRA">INTEGRA</option>
                <option value="HABITAT">HABITAT</option>
                <option value="PROFUTURO">PROFUTURO</option>
                <option value="PRIMA">PRIMA</option>
                <option value="INTEGRAMX">INTEGRAMX</option>
                <option value="HABITATMX">HABITATMX</option>
                <option value="PROFUTUROMX">PROFUTUROMX</option>
                <option value="PRIMAMX">PRIMAMX</option>
            </select>
        </div>
        <div class="form-group">
            <label for="sueldo_basico">Sueldo basico:</label>
            <input type="text" name="sueldo_basico" id="sueldo_basico" class="form-control">
        </div>
        <div class="form-group">
            <label for="fecha_ingreso">Fecha de Ingreso a la Empresa:</label>
            <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" required>
        </div>
        <h3>Estudios</h3>
        <div class="form-group">
            <label for="centro_estudios">Estudios:</label>
            <select name="centro_estudios" id="centro_estudios" class="form-control" required>
                <option value="Universidad">Universidad</option>
                <option value="Instituto">Instituto</option>
                <option value="Otros">Otros</option>
            </select>
        </div>

        <div class="form-group">
            <label for="estado_estudios">Estado de Estudios:</label>
            <select name="estado_estudios" id="estado_estudios" class="form-control" required>
                <option value="Culminado">Culminado</option>
                <option value="En Progreso">En Progreso</option>
            </select>
        </div>

        <div class="form-group">
            <label for="especialidad">Especialidad:</label>
            <input type="text" name="especialidad" id="especialidad" class="form-control">
        </div>
        
        <h3>Domicilio Actual</h3>
        <div class="form-group">
            <label for="distrito">Distrito:</label>
            <input type="text" name="distrito" id="distrito" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="provincia">Provincia:</label>
            <input type="text" name="provincia" id="provincia" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="departamento">Departamento:</label>
            <input type="text" name="departamento" id="departamento" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="nacionalidad">Nacionalidad:</label>
            <input type="text" name="nacionalidad" id="nacionalidad" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección Completa:</label>
            <input type="text" name="direccion" id="direccion" class="form-control" required>
        </div>

        <h3>En caso de emergencia autorizo que la entidad se comunique con:</h3>
        <div class="form-group">
            <label for="contacto_emergencia">Nombres y Apellidos:</label>
            <input type="text" name="nombres_apellidos" id="contacto_emergencia" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="parentesco_emergencia">Parentesco:</label>
            <input type="text" name="parentesco" id="parentesco_emergencia" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="telefono_emergencia">Telefono:</label>
            <input type="text" name="telefono" id="telefono_emergencia" class="form-control" required>
        </div>

        <h3>Datos de Familia Dependiente (Hijos y/o Padres)</h3>
        <div class="form-group">
            <label for="parentesco_familia">Parentesco:</label>
            <input type="text" name="parentesco" id="parentesco" class="form-control">
        </div>

        <div class="form-group">
            <label for="nombres_familia">Apellidos y Nombres:</label>
            <input type="text" name="nombres_apellidos" id="nombres_apellidos" class="form-control">
        </div>

        <div class="form-group">
            <label for="dni_familia">DNI:</label>
            <input type="text" name="dni" id="dni" class="form-control">
        </div>

        <div class="form-group">
            <label for="grado_instruccion_familia">Grado de Instrucción:</label>
            <input type="text" name="grado_instruccion" id="grado_instruccion_familia" class="form-control">
        </div>

        <h3>Salud</h3>
        <div class="form-group">
            <label for="grupo_sanguineo">Grupo Sanguineo:</label>
            <select name="grupo_sanguineo" id="grupo_sanguineo" class="form-control" required>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>
        </div>

        <div class="form-group">
            <label for="peso">Peso:</label>
            <input type="text" name="peso" id="peso" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="estatura">Estatura (cm):</label>
            <input type="text" name="estatura" id="estatura" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="talla_zapato">Talla de Zapato:</label>
            <input type="text" name="talla_zapato" id="talla_zapato" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="talla_camisa">Talla de Camisa:</label>
            <input type="text" name="talla_camisa" id="talla_camisa" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="talla_pantalon">Talla de Pantalón:</label>
            <input type="text" name="talla_pantalon" id="talla_pantalon" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="enfermedad">¿Padece alguna enfermedad? De ser el caso, especificar:</label>
            <input type="text" name="enfermedad" id="enfermedad" class="form-control">
        </div>

        <div class="form-group">
            <label for="alergico_medicamento">¿Es alérgico a algún medicamento? De ser el caso, especificar:</label>
            <input type="text" name="alergico_medicamento" id="alergico_medicamento" class="form-control">
        </div>

        <div class="form-group">
            <label for="operaciones">¿Ha tenido operaciones? De ser el caso, especificar:</label>
            <input type="text" name="operaciones" id="operaciones" class="form-control">
        </div>

        <div class="form-group">
            <label for="accidentes_graves">¿Ha sufrido accidentes graves? De ser el caso, especificar:</label>
            <input type="text" name="accidentes_graves" id="accidentes_graves" class="form-control">
        </div>

        <div class="form-group">
            <label for="vacunas">¿Tiene vacunas aplicadas? De ser el caso, especificar:</label>
            <input type="text" name="vacunas" id="vacunas" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://unpkg.com/cropperjs@1.5.12/dist/cropper.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/cropperjs@1.5.12/dist/cropper.js"></script>
    <script>
        $(document).ready(function() {
            var imagen = document.getElementById('imagen');
            var imagenRecortada = document.getElementById('imagenRecortada');
            var abrirRecorte = document.getElementById('abrirRecorte');
            var cropper;

            imagen.addEventListener('change', function() {
                var files = this.files;
                var file;

                if (files && files.length > 0) {
                    file = files[0];

                    var reader = new FileReader();
                    reader.onload = function(e) {
                        imagenRecortada.innerHTML = '<img src="' + e.target.result + '">';
                        abrirRecorte.style.display = 'block';

                        // Inicializa Cropper.js
                        cropper = new Cropper(imagenRecortada.firstChild, {
                            aspectRatio: 1, // Proporción deseada
                            viewMode: 2, // Vista previa
                        });
                    };

                    reader.readAsDataURL(file);
                }
            });

            abrirRecorte.addEventListener('click', function() {
                cropper.getCroppedCanvas().toBlob(function(blob) {
                    var reader = new FileReader();

                    reader.onload = function() {
                        var nuevaImagen = new Image();
                        nuevaImagen.src = reader.result;

                        // Asignar la imagen recortada al campo oculto
                        document.getElementById('imagen_recortada_input').value = nuevaImagen.src;

                        imagenRecortada.innerHTML = '';
                        imagenRecortada.appendChild(nuevaImagen);

                        // Ahora puedes activar el botón para enviar el formulario
                        document.getElementById('boton_enviar').disabled = false;
                    };

                    reader.readAsDataURL(blob);
                }, 'image/png'); // Especifica el tipo de archivo (en este caso, PNG)
            });
        });
    </script>


@stop
