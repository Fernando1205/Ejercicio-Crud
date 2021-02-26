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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/users', 'UserController@index')->name('index');
    Route::get('/edit/{id}', 'UserController@edit')->name('edit');
    Route::put('/update/{id}', 'UserController@update')->name('update');
    Route::delete('/{id}', 'UserController@delete')->name('delete');
});





