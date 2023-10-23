<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return redirect('/login');
});
Route::get('/php', function () {
    return view('welcome');
});

Route::get('/login', [\App\Http\Controllers\LoginController::class, 'show']);
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\LoginController::class, 'logout']);
Route::get('/register', [\App\Http\Controllers\RegisterController::class, 'show']);
Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'register']);

Route::middleware(['admin', 'can:admin.general'])->group(function () {
    //Gneral
    Route::get('/home/general', [\App\Http\Controllers\HomeController::class, 'general']);
    Route::post('/home/general/config', [\App\Http\Controllers\HomeController::class, 'general']);
    Route::post('/home/general/actualizar', [\App\Http\Controllers\HomeController::class, 'actualizar']);
    Route::post('/home/general/actualizar/users', [\App\Http\Controllers\HomeController::class, 'actualizargraficusers']);

    Route::get('/home/general/config', function () {
        return redirect()->route('/home/general');
    });

    //InformesPdf
    Route::get('/home/informes', [\App\Http\Controllers\HomeController::class, 'generarpdf']);
    Route::post('/home/informes/generatepdf', [\App\Http\Controllers\HomeController::class, 'generatepdf']);
});

Route::middleware(['can:admin.tareas'])->group(function () {
    //Tareas
    Route::post('/home/registertask', [\App\Http\Controllers\TareasController::class, 'registertask']);
    Route::get('/home/tareas', [\App\Http\Controllers\TareasController::class, 'listtareas']);
    Route::post('/home/tareas/user', [\App\Http\Controllers\TareasController::class, 'listtareas']);
    Route::get('/home/tareas/user/delete/{id}', [\App\Http\Controllers\TareasController::class, 'deletetask']);
    Route::get('/home/tareas/user/redirectupdate/{id}', [\App\Http\Controllers\TareasController::class, 'redirectupdatetask']);
    Route::post('/home/tareas/user/update', [\App\Http\Controllers\TareasController::class, 'updatetask']);

    Route::post('/home/tareas/import/export', [\App\Http\Controllers\TareasController::class, 'import']);
});

Route::middleware(['can:admin.listado'])->group(function () {
    //Listado de Roles
    Route::get('/home/roleslist', [\App\Http\Controllers\RolController::class, 'index']);
    Route::get('/home/role/edit/{id}', [\App\Http\Controllers\RolController::class, 'edit']);
    Route::post('/home/role/update', [\App\Http\Controllers\RolController::class, 'update']);
    Route::get('/home/role/delete/{id}', [\App\Http\Controllers\RolController::class, 'delete']);
    Route::post('/home/role/createrol', [\App\Http\Controllers\RolController::class, 'createrol']);
    Route::get('/home/role/newrol', [\App\Http\Controllers\RolController::class, 'create']);
});

Route::middleware(['can:admin.usuarios'])->group(function () {
    //Usuarios
    Route::get('/home', [\App\Http\Controllers\UsuariosCCIPController::class, 'index']);
    Route::get('/administradores', [\App\Http\Controllers\UsuariosCCIPController::class, 'useradministradores']);
    //Register

    //usersadmin
    Route::get('/home/editaradmin/{id}', [\App\Http\Controllers\UsuariosCCIPController::class, 'editaradmin']);
    Route::post('/home/updateuseradmin', [\App\Http\Controllers\UsuariosCCIPController::class, 'updateuseradmin']);
    //Recargas
    Route::post('/home/recargar/users', [\App\Http\Controllers\UsuariosCCIPController::class, 'recargar']);
    //Notificaciones
    Route::post('/home/notification', [\App\Http\Controllers\UsuariosCCIPController::class, 'notification']);
    Route::get('/rrhh/liquidarUsuario', [\App\Http\Controllers\UsuariosCCIPController::class, 'liquidar']);
});

Route::middleware(['can:admin.reportes'])->group(function () {
    //Reportes
    Route::get('/home/reportes', [\App\Http\Controllers\ReportesController::class, 'generate']);
    Route::post('/home/reportes', [\App\Http\Controllers\ReportesController::class, 'generate']);
});

