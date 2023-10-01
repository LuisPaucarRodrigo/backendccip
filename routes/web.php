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
    //UsuariosCCIPController
    Route::get('/home/nuevoUsuario', function () {
        return view('CCIP.newUser');
    });
    Route::post('/home/createuser', [\App\Http\Controllers\UsuariosCCIPController::class, 'create']);
    Route::get('/home/liquidarUsuario', [\App\Http\Controllers\UsuariosCCIPController::class, 'liquidar']);
    Route::get('/home/mostrarUsuario/{id}', [\App\Http\Controllers\UsuariosCCIPController::class, 'modify']);
    Route::get('/home/delete/{id}', [\App\Http\Controllers\UsuariosCCIPController::class, 'delete']);
    Route::post('/home/update/{id}', [\App\Http\Controllers\UsuariosCCIPController::class, 'update']);
    Route::get('/home/edit/password/{id}', [\App\Http\Controllers\UsuariosCCIPController::class, 'edit_password']);
    Route::post('/home/update/password/{id}', [\App\Http\Controllers\UsuariosCCIPController::class, 'update_password']);
    //Recargas
    Route::post('/home/recargar/users', [\App\Http\Controllers\UsuariosCCIPController::class, 'recargar']);
    //Notificaciones
    Route::post('/home/notification', [\App\Http\Controllers\HomeController::class, 'notification']);
});

Route::middleware(['can:admin.reportes'])->group(function () {
    //Reportes
    Route::get('/home/reportes', [\App\Http\Controllers\ReportesController::class, 'generar']);
    Route::post('home/generate', [\App\Http\Controllers\ReportesController::class, 'generate']);
    Route::post('/home/reportes', [\App\Http\Controllers\ReportesController::class, 'generate']);
});

Route::middleware(['can:admin.operaciones'])->group(function () {
    //Planta Interna
    Route::get('/home/plantainterna', [\App\Http\Controllers\PLantaInternaController::class, 'controlgastos']);
    Route::post('/home/plantainterna', [\App\Http\Controllers\PLantaInternaController::class, 'controlgastos']);
});

Route::middleware(['can:admin.rrhh'])->group(function () {   
    Route::get('/rrhh/personal', [\App\Http\Controllers\RRHHController::class, 'personalindex']);
    Route::post('/rrhh/personal/newregister', [\App\Http\Controllers\RRHHController::class, 'personalindexnewregister']);
    Route::get('/rrhh/planilla', [\App\Http\Controllers\RRHHController::class, 'planillaindex']);
});

Route::middleware(['can:admin.gastosfijos'])->group(function () {
    Route::get('/gastosfijos/camioneta', [\App\Http\Controllers\GastosFijosController::class, 'camionetaindex']);
    Route::get('/gastosfijos/camioneta/newrent', [\App\Http\Controllers\GastosFijosController::class, 'camionetaindexnewrent']);
    Route::post('/gastosfijos/camioneta/saverent', [\App\Http\Controllers\GastosFijosController::class, 'camionetaindexsaverent']);
    Route::get('/gastosfijos/habitaciones', [\App\Http\Controllers\GastosFijosController::class, 'habitacionesindex']);
    Route::get('/gastosfijos/habitaciones/newrent', [\App\Http\Controllers\GastosFijosController::class, 'habitacionesindexnewrent']);
    Route::post('/gastosfijos/habitaciones/saverent', [\App\Http\Controllers\GastosFijosController::class, 'habitacionesindexsaverent']);
    Route::get('/gastosfijos/terceros', [\App\Http\Controllers\GastosFijosController::class, 'tercerosindex']);
    Route::get('/gastosfijos/terceros/newrent', [\App\Http\Controllers\GastosFijosController::class, 'tercerosindexnewrent']);
    Route::post('/gastosfijos/terceros/saverent', [\App\Http\Controllers\GastosFijosController::class, 'tercerosindexsaverent']);
});
