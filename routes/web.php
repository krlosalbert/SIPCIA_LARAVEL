<?php

use Illuminate\Support\Facades\Route;

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

//Entries
//ruta para ver las entradas registradas
Route::get('/ViewEntries','App\Http\Controllers\EntriesController@View')->name('ViewEntries');
//ruta para ver el detalle de la entrada
Route::post('/details_entries','App\Http\Controllers\EntriesController@View_products')->name('details_entries');

//inicio rutas para registrar una nueva entrada
    //ruta para visualizar el formulario y las tablas para el registro de la nueva entrada
    Route::get('/NewEntries','App\Http\Controllers\EntriesController@New')->name('NewEntries');
    //ruta para visualizar los productos para seleccionar productos para el registro
    Route::get('/SearchProducts','App\Http\Controllers\EntriesController@Search')->name('SearchProducts');
    //ruta para añadir los productos a guardar
    Route::post('/AddProductMoment','App\Http\Controllers\EntriesController@add_to_session')->name('AddProductMoment');
    //ruta para hacer una eliminacion previa en caso de error antes de guardar
    Route::post('/deleteProduct','App\Http\Controllers\EntriesController@deleteProduct')->name('deleteProduct');
    //ruta para hacer el registro en la db
    Route::post('/CreateEntries','App\Http\Controllers\EntriesController@Create')->name('create_entries');
//fin de las rutas de registro de nueva entrada

//ruta para el formulario de edicion de entradas
Route::get('/ReadUpdateEntries/{id}','App\Http\Controllers\EntriesController@ReadUpdate')->name('ReadUpdateEntries');
//ruta para editar a las entradas
Route::put('/update_entries/{id}','App\Http\Controllers\SuppliersController@Update')->name('update_entries');

//ruta para eliminar entradas
Route::delete('DeleteEntries/{id}','App\Http\Controllers\EntriesController@destroy')->name('DeleteEntries');

