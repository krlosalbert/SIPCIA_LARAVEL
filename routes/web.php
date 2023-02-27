<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//ruta para el login
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
//ruta para la pagina inicial
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//ruta para ver los usuarios registrados
Route::get('/ViewUsers','App\Http\Controllers\UserController@ReadJoin')->name('ViewUsers');
//ruta para el formulario de registro de usuarios
Route::get('/FormUsers','App\Http\Controllers\UserController@FromUsers');
//ruta para registrar usuarios
Route::get('/register', 'App\Http\Controllers\AdminRegistrationController@showRegistrationForm');
Route::post('/register', 'App\Http\Controllers\AdminRegistrationController@store')->name('register')->middleware('auth');
//ruta para el formulario de edicion de usuarios
Route::get('/ReadUpdate/{id}','App\Http\Controllers\UserController@ReadUpdate')->name('ReadUpdate');
//ruta para editar a los usuarios
Route::put('/Update/{id}','App\Http\Controllers\UserController@Update')->name('Update');
//ruta para eliminar usuarios
Route::delete('DeleteUsers/{id}','App\Http\Controllers\UserController@destroy')->name('DeleteUsers.destroy');
//ruta para ver los usuarios registrados
Route::get('/ViewRoles','App\Http\Controllers\RoleController@View')->name('ViewRoles');
//ruta para eliminar roles
Route::delete('DeleteRole/{id}','App\Http\Controllers\RoleController@destroy')->name('DeleteRole.destroy');