<?php

namespace App\Http\Controllers;

use App\Models\Datosemergencia;
use App\Models\Datosfamilia;
use App\Models\Domicilio;
use App\Models\Estudio;
use App\Models\Informacionpersonal;
use App\Models\Informacionusuario;
use App\Models\Recarga;
use App\Models\Planilla;
use App\Models\Salud;
use App\Models\User;
use App\Models\UsuarioCCIP;
use App\Http\Requests\CCIPRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Http\Requests\forgotRequest;
use App\Models\Typepension;

class RRHHController extends Controller
{
    public function modifyafp()
    {
        $afps = Typepension::all();
        return view('RRHH.modifyafp', compact('afps'));
    }

    public function modifyafpedit(Request $request, $id)
    {
        $data = $request->all();

        // Encuentra el registro por su ID
        $afp = Typepension::find($id);

        // Actualiza los campos con los nuevos valores
        $afp->type = $data['type'];
        $afp->val_csf = $data['val_csf'];
        $afp->val_pri_seg = $data['val_pri_seg'];
        $afp->val_apor_obli = $data['val_apor_obli'];

        // Guarda el registro actualizado en la base de datos
        $afp->save();

        // Puedes devolver una respuesta de éxito
        return response()->json(['afps' => 'Registro actualizado con éxito']);
    }

    public function agregarinfoadicionalbd(Request $request)
    {
        $adicional = Planilla::where('usuario_id', $request->usuario_id)->first();
        $adicional->vacaciones_truncas = $request->vacaciones_truncas;
        $adicional->subsidios_maternidad = $request->subsidios_maternidad;
        $adicional->save();
        return redirect('/rrhh/personal');
    }

    public function agregarinfoadicional()
    {
        $usuarios = UsuarioCCIP::all();
        return view('RRHH.informacionadicional', compact('usuarios'));
    }

    public function agregarinfo()
    {
        $usuarios = UsuarioCCIP::all();
        return view('RRHH.agregarinformacion', compact('usuarios'));
    }

    public function planillaindex()
    {
        $usuarios = Planilla::with('UsuarioCCIP')->get();
        $afps = Typepension::select('val_csf', 'type')->get();
        return view('RRHH.planilla', compact('usuarios', 'afps'));
    }

    public function personalindex()
    {
        $usuarios = UsuarioCCIP::all();
        return view('RRHH.personal', compact('usuarios'));
    }

    public function obtener_usuarios(Request $request)
    {
        $rol = $request->input('rol');
        if ($rol === 'movil') {
            $usuarios = UsuarioCCIP::all();
        } elseif ($rol === 'administrador') {
            $usuarios = User::all();
        } else {
            $usuarios = [];
        }
        return response()->json($usuarios);
    }

    public function informacionpersonaladicional(Request $request)
    {
        $usuario_id = $request->usuario_id;

        $image = str_replace('data:image/png;base64,', '', $request->imagen_recortada);
        $image = str_replace(' ', '+', $image);
        $imageContnt = base64_decode($image);
        $path = 'estees' . time() . '.png';
        $ruta = "192.168.1.78:8000/imagenes/" . $path;
        File::put(public_path('imagenes/') . $path, $imageContnt);

        Informacionpersonal::updateOrCreate(
            ['usuario_id' => $usuario_id],
            array_merge(
                $request->only(['sexo', 'estado_civil', 'fecha_nacimiento', 'telefono_movil1', 'telefono_movil2', 'correo_personal']),
                ['foto' => $ruta] // Aquí agregamos la foto al array de datos
            )
        );

        // Actualizar o crear Planilla
        Planilla::updateOrCreate(
            ['usuario_id' => $usuario_id],
            $request->only(['regimen_pensionario', 'sueldo_basico', 'fecha_ingreso'])
        );

        // Actualizar o crear Estudio
        Estudio::updateOrCreate(
            ['usuario_id' => $usuario_id],
            $request->only(['centro_estudios', 'estado_estudios', 'especialidad'])
        );

        // Actualizar o crear Domicilio
        Domicilio::updateOrCreate(
            ['usuario_id' => $usuario_id],
            $request->only(['distrito', 'provincia', 'departamento', 'nacionalidad', 'direccion'])
        );

        // Actualizar o crear Datos de Emergencia
        Datosemergencia::updateOrCreate(
            ['usuario_id' => $usuario_id],
            $request->only(['nombres_apellidos', 'parentesco', 'telefono'])
        );

        // Actualizar o crear Datos de Familia
        Datosfamilia::updateOrCreate(
            ['usuario_id' => $usuario_id],
            $request->only(['parentesco', 'nombres_apellidos', 'dni', 'grado_instruccion'])
        );

        // Actualizar o crear Salud
        Salud::updateOrCreate(
            ['usuario_id' => $usuario_id],
            $request->only(['grupo_sanguineo', 'peso', 'estatura', 'talla_zapato', 'talla_camisa', 'talla_pantalon', 'enfermedad', 'alergico_medicamento', 'operaciones', 'accidentes_graves', 'vacunas'])
        );


        return redirect('/rrhh/personal');
    }

