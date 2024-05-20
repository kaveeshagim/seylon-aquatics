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

Route::get('/welcome', function () {
    return view('welcome');
});

// Grouping routes under the 'App\Http\Controllers' namespace
Route::namespace('App\Http\Controllers')->group(function () {

    // Login routes
    Route::get('/', 'LoginController@index');
    Route::post('login', 'LoginController@login');
    Route::get('/logout', 'LoginController@logout')->name('logout');
    Route::get('/access_denied', 'UsersController@errorpage');
    Route::get('/home', 'PageController@home')->name('home');

    // Users routes
    Route::get('/users', 'PageController@users')->name('users');
    Route::get('/adduserpage', 'PageController@adduserpage')->name('adduserpage');
    Route::post('/adduser', 'UsersController@adduser');
    Route::get('/getusers', 'UsersController@getusers')->name('getusers');
    Route::get('/deleteuser', 'UsersController@deleteuser')->name('deleteuser');
    Route::get('/userprofile/{username}', 'PageController@show')->name('userprofile.show');
    Route::get('/userprofile', 'PageController@showprofile')->name('userprofile.showprofile');
    Route::get('/userdetails', 'UsersController@userdetails')->name('userdetails');
    Route::get('/edituserpage/{id}', 'PageController@edituserpage')->name('edituserpage');
    Route::post('/edituser', 'UsersController@edituser');

    // User type routes
    Route::get('/usertype', 'PageController@usertype')->name('usertype');
    Route::get('/addusertypepage', 'PageController@addusertypepage')->name('addusertypepage');
    Route::post('/addusertype', 'UserTypeController@addusertype');
    Route::get('/getusertypes', 'UserTypeController@getusertypes')->name('getusertypes');
    Route::get('/deleteusertype', 'UserTypeController@deleteusertype')->name('deleteusertype');
    Route::get('/editusertypepage/{id}', 'PageController@editusertypepage')->name('editusertypepage');
    Route::post('/editusertype', 'UserTypeController@editusertype')->name('editusertype');

    // Customers routes
    Route::get('/customers', 'PageController@customers')->name('customers');
    Route::get('/subcustomers', 'PageController@subcustomers')->name('subcustomers');
    Route::get('/addcustomerspage', 'PageController@addcustomerspage')->name('addcustomerspage');
    Route::get('/addsubcustomerspage', 'PageController@addsubcustomerspage')->name('addsubcustomerspage');
    Route::post('/addcustomers', 'CustomersController@addcustomers');
    Route::post('/addsubcustomers', 'CustomersController@addsubcustomers');
    Route::get('/getcustomers', 'CustomersController@getcustomers')->name('getcustomers');
    Route::get('/getsubcustomers', 'CustomersController@getcustomers')->name('getsubcustomers');

    // Suppliers routes
    Route::get('/suppliers', 'PageController@suppliers')->name('suppliers');
    Route::get('/addsupplierspage', 'PageController@addsupplierspage')->name('addsupplierspage');
    Route::post('/addsuppliers', 'SuppliersController@addsuppliers');
    Route::get('/getsuppliers', 'SuppliersController@getsuppliers')->name('getsuppliers');

    // Dashboard routes
    Route::get('/dashboard', 'PageController@dashboard')->name('dashboard');

    // Orders routes
    Route::get('/orderupload', 'PageController@orderupload')->name('orderupload');
    Route::get('/orders', 'PageController@orders')->name('orders');
    Route::get('/addorderpage', 'PageController@addorderpage')->name('addorderpage');

    // Password manager routes
    Route::get('/passwordmanager', 'PageController@passwordmanager')->name('passwordmanager');
    Route::get('/resetpasswordpage/{id}', 'PageController@resetpasswordpage')->name('resetpasswordpage');
    Route::get('/getpasswordreq', 'PasswordController@getpasswordreq')->name('getpasswordreq');
    Route::post('/addpasswordresetreq', 'PasswordController@addpasswordresetreq')->name('addpasswordresetreq');
    Route::post('/editnewpassword', 'PasswordController@editnewpassword')->name('editnewpassword');

    // Excel upload
    Route::post('/upload-excel', 'ExcelImportController@upload')->name('upload.excel');

});
