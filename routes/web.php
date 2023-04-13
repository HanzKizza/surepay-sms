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
    return view('dashboard');
});


Route::get('/vendor/register', function () {
    return view('vendor.register');
});

Route::get('/vendor/login', function () {
    return view('vendor.login');
});

Route::post('/vendor/verifyUser', 'vendorController@verifyUser')->name('verifyUser');
Route::post('/vendor/newVendor', 'VendorController@newVendor')->name('newVendor');


Route::post('/populate', 'dashboardController@populate')->name('populate');
Route::post('/loadOutBox', 'dashboardController@loadOutBox')->name('loadOutBox');
Route::post('/sendMessage', 'messageController@sendMessage')->name('sendMessage');
Route::post('/sendBulkMessage', 'messageController@sendBulkMessage')->name('sendBulkMessage');
Route::post('/sendCustomMessage', 'messageController@sendCustomMessage')->name('sendCustomMessage');
Route::post('/generateCustomeMessages', 'fileController@generateCustomeMessages')->name('generateCustomeMessages');
Route::post('/uploadFromCsv', 'fileController@uploadFromCsv')->name('uploadFromCsv');
