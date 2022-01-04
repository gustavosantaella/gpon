<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('authlogin', function(){
    $user = \App\Models\User::find(2);
    Auth::logout(auth()->user());
});



// laravel websockets
    //host/laravel-websockets
//----------------------------------
Route::prefix('dashboard')
->namespace('\App\Http\Controllers\Admin')
->as('admin.')
->middleware('auth')
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


	    Route::resource('planificaciones', 'PlanificationModule');
        Route::post('planifiaciones/approved/{planificacione}', 'PlanificationModule@approved')->name('planificaciones.approved');
        Route::resource('fibra-optica', 'FoModule')->except('update');
        Route::post('fibra-optica/update/', 'FoModule@update')->name('fibra-optica.update');

        Route::resource('red-local', 'RedLocalModule')->except('update');
        Route::post('red-local/update/', 'RedLocalModule@update')->name('red-local.update');

        Route::resource('energia', 'EnergyModule')->except('update');
        Route::post('energia/update/', 'EnergyModule@update')->name('energia.update');

        Route::resource('infraestructura', 'InfraestructureModule')->except('update');
        Route::post('infraestructura/update/', 'InfraestructureModule@update')->name('infraestructura.update');

        //-------------------------------------------------------------------------
           // Construcciones
            Route::resource('construcciones', 'ConstructionController')->except('update');
            Route::post('construccion/update/', 'ConstructionController@update')->name('construcciones.update');
        //-------------------------------------------------------------------------


    });
        Route::prefix('answer')->as('answer.')->group(function () {

    Route::post('approved/line', 'AnswerController@ApprovedOrDecline')->name('approved');
    });

//--------------------------------------------------------------------------------------

    // xhr
    Route::prefix('xhr')->as('xhr.')->group(function(){
        Route::get('getStates', [\App\Http\Controllers\Admin\StateController::class, 'getStates'])->name('getStates');
         Route::get('municipalities-from-state/{state:id}', [\App\Http\Controllers\Admin\MunicipalityController::class, 'getMunicipalities'])->name('getMunicipalities');
         Route::get('parishes-from-municipality/{municipality:id}', [\App\Http\Controllers\Admin\ParishController::class, 'getParishes'])->name('getParishes');
          Route::get('get-models', [\App\Http\Controllers\Admin\ModelController::class, 'getModels'])->name('getModels');
    });

});

