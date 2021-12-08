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
   
    Route::prefix('modulos')->namespace('\App\Http\Controllers\Admin\Modules')->as('modules.')->group(function(){
    	
	    Route::get('planificaciones', 'PlanificationModule@index')->name('planificaciones.index');
        Route::post('planificaciones', 'PlanificationModule@store')->name('planificaciones.store');
    });

//--------------------------------------------------------------------------------------

    // xhr
    Route::prefix('xhr')->as('xhr.')->group(function(){
        Route::get('getStates', [\App\Http\Controllers\Admin\StateController::class, 'getStates'])->name('getStates');
         Route::get('municipalities-from-state/{state:id}', [\App\Http\Controllers\Admin\MunicipalityController::class, 'getMunicipalities'])->name('getMunicipalities');
         Route::get('parishes-from-municipality/{municipality:id}', [\App\Http\Controllers\Admin\ParishController::class, 'getParishes'])->name('getParishes');
    });

});

