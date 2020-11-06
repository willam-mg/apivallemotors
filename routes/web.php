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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function(){
    Route::get('/usuarios', 'UserController@index')->name('usuarios');
    Route::get('/profile/{id?}', 'UserController@profile')->name('profile');
    
    Route::post('/update-perfil/{id?}', 'UserController@updateProfile')->name('update');
    Route::get('/modificar-perfil/{id?}', 'UserController@editProfile')->name('modificar');
});
