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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'App\Http\Controllers\LoginController@index');
Route::post('login', 'App\Http\Controllers\LoginController@login');
Route::get('/logout', 'App\Http\Controllers\LoginController@logout')->name('logout');
Route::get('/access_denied', 'App\Http\Controllers\UsersController@errorpage');
Route::get('/home', 'App\Http\Controllers\PageController@home')->name('home');
Route::get('/orderupload', 'App\Http\Controllers\PageController@orderupload')->name('orderupload');
Route::get('/orders', 'App\Http\Controllers\PageController@orders')->name('orders');
Route::get('/users', 'App\Http\Controllers\PageController@users')->name('users');
Route::get('/customers', 'App\Http\Controllers\PageController@customers')->name('customers');
Route::get('/suppliers', 'App\Http\Controllers\PageController@suppliers')->name('suppliers');
Route::get('/dashboard', 'App\Http\Controllers\PageController@dashboard')->name('dashboard');
Route::post('/adduser', 'App\Http\Controllers\UsersController@adduser');