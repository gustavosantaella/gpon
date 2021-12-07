<?php

use Illuminate\Support\Facades\Route;
Route::get('authlogin', function(){
    $user = \App\Models\User::find(2);
    \Auth::login($user);
});
Route::prefix('dashboard')
->namespace('\App\Http\Controllers\Admin')
->as('admin.')
// change to middleware auth 
->group(function(){
    Route::get('/', 'HomeController@index')->name('home');
//--------------------------------------------------------------------------------------
    // users
    Route::resource('usuarios', 'UserController');
    Route::group(['prefix' => 'usuarios', 'as'=>'usuarios.'], function() {

    });

//--------------------------------------------------------------------------------------
    // gerencias
    Route::resource('gerencias', 'ManagementController');
    Route::group(['prefix' => 'gerencias', 'as'=>'gerencias.'], function() {
        Route::post('{gerencia:id}/task/store', 'ManagementController@storeTask')->name('storeTask');
        Route::put('{gerencia:id}/{task}/update', 'ManagementController@updateTask')->name('updateTask');
        Route::get('usuarios/all/management', 'ManagementController@getUsers')->name('getUsers');
        Route::delete('{gerencia:id}/{task}/delete', 'ManagementController@deleteTask')->name('deleteTask');
        Route::post('{gerencia:id}/add-user', 'ManagementController@addUserToManagement')->name('addUserToManagement');
        Route::delete('{gerencia:id}/{user:id}/remove-user', 'ManagementController@removeUser')->name('removeUser');
        Route::post('{gerencia:id}/addOrRemoveRole', 'ManagementController@addOrRemoveRole')->name('addOrRemoveRole');
    });

//--------------------------------------------------------------------------------------
    Route::prefix('equipos')->group(function(){
    // proveedores
        Route::resource('proveedores', 'ProviderController');
//----------
    // modelos


        Route::resource('modelos', 'ModelController');
    });
//--------------------------------------------------------------------------------------

    // roles
    Route::resource('roles', 'RoleController');


//--------------------------------------------------------------------------------------

    // modulos
   
    Route::prefix('modulos')->namespace('\Modules')->as('modules.')->group(function(){
    	
	    Route::get('planificaciones', 'ModuleController@index')->name('planificaciones.index');
    });
});

