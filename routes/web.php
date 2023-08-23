<?php

use Illuminate\Support\Facades\Route;
use  Illuminate\Support\Facades\Auth;
use  Illuminate\Support\Facades\Facade;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth' ], function(){

    Route::get('/monitoramento', function () {  return view('monitoramento'); });

    // Animal
    Route::get('/animal', [App\Http\Controllers\AnimalController::class, 'getView'])->name('animal');
    Route::get('/animal_update/{id}', [App\Http\Controllers\AnimalController::class, 'getAnimalId'])->name('animal_update');
    Route::get('/animal_create', [App\Http\Controllers\AnimalController::class, 'createForm'])->name('createForm');
    Route::get('/animal_update/{id}', [App\Http\Controllers\AnimalController::class, 'getAnimalId'])->name('animal_update');
    Route::put('/animal_update/update/{id}', [App\Http\Controllers\AnimalController::class, 'update'])->name('update_');  //lista



    Route::get('/tipo',  [App\Http\Controllers\TipoAnimalController::class, 'getView'])->name('tipo');
    Route::get('/tipo_update/{id}', [App\Http\Controllers\TipoAnimalController::class, 'getTipoId'])->name('tipo_update');
    Route::get('/tipo_animal_create', [App\Http\Controllers\TipoAnimalController::class, 'createForm'])->name('createFormTipo');

    Route::get('/raca',  [App\Http\Controllers\RacaController::class, 'getView'])->name('raca');
    Route::put('/raca_update/update/{id}', [App\Http\Controllers\RacaController::class, 'update'])->name('raca_update');  //tipo



}  );
