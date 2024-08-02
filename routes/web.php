<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BroadcastController;


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
Route::get('/sidebar', function () {
    return view('sidebarog');
});
Route::get('/ordersoverview', function () {
    return view('ordersoverview');
});
Route::get('/orderconfirmation', function () {
    return view('orderconfirmation');
});
Route::get('/invoicesummary', function () {
    return view('invoice');
});
Route::get('/orderconfirmation', function () {
    return view('orderconfirmation');
});
Route::get('/orderconfirmation', function () {
    return view('orderconfirmation');
});
Route::get('/expired', function () {
    return view('404pageexpired');
})->name('expired');
Route::get('/', function () {
    return redirect('/loginuser');
});
Route::get('/livedashboard', function () {
    return view('/livedashboard');
});
Route::get('/customerorderreport', function () {
    return view('/customerorderreport');
});
Route::get('/salesreport', function () {
    return view('/salesreport');
});
Route::get('/shipmentreport', function () {
    return view('/shipmentreport');
});
Route::get('/broadcast', [BroadcastController::class, 'broadcastMessage']);
Route::namespace('App\Livewire')->group(function () {
    Route::get('/livewiredashboard', Dashboard::class)->name('dashboard');
});
Route::get('/download-pdf', [App\Http\Controllers\PDFController::class, 'downloadPDF']);