    public function create(CCIPRequest $request)
    {
        $usuario = new UsuarioCCIP();
        $usuario->name = $request->get('name');
        $usuario->lastname = $request->get('lastname');
        $usuario->username = $request->get('username');
        $usuario->dni = $request->get('dni');
        $usuario->email = $request->get('email');
        $usuario->monto_total = $request->get('saldo');
        $usuario->saldo = $request->get('saldo');
        $usuario->password = ($request->password);
        $usuario->estado = $request->get('estado');
        $usuario->remember_token = Str::uuid();
        $usuario->save();
        return redirect('/rrhh/personal');
    }

    public function modify($id)
    {
        $usuario = UsuarioCCIP::all('id', 'name', 'lastname', 'dni', 'username', 'email', 'estado')
            ->where('id', "=", $id)->first();
        return view('RRHH.editUser')->with('usuario', $usuario);
    }

    public function delete($id)
    {
        $usuario = UsuarioCCIP::destroy($id);
        return redirect('/rrhh/personal');
    }

    public function update(Request $request, $id)
    {
        $usuario = UsuarioCCIP::all()->where('id', "=", $id)->first();
        $usuario->name = $request->name;
        $usuario->lastname = $request->lastname;
        $usuario->username = $request->username;
        $usuario->dni = $request->dni;
        $usuario->email = $request->email;
        if ($usuario->estado != $request->estado) {
            $usuario->estado = $request->estado;
            $usuario->remember_token = Str::uuid();
        }
        $usuario->save();
        return redirect('/rrhh/personal');
    }

    //password
    public function edit_password($id)
    {
        return view('RRHH.forgotPassword')->with('id', $id);
    }

    public function update_password(forgotRequest $request, $id)
    {
        $usuario = UsuarioCCIP::all()->where('id', "=", $id)->first();
        $usuario->password = ($request->password);
        $usuario->save();
        return redirect('/rrhh/mostrarUsuario/' . $id);
    }

    public function liquidar()
    {
        $usuario = UsuarioCCIP::all();
        foreach ($usuario as $user) {
            $recarga = Recarga::where('usuario_id', $user->id)
                ->latest()
                ->first();
            //dd($recarga);
            if ($user->saldo < 0) {
                $recarga->monto += $user->saldo;
                $user->egresos = $user->saldo * (-1);
                $user->monto_total = 0;
                $user->saldo = $user->saldo;
            } elseif ($user->saldo > 0) {
                $recarga->monto -= $user->saldo;
                $user->egresos = 0;
                $user->monto_total = $user->saldo;
                $user->saldo = $user->saldo;
                $newrecarga = new Recarga();
                $newrecarga->opcion = $recarga->opcion;
                $newrecarga->cuadrilla = $recarga->cuadrilla;
                $newrecarga->monto = $user->saldo;
                $newrecarga->numero_operacion = $recarga->monto;
                $newrecarga->fecha_recarga = $recarga->fecha_recarga;
                $newrecarga->concepto = $recarga->concepto;
                $newrecarga->usuario_id = $recarga->usuario_id;
                $newrecarga->save();
            }
            $user->save();
            $recarga->save();
        };
        return redirect('/rrhh/personal');
    }
}
