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

Route::get('/ViewUsers','App\Http\Controllers\UserController@ReadJoin')->name('ViewUsers');
    
    Route::post('/Create','App\Http\Controllers\UserController@Create');

    Route::get('/FormUsers', function () {
        return view('auth.register');
    });
    
    Route::get('/ReadUpdate/{id}','App\Http\Controllers\UserController@ReadUpdate')->name('route.ReadUpdate');
    
    Route::put('/Update/{id}','App\Http\Controllers\UserController@Update')->name('route.Update');
    
    Route::delete('DeleteUsers/{id}','App\Http\Controllers\UserController@destroy')->name('DeleteUsers.destroy');

/*     Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm']);
    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']); */

    Route::get('/register', 'App\Http\Controllers\AdminRegistrationController@showRegistrationForm');
    Route::post('/register', 'App\Http\Controllers\AdminRegistrationController@store')->name('register')->middleware('auth');;