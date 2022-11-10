<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MotivoController;
use App\Http\Controllers\VacanteController;
use App\Models\Motivo;
use App\Http\Controllers\ZonaDependenciaController;

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

//Route::get('/', function () {
    //(new Motivo())->importToDB();
    //dd('done');
    //return view('welcome');
    //return view('dashboard');
//});

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

Route::resource('/motivos',\App\Http\Controllers\MotivoController::class);

Route::get('import',[MotivoController::class,'create'])->name('import');
Route::post('import',[MotivoController::class,'store'])->name('import');

Route::controller(VacanteController::class)->group(function (){

    Route::name('vacante.')->group(function (){

        Route::get('/vacante',  'index') ->name('index');
        Route::get('/vacante/create',  'create')->name('create');
        Route::post('/vacante',  'store')->name('store');
        Route::delete('/vacante/destroy/{id}',  'destroy')->name('destroy');

        Route::get('/vacante/import',  'import')->name('import');
        Route::post('/vacante/upload','uploadCSV')->name('upload');

    });

});

Route::post('api/fetch-dependencias', [ZonaDependenciaController::class, 'fetchDependencia']);
