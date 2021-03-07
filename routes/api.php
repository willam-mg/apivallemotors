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
    Route::middleware('auth:api')->get('/todos', 'MecanicoController@todos');
});

//ordenes
Route::prefix('/orden')->group(function(){
    Route::middleware('auth:api')->post('/create', 'OrdenController@store');
    Route::middleware('auth:api')->get('/all', 'OrdenController@index');
    Route::middleware('auth:api')->get('/show/{id}', 'OrdenController@show');
    Route::middleware('auth:api')->put('/update/{id}', 'OrdenController@update');
    Route::middleware('auth:api')->delete('/delete/{id}', 'OrdenController@delete');
    Route::middleware('auth:api')->delete('/restore/{id}', 'OrdenController@restore');
    Route::middleware('auth:api')->post('/detalle/create', 'OrdenController@createDetalleRepuesto');
    // mano de obra
    Route::middleware('auth:api')->post('/detalle/manoobra', 'OrdenController@createDetalleManoObra');
    Route::middleware('auth:api')->put('/detalle/editmanoobra/{id}', 'OrdenController@editDetalleManoObra');
    Route::middleware('auth:api')->delete('/detalle/deletemanoobra/{id}', 'OrdenController@deleteDetalleManoObra');
    Route::middleware('auth:api')->delete('/detalle/restoremanoobra/{id}', 'OrdenController@restoreDetalleManoObra');
    // repuestos
    Route::middleware('auth:api')->post('/detalle/add-repuesto', 'OrdenController@createDetalleRepuesto');
    Route::middleware('auth:api')->put('/detalle/edit-repuesto/{id}', 'OrdenController@editDetalleRepuesto');
    Route::middleware('auth:api')->delete('/detalle/delete-repuesto/{id}', 'OrdenController@deleteDetalleRepuesto');
    Route::middleware('auth:api')->delete('/detalle/restore-repuesto/{id}', 'OrdenController@restoreDetalleRepuesto');
    // ordenes similares del vehiculo
    Route::middleware('auth:api')->get('/similares/{id}', 'OrdenController@ordenesSimilares');
});

//ordenes
Route::prefix('/accesorio')->group(function(){
    Route::middleware('auth:api')->post('/create', 'AccesorioController@store');
    Route::middleware('auth:api')->get('/all', 'AccesorioController@index');
    Route::middleware('auth:api')->get('/todos', 'AccesorioController@todos');
    Route::middleware('auth:api')->get('/show/{id}', 'AccesorioController@show');
    Route::middleware('auth:api')->put('/update/{id}', 'AccesorioController@update');
    Route::middleware('auth:api')->delete('/delete/{id}', 'AccesorioController@delete');
    Route::middleware('auth:api')->delete('/restore/{id}', 'AccesorioController@restore');
});

//ordenes
Route::prefix('/accesorio')->group(function(){
    Route::middleware('auth:api')->post('/create', 'AccesorioController@store');
    Route::middleware('auth:api')->get('/all', 'AccesorioController@index');
    Route::middleware('auth:api')->get('/show/{id}', 'AccesorioController@show');
    Route::middleware('auth:api')->put('/update/{id}', 'AccesorioController@update');
    Route::middleware('auth:api')->delete('/delete/{id}', 'AccesorioController@delete');
    Route::middleware('auth:api')->delete('/restore/{id}', 'AccesorioController@restore');
});