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


Route::get('/', function () {return redirect('/home');});
Route::get('/php', function () {return view('welcome');});
Route::get('/register', function () {return view('auth.register');});
Route::post('/register', [\App\Http\Controllers\RegisterController::class,'register']);

Route::get('/login', [\App\Http\Controllers\LoginController::class,'show']);
Route::post('/login', [\App\Http\Controllers\LoginController::class,'login']);


Route::group(['middleware' => 'admin'], function () {
    //Gneral
    Route::get('/home/general',[\App\Http\Controllers\HomeController::class,'general']);
    Route::post('/home/general/config',[\App\Http\Controllers\HomeController::class,'general']);
    Route::get('/home/general/config', function () {
        return redirect()->route('/home/general');
    });

    //Home
    Route::get('/home', [\App\Http\Controllers\UsuariosCCIPController::class,'index']);

    //LoginController
    Route::post('/logout', [\App\Http\Controllers\LoginController::class,'logout']);

    //UsuariosCCIPController
    Route::get('/home/nuevoUsuario', function (){return view('CCIP.newUser');});
    Route::post('/home/createuser', [\App\Http\Controllers\UsuariosCCIPController::class,'create']);
    Route::get('/home/liquidarUsuario/{id}', [\App\Http\Controllers\UsuariosCCIPController::class,'liquidar']);
    Route::get('/home/mostrarUsuario/{id}', [\App\Http\Controllers\UsuariosCCIPController::class,'modify']);
    Route::post('/home/update/{id}', [\App\Http\Controllers\UsuariosCCIPController::class,'update']);
    Route::get('/home/edit/password/{id}',[\App\Http\Controllers\UsuariosCCIPController::class,'edit_password'] );
    Route::post('/home/update/password/{id}',[\App\Http\Controllers\UsuariosCCIPController::class,'update_password'] );

    //Reportes
    Route::post('home/generate',[\App\Http\Controllers\HomeController::class,'generate']);
    Route::get('/home/reportes',[\App\Http\Controllers\HomeController::class,'generar']);
    Route::get('/home/export/general', [\App\Http\Controllers\HomeController::class, 'general']);
    Route::get('/home/export/combustibles', [\App\Http\Controllers\HomeController::class, 'combustible']);

    //Recargas
    Route::post('/home/recargar/users', [\App\Http\Controllers\UsuariosCCIPController::class, 'recargar']);

    //InformesPdf
    Route::get('/home/informes',[\App\Http\Controllers\HomeController::class,'generarpdf']);
    Route::post('/home/informes/generatepdf',[\App\Http\Controllers\HomeController::class,'generatepdf']);

    Route::post('/home/notification',[\App\Http\Controllers\HomeController::class,'notification']);
    Route::post('/home/registertask',[\App\Http\Controllers\HomeController::class,'registertask']);

    Route::get('/home/tareas',[\App\Http\Controllers\HomeController::class,'listtareas']);
    Route::post('/home/tareas/user',[\App\Http\Controllers\HomeController::class,'listtareas']);
});