// Grouping routes under the 'App\Http\Controllers' namespace
Route::namespace('App\Http\Controllers')->group(function () {

    Route::get('/update-status', 'OrderController@updateStatus');

        // Login routes
    Route::get('/orderscount', 'OrderController@count');

    Route::get('/loginuser', 'LoginController@index');
    Route::post('login', 'LoginController@login');

        Route::post('/logout', 'LoginController@logout')->name('logout');
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
        Route::get('/getusertype/{id}', 'UserTypeController@getusertype')->name('getusertype');
        Route::get('/getuserslist/{id}', 'UserTypeController@getuserslist')->name('getuserslist');
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
        Route::get('/editcustomer/{id}', 'PageController@editcustomer')->name('editcustomer');
        Route::post('/editcustomer', 'CustomersController@editcustomer');
        Route::get('/deletecustomer', 'CustomersController@deletecustomer')->name('deletecustomer');

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
        Route::post('/addorderexcel', 'OrderController@addorderexcel')->name('addorderexcel');
        Route::post('/addorderform', 'OrderController@addorderform')->name('addorderform');
        Route::get('/getorders', 'OrderController@getorders')->name('getorders');
        Route::get('/orderhistory', 'PageController@orderhistory')->name('orderhistory');
        Route::get('/customerorders', 'PageController@customerorders')->name('customerorders');
        Route::get('/getorderhistory', 'OrderController@getorderhistory')->name('getorderhistory');
        
        // Invoice routes
        Route::get('/invoices', 'PageController@invoices')->name('invoices');
        Route::get('/getinvoices', 'InvoiceController@getinvoices')->name('getinvoices');


        // Password manager routes
        Route::get('/passwordmanager', 'PageController@passwordmanager')->name('passwordmanager');
        Route::get('/resetpasswordpage/{id}', 'PageController@resetpasswordpage')->name('resetpasswordpage');
        Route::get('/getpasswordreq', 'PasswordController@getpasswordreq')->name('getpasswordreq');
        Route::post('/addpasswordresetreq', 'PasswordController@addpasswordresetreq')->name('addpasswordresetreq');
        Route::post('/approvepasswordrequest', 'PasswordController@approvepasswordrequest')->name('approvepasswordrequest');
        Route::get('/rejectpasswordrequest', 'PasswordController@rejectpasswordrequest')->name('rejectpasswordrequest');

        // Fish routes
        Route::get('/genfishcode', 'FishController@genfishcode')->name('genfishcode');
        Route::post('/fishweeklyupload', 'FishController@fishweeklyupload')->name('fishweeklyupload');


        //fish stock
        Route::get('/fish_stock', 'PageController@fish_stock')->name('fish_stock');
        Route::get('/addfishpage', 'PageController@addfishpage')->name('addfishpage');
        Route::get('/addfish', 'FishController@addfish');
        Route::get('/getfish', 'FishController@getfish')->name('getfish');
        Route::get('/editfishpage', 'PageController@editfishpage')->name('editfishpage');
        Route::post('/editfish', 'FishController@editfish')->name('editfish');
        Route::get('/deletefish', 'FishController@deletefish')->name('deletefish');

        //fish habitat
        Route::get('/fish_habitat', 'PageController@fish_habitat')->name('fish_habitat');
        Route::get('/addfishhabitatpage', 'PageController@addfishhabitatpage')->name('addfishhabitatpage');
        Route::post('/addfishhabitat', 'FishController@addfishhabitat');
        Route::get('/getfishhabitat', 'FishController@getfishhabitat')->name('getfishhabitat');
        Route::get('/gethabitat/{id}', 'FishController@gethabitat')->name('gethabitat');
        Route::get('/editfishhabitatpage', 'PageController@editfishhabitatpage')->name('editfishhabitatpage');
        Route::post('/editfishhabitat', 'FishController@editfishhabitat')->name('editfishhabitat');
        Route::get('/deletefishhabitat', 'FishController@deletefishhabitat')->name('deletefishhabitat');

        //fish variety
        Route::get('/fish_variety', 'PageController@fish_variety')->name('fish_variety');
        Route::get('/addfishvarietypage', 'PageController@addfishvarietypage')->name('addfishvarietypage');
        Route::post('/addfishvariety', 'FishController@addfishvariety');
        Route::get('/getfishvariety', 'FishController@getfishvariety')->name('getfishvariety');
        Route::get('/getvariety/{id}', 'FishController@getvariety')->name('getvariety');
        Route::get('/editfishvarietypage', 'PageController@editfishvarietypage')->name('editfishvarietypage');
        Route::post('/editfishvariety', 'FishController@editfishvariety')->name('editfishvariety');
        Route::get('/deletefishvariety', 'FishController@deletefishvariety')->name('deletefishvariety');

        Route::get('/fish_weekly', 'PageController@fish_weekly')->name('fish_weekly');
        
        // fish size
        Route::get('/fish_size', 'PageController@fish_size')->name('fish_size');
        Route::get('/getfishsize', 'FishController@getfishsize')->name('getfishsize');
        Route::get('/getsize/{id}', 'FishController@getsize')->name('getsize');
        Route::post('/addfishsize', 'FishController@addfishsize');
        Route::post('/editfishsize', 'FishController@editfishsize')->name('editfishsize');
        Route::get('/deletefishsize', 'FishController@deletefishsize')->name('deletefishsize');

        // fish family
        Route::get('/fish_family', 'PageController@fish_family')->name('fish_family');
        Route::get('/getfishfamilies', 'FishController@getfishfamilies')->name('getfishfamilies');
        Route::get('/getfamily/{id}', 'FishController@getfamily')->name('getsize');
        Route::post('/addfishfamily', 'FishController@addfishfamily');
        Route::post('/editfishfamily', 'FishController@editfishfamily')->name('editfishfamily');
        Route::get('/deletefishfamily', 'FishController@deletefishfamily')->name('deletefishfamily');

        // fish species
        Route::get('/fish_species', 'PageController@fish_species')->name('fish_species');
        Route::get('/getfishspecies', 'FishController@getfishspecies')->name('getfishspecies');
        Route::get('/getspecies/{id}', 'FishController@getspecies')->name('getspecies');
        Route::post('/addfishspecies', 'FishController@addfishspecies');
        Route::post('/editfishspecies', 'FishController@editfishspecies')->name('editfishspecies');
        Route::get('/deletefishspecies', 'FishController@deletefishspecies')->name('deletefishspecies');

        // fish weekly
        Route::get('/fish_weekly', 'PageController@fish_weekly')->name('fish_weekly');
        Route::get('/getfishweekly', 'FishController@getfishweekly')->name('getfishweekly');
        Route::get('/getweekly/{id}', 'FishController@getweekly')->name('getweekly');
        Route::get('/addfishweeklypage', 'PageController@addfishweeklypage')->name('addfishweeklypage');
        Route::post('/addfishweekly', 'FishController@addfishweekly')->name('addfishweekly');
        Route::post('/editfishweekly', 'FishController@editfishweekly')->name('editfishweekly');
        Route::get('/deletefishweekly', 'FishController@deletefishweekly')->name('deletefishweekly');

        // Privilege routes
        Route::get('/categorysection', 'PageController@categorysection')->name('categorysection');
        Route::get('/subcategorysection', 'PageController@subcategorysection')->name('subcategorysection');
        Route::get('/privilegesection', 'PageController@privilegesection')->name('privilegesection');
        Route::get('/userprivilegesection', 'PageController@userprivilegesection')->name('userprivilegesection');

        Route::post('/addcategory', 'PrivilegeController@addcategory');
        Route::post('/addsubcategory', 'PrivilegeController@addsubcategory');
        Route::post('/addprivilegesection', 'PrivilegeController@addprivilegesection');
        Route::get('/get_sub_categories', 'PrivilegeController@get_sub_categories');
        Route::get('/get_categories', 'PrivilegeController@get_categories');
        Route::get('/get_prev_section', 'PrivilegeController@get_prev_section');
        Route::get('/save_user_prev', 'PrivilegeController@save_user_prev');

        
        //notification routes
        Route::get('/notifications', 'PageController@notifications')->name('notifications');


        // Excel upload
        Route::post('/upload-excel', 'ExcelImportController@upload')->name('upload.excel');


});
