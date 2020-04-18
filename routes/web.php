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

Route::get('/', 'MainController@show')->name('home');
Route::get('/menu', 'MainController@show')->name('menu');

Route::get('/login', 'LoginController@show')->name('login')->middleware('guest');
Route::get('/register', 'RegistrationController@show')->name('register')->middleware('guest');

Route::post('/login', 'LoginController@authenticate');
Route::post('/register', 'RegistrationController@register');

Route::get('/order', 'OrderController@getorder')->name('order');
Route::post('/order', 'OrderController@createorder');

Route::middleware('auth')->group(function () {
    Route::post('/logout', 'LoginController@logout')->name('logout');
});