<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/admin')->group(function(){
    Route::post('/login', 'api\LoginController@admin');
    Route::post('/forgot-password', 'UserController@forgotPassword');
    Route::middleware('auth:api')->post('/register', 'api\RegisterController@admin');
    Route::middleware('auth:api')->get('/list', 'UserController@apiList');
    Route::middleware('auth:api')->get('/show/{id}', 'UserController@apiShow');
    Route::middleware('auth:api')->put('/update/{id}', 'UserController@apiUpdate');
    Route::middleware('auth:api')->patch('/update-email/{id}', 'UserController@apiUpdateEmail');
    Route::middleware('auth:api')->patch('/update-password/{id}', 'UserController@updatePassword');
    Route::middleware('auth:api')->delete('/delete/{id}', 'UserController@delete');
    Route::middleware('auth:api')->delete('/restore/{id}', 'UserController@restore');
    Route::middleware('auth:api')->post('/set-playerid', 'UserController@updatePlayerId');
});

Route::post('/login', 'api\LoginController@pacienteMedico');
Route::post('/send-code', 'UserController@sendCodeToEmail');
Route::post('/validate-code', 'UserController@validateCode');
Route::middleware('auth:api')->post('/change-password/{id}', 'UserController@changePassword');

//mecanicos
Route::prefix('/mecanico')->group(function(){
    Route::middleware('auth:api')->post('/create', 'MecanicoController@store');
    Route::middleware('auth:api')->get('/all', 'MecanicoController@index');
    Route::middleware('auth:api')->get('/show/{id}', 'MecanicoController@show');
    Route::middleware('auth:api')->put('/update/{id}', 'MecanicoController@update');
    Route::middleware('auth:api')->delete('/delete/{id}', 'MecanicoController@delete');
    Route::middleware('auth:api')->delete('/restore/{id}', 'MecanicoController@restore');
});

//ordenes
Route::prefix('/orden')->group(function(){
    Route::middleware('auth:api')->post('/create', 'OrdenController@store');
    Route::middleware('auth:api')->get('/all', 'OrdenController@index');
    Route::middleware('auth:api')->get('/show/{id}', 'OrdenController@show');
    // Route::middleware('auth:api')->put('/update/{id}', 'OrdenController@update');
    Route::middleware('auth:api')->delete('/delete/{id}', 'OrdenController@delete');
    Route::middleware('auth:api')->delete('/restore/{id}', 'OrdenController@restore');
});






// //pacientes y medicos
// Route::prefix('/paciente')->group(function(){
//     Route::post('/create', 'PacienteController@store');
//     Route::middleware('auth:api')->get('/list', 'PacienteController@list');
//     Route::middleware('auth:api')->get('/show/{id}', 'PacienteController@show');
//     Route::middleware('auth:api')->put('/update/{id}', 'PacienteController@update');
//     Route::middleware('auth:api')->patch('/update-password/{id}', 'UserController@updatePassword');
//     Route::middleware('auth:api')->delete('/delete/{id}', 'UserController@delete');
//     Route::middleware('auth:api')->delete('/restore/{id}', 'UserController@restore');
//     Route::middleware('auth:api')->get('/recetas', 'PacienteController@misRecetas');
//     Route::middleware('auth:api')->get('/recetas/{id}', 'PacienteController@misRecetas');
//     Route::middleware('auth:api')->get('/citas', 'PacienteController@misCitas');
//     Route::middleware('auth:api')->get('/citas/{id}', 'PacienteController@misCitas');
//     Route::middleware('auth:api')->get('/compras', 'PacienteController@misCompras');
//     Route::middleware('auth:api')->get('/compras/{id}', 'PacienteController@misCompras');
//     Route::middleware('auth:api')->get('/get/list', 'PacienteController@getPacientes');
//     Route::middleware('auth:api')->get('/medicos', 'PacienteController@medicos');
//     Route::middleware('auth:api')->get('/medicos/{id}', 'PacienteController@medicos');
// });

