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
    return view('user.login', ['error'=> false]);
});

Route::get('/vendor/register', function () {
    return view('vendor.register');
});
Route::get('/vendor/login', function () {
    return view('vendor.login', ['error'=> false]);
});




Route::get('/user/login', function () { return view('user.login', ['error'=> false]); });
Route::post('/user/verifyUser', 'vendorController@verifyUser')->name('verifyUser');
Route::get('/user/home', function () { return view('user.home'); });
Route::get('/user/outbox', 'vendorController@loadOutBox');
Route::get('/user/customsms', function (){ return view("/user/customsms"); });
Route::get('/user/bulksms', function (){ return view("/user/bulksms"); });
Route::get('/user/singlesms', function (){ return view("/user/singlesms"); });
Route::get('/user/topup', function (){ return view("/user/topup"); });
Route::get('/user/signout', 'vendorController@signout');
Route::post('/user/creditTopup', 'vendorController@autoCreditTopup');



Route::get('/admin/login', function () { return view('/admin/login', ['error'=> false]); });
Route::post('/admin/verifyAdmin', 'adminController@verifyAdmin');
Route::get('/admin/home', function () { return view('admin/home'); });
Route::post('/admin/vendorCreditTopup', 'adminController@vendorCreditTopup');
// Route::get('/admin/outbox', 'adminController@loadOutBox');
Route::get('/admin/vendors', 'adminController@getVendors');
Route::get('/admin/bulksms', function (){ return view("/admin/bulksms"); });
Route::get('/admin/singlesms', function (){ return view("/admin/singlesms"); });
Route::get('/admin/signout', 'adminController@signout');



Route::post('/vendor/verifyUser', 'vendorController@verifyUser')->name('verifyUser');
Route::post('/vendor/newVendor', 'VendorController@newVendor')->name('newVendor');



Route::post('/populate', 'dashboardController@populate')->name('populate');
Route::post('/loadOutBox', 'dashboardController@loadOutBox')->name('loadOutBox');
Route::post('/sendMessage', 'messageController@sendMessage')->name('sendMessage');
Route::post('/sendBulkMessage', 'messageController@sendBulkMessage')->name('sendBulkMessage');
Route::post('/sendCustomMessage', 'messageController@sendCustomMessage')->name('sendCustomMessage');
Route::post('/generateCustomeMessages', 'fileController@generateCustomeMessages')->name('generateCustomeMessages');
Route::post('/uploadFromCsv', 'fileController@uploadFromCsv')->name('uploadFromCsv');
