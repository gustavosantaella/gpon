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
    'as'=>'admin.',
    'prefix'=>'admin'
], function(){
    Route::get('/', 'HomeController@index')->name('home');
    // users
    Route::resource('usuarios', 'UserController');
    // gerencias
    Route::resource('gerencias', 'ManagementController');
    Route::group(['prefix' => 'gerencias', 'as'=>'gerencias.'], function() {
        Route::post('{gerencia:id}/task/store', 'ManagementController@storeTask')->name('storeTask');
        Route::put('{gerencia:id}/{task}/update', 'ManagementController@updateTask')->name('updateTask');
    });

    // roles
    Route::resource('roles', 'RoleController');

});
