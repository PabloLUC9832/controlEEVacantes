<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MotivoController;
use App\Http\Controllers\VacanteController;
use App\Http\Controllers\ZonaDependenciaController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\LogUserActivityController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified','team'
])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified','team'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::controller(VacanteController::class)->group(function (){

    Route::name('vacante.')->group(function (){

        Route::get('/vacante',  'index') ->name('index');
        Route::get('/vacante/create',  'create')->name('create');
        Route::post('/vacante',  'store')->name('store');
        Route::delete('/vacante/destroy/{id}',  'destroy')->name('destroy');

        Route::get('/vacante/edit/{id}','edit')->name('edit');
        Route::post('/vacante/update/{id}','update')->name('update');

        Route::get('/vacante/import',  'import')->name('import');
        Route::post('/vacante/upload','uploadCSV')->name('upload');

    });

});

Route::post('api/fetch-dependencias', [ZonaDependenciaController::class, 'fetchDependencia']);

Route::controller(DocenteController::class)->group(function (){

    Route::name('docente.')->group(function (){

        Route::get('/docente',  'index') ->name('index');
        Route::get('/docente/create',  'create')->name('create');
        Route::post('/docente',  'store')->name('store');
        Route::delete('/docente/destroy/{id}',  'destroy')->name('destroy');

        Route::get('/docente/edit/{id}','edit')->name('edit');
        Route::post('/docente/update/{id}','update')->name('update');

        Route::get('/docente/export','export')->name('export');


    });

});

Route::controller(LogUserActivityController::class)->group(function (){

    Route::name('bitacora.')->group(function (){

        Route::get('/bitacora',  'index') ->name('index');

    });

});
