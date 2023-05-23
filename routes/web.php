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
    return view('surepaysms');
});





Route::get('/user/login', function () { return view('user.login', ['error'=> false]); });
Route::post('/user/verifyUser', 'vendorController@verifyUser')->name('verifyUser');
Route::get('/user/signout', 'vendorController@signout');
Route::middleware(['call-function-for-users'])->group(function () {
    Route::get('/user/home', function () { return view('user.home'); });
    Route::get('/user/outbox', 'vendorController@loadOutBox')->name("user.outbox");
    Route::get('/user/customsms', function (){ return view("/user/customsms"); });
    Route::get('/user/singlesms', function (){ return view("/user/singlesms"); });
    Route::get('/user/bulksms', function (){ return view("/user/bulksms"); });
    Route::post('/user/creditTopup', 'vendorController@autoCreditTopup');
    Route::get('/user/topup', function (){ return view("/user/topup"); });
});






Route::get('/admin/login', function () { return view('/admin/login', ['error'=> false]); });
Route::post('/admin/verifyAdmin', 'adminController@verifyAdmin');
Route::get('/admin/home', 'adminController@home');
Route::get('/admin/signout', 'adminController@signout');



Route::get('/admin/maker/home', function () { return view('admin/maker/home'); });
Route::post('/admin/maker/initiateVendorTopUp', 'adminController@initiateVendorTopUp');
Route::post('/admin/maker/vendorEdit', 'adminController@vendorEdit');
Route::get('/admin/vendors', 'adminController@getVendors');
Route::get('/admin/transactions', 'adminController@getTransactions');
Route::get('/admin/pendingTransactions', 'adminController@getPendingTransactions');
Route::get('/admin/successfullTransactions', 'adminController@getSuccessfullTransactions');
Route::get('/admin/rejectedTransactions', 'adminController@getRejectedTransactions');
Route::post('/admin/approveTransaction', 'adminController@approveTransaction');
Route::post('/admin/rejectTransaction', 'adminController@rejectTransaction');

Route::get('/admin/checker/home', function () { return view('admin/checker/home'); });
Route::post('/admin/vendor/checkerCreditTopup', 'adminController@vendorCreditTopup');
Route::post('/admin/vendorEdit', 'adminController@vendorEdit');






Route::post('/vendor/verifyVendor', 'vendorController@verifyVendor')->name('verifyVendor');
Route::post('/vendor/newVendor', 'VendorController@newVendor')->name('newVendor');
Route::get('/vendor/register', function () {return view('vendor.register');});
Route::get('/vendor/login', function () {return view('vendor.login', ['error'=> false]);});
Route::get('/vendor/signout', 'vendorController@vendorSignout');
Route::middleware(['call-function-for-vendors'])->group(function () {
    Route::get('/vendor/home', function () {return view('vendor.home');});
    Route::post('/vendor/saveuser', 'vendorController@saveUser');
    Route::get('/vendor/adduser', function () {return view('vendor.adduser');});
    Route::get('/vendor/transactions', 'vendorController@getTransactions');
    Route::get('/vendor/users', 'vendorController@getUsers');
    Route::post('/vendor/manageUser', 'vendorController@manageUser');
    Route::post('/vendor/messageCountByDay', 'vendorController@messageCountByDay');
    Route::get('/vendor/affiliates', 'vendorController@getAffiliates');
    Route::get('/vendor/registerAffiliate', function () {return view('vendor.registerAffiliate');});
    Route::post('/vendor/creditAffiliate', 'vendorController@creditAffiliate');
    Route::post('/vendor/createAffiliate', 'vendorController@createAffiliate')->name('createAffiliate');
});


Route::post('/populate', 'dashboardController@populate')->name('populate');
Route::post('/loadOutBox', 'dashboardController@loadOutBox')->name('loadOutBox');
Route::post('/sendMessage', 'messageController@sendMessage')->name('sendMessage');
Route::post('/sendBulkMessage', 'messageController@sendBulkMessage')->name('sendBulkMessage');
Route::post('/sendCustomMessage', 'messageController@sendCustomMessage')->name('sendCustomMessage');
Route::post('/generateCustomeMessages', 'fileController@generateCustomeMessages')->name('generateCustomeMessages');
Route::post('/uploadFromCsv', 'fileController@uploadFromCsv')->name('uploadFromCsv');
