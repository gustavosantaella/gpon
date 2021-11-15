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

Route::group([
    'namespace'=>'\App\Http\Controllers\Admin',
    'as'=>'admin.'
], function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('usuarios', 'UserController');
    Route::resource('gerencias', 'ManagementController');
    Route::resource('roles', 'UserController');

});
