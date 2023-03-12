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

//USUARIOS
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

//ROLES
//ruta para ver los roles registrados
Route::get('/ViewRoles','App\Http\Controllers\RoleController@View')->name('ViewRoles');
//ruta para ver el formulario de creacion de un nuevo rol
Route::get('/NewRoles','App\Http\Controllers\RoleController@formRole')->name('NewRoles');
//ruta para crear un nuevo rol
Route::post('/CreateRoles','App\Http\Controllers\RoleController@Create')->name('CreateRoles');
//ruta para el formulario de edicion de roles
Route::get('/ReadUpdateRole/{id}','App\Http\Controllers\RoleController@ReadUpdate')->name('ReadUpdateRole');
//ruta para editar a los Roles
Route::put('/UpdateRoles/{id}','App\Http\Controllers\RoleController@Update')->name('UpdateRoles');
//ruta para eliminar roles
Route::delete('DeleteRole/{id}','App\Http\Controllers\RoleController@destroy')->name('DeleteRole.destroy'); 

//PRODUCTS
//ruta para ver los productos registrados
Route::get('/ViewProducts','App\Http\Controllers\ProductsController@View')->name('ViewProducts');
//ruta para ver el formulario de creacion de un nuevo producto
Route::get('/NewProducts','App\Http\Controllers\ProductsController@Form')->name('NewProducts');
//ruta para crear un nuevo producto
Route::post('/CreateProducts','App\Http\Controllers\ProductsController@Create')->name('CreateProducts');
//ruta para el formulario de edicion de productos
Route::get('/ReadUpdateProducts/{id}','App\Http\Controllers\ProductsController@ReadUpdate')->name('ReadUpdateProducts');
//ruta para editar a los productos
Route::put('/UpdateProducts/{id}','App\Http\Controllers\ProductsController@Update')->name('UpdateProducts');
//ruta para eliminar productos
Route::delete('DeleteProducts/{id}','App\Http\Controllers\ProductsController@destroy')->name('DeleteProducts');

//SUPPLIERS
//ruta para ver los suppliers registrados
Route::get('/ViewSuppliers','App\Http\Controllers\SuppliersController@View')->name('ViewSuppliers');
//ruta para ver el formulario de creacion de un nuevo supplier
Route::get('/NewSuppliers','App\Http\Controllers\SuppliersController@Form')->name('NewSuppliers');
//ruta para crear un nuevo supplier
Route::post('/CreateSuppliers','App\Http\Controllers\SuppliersController@Create')->name('CreateSuppliers');
//ruta para el formulario de edicion de supplier
Route::get('/ReadUpdateSuppliers/{id}','App\Http\Controllers\SuppliersController@ReadUpdate')->name('ReadUpdateSuppliers');
//ruta para editar a los supplier
Route::put('/UpdateSuppliers/{id}','App\Http\Controllers\SuppliersController@Update')->name('UpdateSuppliers');
//ruta para eliminar supplier
Route::delete('DeleteSuppliers/{id}','App\Http\Controllers\SuppliersController@destroy')->name('DeleteSuppliers');