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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/viewUsers','App\Http\Controllers\UserController@ReadJoin');
    
    Route::post('/Create','App\Http\Controllers\UserController@Create');

    Route::get('/FormUsers', function () {
        return view('Users.Form');
    });
    
    Route::get('/ReadUpdate/{id}','App\Http\Controllers\UserController@ReadUpdate')->name('route.ReadUpdate');
    
    Route::put('/Update/{id}','App\Http\Controllers\UserController@Update')->name('route.Update');
    
    Route::delete('DeleteUsers/{id}','App\Http\Controllers\UserController@destroy')->name('DeleteUsers.destroy');