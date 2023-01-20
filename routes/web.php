<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoAsignacionController;
use App\Http\Controllers\MotivoController;
use App\Http\Controllers\VacanteController;
use App\Http\Controllers\ZonaDependenciaController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\ExperienciaEducativaController;
use App\Http\Controllers\LogUserActivityController;
use App\Http\Controllers\PeriodoController;

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

Route::get('join', function () {
    return view('joinTeam');
});


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

        Route::get('/vacante/category',  'category')->name('category');
    });

});

Route::post('api/fetch-dependencias', [ZonaDependenciaController::class, 'fetchDependencia']);
Route::post('api/fetch-nombreExperienciaEducativa', [VacanteController::class, 'fetchNombreExperienciaEducativa']);

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

Route::controller(ExperienciaEducativaController::class)->group(function (){

    Route::name('experienciaEducativa.')->group(function (){

        Route::get('/experienciaEducativa',  'index') ->name('index');
        Route::get('/experienciaEducativa/create',  'create')->name('create');
        Route::post('/experienciaEducativa',  'store')->name('store');
        Route::delete('/experienciaEducativa/destroy/{id}',  'destroy')->name('destroy');

        Route::get('/experienciaEducativa/edit/{id}','edit')->name('edit');
        Route::post('/experienciaEducativa/update/{id}','update')->name('update');

    });

});

Route::controller(PeriodoController::class)->group(function (){

    Route::name('periodo.')->group(function (){

        Route::get('/periodo',  'index') ->name('index');
        Route::get('/periodo/create',  'create')->name('create');
        Route::post('/periodo',  'store')->name('store');
        Route::delete('/periodo/destroy/{id}',  'destroy')->name('destroy');

        Route::get('/periodo/edit/{id}','edit')->name('edit');
        Route::post('/periodo/update/{id}','update')->name('update');

    });

});

Route::controller(TipoAsignacionController::class)->group(function (){

    Route::name('tipoAsignacion.')->group(function (){

        Route::get('/tipoAsignacion',  'index') ->name('index');
        Route::get('/tipoAsignacion/create',  'create')->name('create');
        Route::post('/tipoAsignacion',  'store')->name('store');
        Route::delete('/tipoAsignacion/destroy/{id}',  'destroy')->name('destroy');

        Route::get('/tipoAsignacion/edit/{id}','edit')->name('edit');
        Route::post('/tipoAsignacion/update/{id}','update')->name('update');

    });

});


Route::controller(MotivoController::class)->group(function (){

    Route::name('motivo.')->group(function (){

        Route::get('/motivo',  'index') ->name('index');
        Route::get('/motivo/create',  'create')->name('create');
        Route::post('/motivo',  'store')->name('store');
        Route::delete('/motivo/destroy/{id}',  'destroy')->name('destroy');

        Route::get('/motivo/edit/{id}','edit')->name('edit');
        Route::post('/motivo/update/{id}','update')->name('update');

    });

});


Route::controller(ZonaController::class)->group(function (){

    Route::name('zona.')->group(function (){

        Route::get('/zona',  'index') ->name('index');
        Route::get('/zona/create',  'create')->name('create');
        Route::post('/zona',  'store')->name('store');
        Route::delete('/zona/destroy/{id}',  'destroy')->name('destroy');

        Route::get('/zona/edit/{id}','edit')->name('edit');
        Route::post('/zona/update/{id}','update')->name('update');

    });

});
