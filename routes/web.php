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

Route::post('/populate', 'dashboardController@populate')->name('populate');
Route::post('/sendMessage', 'messageController@sendMessage')->name('sendMessage');
Route::post('/sendBulkMessage', 'messageController@sendBulkMessage')->name('sendBulkMessage');
Route::post('/sendCustomMessage', 'messageController@sendCustomMessage')->name('sendCustomMessage');
Route::post('/generateCustomeMessages', 'fileController@generateCustomeMessages')->name('generateCustomeMessages');
Route::post('/uploadFromCsv', 'fileController@uploadFromCsv')->name('uploadFromCsv');