// Route::prefix('/medico')->group(function(){
//     Route::post('/create', 'MedicoController@store');
//     Route::middleware('auth:api')->get('/list', 'MedicoController@list');
//     Route::middleware('auth:api')->get('/show/{id}', 'MedicoController@show');
//     Route::middleware('auth:api')->put('/update/{id}', 'MedicoController@update');
//     Route::middleware('auth:api')->patch('/update-password/{id}', 'UserController@updatePassword');
//     Route::middleware('auth:api')->delete('/delete/{id}', 'UserController@delete');
//     Route::middleware('auth:api')->delete('/restore/{id}', 'UserController@restore');
//     Route::middleware('auth:api')->get('/pacientes', 'MedicoController@pacientes');
//     Route::middleware('auth:api')->get('/pacientes/{id}', 'MedicoController@pacientes');
//     Route::middleware('auth:api')->get('/recetas', 'MedicoController@misRecetas');
//     Route::middleware('auth:api')->get('/recetas/{id}', 'MedicoController@misRecetas');
//     Route::middleware('auth:api')->get('/citas', 'MedicoController@misCitas');
//     Route::middleware('auth:api')->get('/citas/{id}', 'MedicoController@misCitas');
//     Route::middleware('auth:api')->patch('/update-descripcion/{id}', 'MedicoController@modificarDescripcion');
// });

// Route::prefix('/medicamento')->group(function(){
//     Route::middleware('auth:api')->post('/register', 'MedicamentoController@store');
//     Route::middleware('auth:api')->get('/list', 'MedicamentoController@index');
//     Route::middleware('auth:api')->get('/show/{id}', 'MedicamentoController@show');
//     Route::middleware('auth:api')->put('/update/{id}', 'MedicamentoController@update');
//     Route::middleware('auth:api')->delete('/delete/{id}', 'MedicamentoController@delete');
//     Route::middleware('auth:api')->delete('/restore/{id}', 'MedicamentoController@restore');
// });


// Route::prefix('/receta')->group(function(){
//     Route::middleware('auth:api')->post('/create', 'RecetaController@store');
//     Route::middleware('auth:api')->get('/show/{id}', 'RecetaController@show');
//     Route::middleware('auth:api')->put('/update/{id}', 'RecetaController@update');
//     Route::middleware('auth:api')->delete('/delete/{id}', 'RecetaController@delete');
//     Route::middleware('auth:api')->delete('/restore/{id}', 'RecetaController@restore');
//     // Route::middleware('auth:api')->get('/paciente/{id}', 'RecetaController@recetasPaciente');
//     // Route::middleware('auth:api')->get('/medico/{id}', 'RecetaController@recetasMedico');
//     Route::middleware('auth:api')->patch('/parar-notificaciones/{id}', 'RecetaController@pararNotificaciones');
//     Route::middleware('auth:api')->patch('/activar-notificaciones/{id}', 'RecetaController@activarNotificaciones');
// });

// Route::prefix('/cita')->group(function(){
//     Route::middleware('auth:api')->post('/create', 'CitaController@store');
//     Route::middleware('auth:api')->get('/show/{id}', 'CitaController@show');
//     Route::middleware('auth:api')->put('/update/{id}', 'CitaController@update');
//     Route::middleware('auth:api')->delete('/delete/{id}', 'CitaController@delete');
//     Route::middleware('auth:api')->delete('/restore/{id}', 'CitaController@restore');
//     Route::middleware('auth:api')->post('/reservar', 'CitaController@recervarCita');
//     Route::middleware('auth:api')->patch('/aprobar/{id}', 'CitaController@aprobar');
//     // Route::middleware('auth:api')->patch('/hecho/{id}', 'CitaController@done');
// });

// Route::prefix('/compra')->group(function(){
//     Route::middleware('auth:api')->post('/create', 'CompraController@store');
//     Route::middleware('auth:api')->get('/list', 'CompraController@index');
//     Route::middleware('auth:api')->get('/show/{id}', 'CompraController@show');
//     Route::middleware('auth:api')->put('/update/{id}', 'CompraController@update');
//     Route::middleware('auth:api')->delete('/delete/{id}', 'CompraController@delete');
//     Route::middleware('auth:api')->delete('/restore/{id}', 'CompraController@restore');
//     Route::middleware('auth:api')->patch('/entregado/{id}', 'CompraController@entregado');
//     Route::middleware('auth:api')->patch('/atendido/{id}', 'CompraController@atendido');
//     Route::middleware('auth:api')->patch('/entregado-revert/{id}', 'CompraController@entregadoRevert');
//     Route::middleware('auth:api')->patch('/atendido-revert/{id}', 'CompraController@atendidoRevert');
// });