Route::middleware(['can:admin.operaciones'])->group(function () {
    //Planta Interna
    Route::get('/home/plantainterna', [\App\Http\Controllers\PLantaInternaController::class, 'controlgastos']);
    Route::post('/home/plantainterna', [\App\Http\Controllers\PLantaInternaController::class, 'controlgastos']);
});

Route::middleware(['can:admin.rrhh'])->group(function () {
    Route::get('/rrhh/personal', [\App\Http\Controllers\RRHHController::class, 'personalindex']);
    Route::get('/rrhh/planilla', [\App\Http\Controllers\RRHHController::class, 'planillaindex']);
    Route::get('/rrhh/planilla/export', [\App\Http\Controllers\RRHHController::class, 'planillaexport']);
    
    Route::get('/obtener_usuarios', [\App\Http\Controllers\RRHHController::class, 'obtener_usuarios']);
    Route::get('/rrhh/informacionpersonal/new', [\App\Http\Controllers\RRHHController::class, 'agregarinfo']);
    Route::get('/rrhh/aporteregimen', [\App\Http\Controllers\RRHHController::class, 'modifyafp']);
    Route::post('/rrhh/aporteregimen/edit/{id}', [\App\Http\Controllers\RRHHController::class, 'modifyafpedit']);
    Route::get('/rrhh/informacionpersonal/adicional', [\App\Http\Controllers\RRHHController::class, 'agregarinfoadicional']);
    Route::post('/rrhh/informacionadicional', [\App\Http\Controllers\RRHHController::class, 'agregarinfoadicionalbd']);
    Route::post('/rrhh/personal/informacionpersonal', [\App\Http\Controllers\RRHHController::class, 'informacionpersonaladicional']);
    Route::get('/rrhh/nuevoUsuario', function () {
        return view('RRHH.newUser');
    });
    Route::post('/rrhh/createuser', [\App\Http\Controllers\RRHHController::class, 'create']);
    Route::get('/rrhh/mostrarUsuario/{id}', [\App\Http\Controllers\RRHHController::class, 'modify']);
    Route::get('/rrhh/delete/{id}', [\App\Http\Controllers\RRHHController::class, 'delete']);
    Route::post('/rrhh/update/{id}', [\App\Http\Controllers\RRHHController::class, 'update']);
    Route::get('/rrhh/edit/password/{id}', [\App\Http\Controllers\RRHHController::class, 'edit_password']);
    Route::post('/rrhh/update/password/{id}', [\App\Http\Controllers\RRHHController::class, 'update_password']);
});

Route::middleware(['can:admin.gastosfijos'])->group(function () {
    Route::get('/gastosfijos/alquileres/{type}', [\App\Http\Controllers\GastosFijosController::class, 'gastosfijosindex']);
    Route::get('/gastosfijos/alquileres/newregistro/{type}', [\App\Http\Controllers\GastosFijosController::class, 'gastosfijosnewregistro']);
    Route::post('/gastosfijos/alquileres/create', [\App\Http\Controllers\GastosFijosController::class, 'gastosfijoscreate']);
    Route::post('/gastosfijos/alquileres/pago', [\App\Http\Controllers\GastosFijosController::class, 'gastosfijospago']);

    Route::get('/gastosfijos/proveedores', 'App\Http\Controllers\GastosFijosController@proveedoresindex');
    Route::get('/gastosfijos/proveedores/newrent', 'App\Http\Controllers\GastosFijosController@proveedoresindexnewrent')->name('proveedores.create');
    Route::post('/gastosfijos/proveedores/saverent', 'App\Http\Controllers\GastosFijosController@proveedoresindexsaverent')->name('proveedores.newcreate');
    Route::get('/gastosfijos/proveedores/editar/{id}', 'App\Http\Controllers\GastosFijosController@proveedoreseditar')->name('proveedores.edit');
    Route::put('/gastosfijos/proveedores/update', 'App\Http\Controllers\GastosFijosController@proveedoresupdate')->name('proveedores.update');
    Route::delete('/gastosfijos/proveedores/delete/{id}', 'App\Http\Controllers\GastosFijosController@proveedoresdestroy')->name('proveedores.delete');
});
