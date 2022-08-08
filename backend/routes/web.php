<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstalationController;
use App\Http\Controllers\EquipoController;

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

Route::get('/instalation/all',[InstalationController::class,'get_all']);
Route::get('/instalation/{id}',[InstalationController::class,'get_id']);
Route::delete('/instalation/{id}', [InstalationController::class,'delete_id']);
Route::post('/instalation/add',[InstalationController::class,'store']);

# Vista tecnico
Route::post('/equipos/add_coordinador',[EquipoController::class,'store']); # Agregar equipo coordinador
Route::post('/equipos/add_sonda',[EquipoController::class,'store']); # Agregar equipo sonda
Route::post('/equipos/add_canal',[EquipoController::class,'store']); # Agregar equipo canal
Route::post('/equipos/add_estacion',[EquipoController::class,'store']); # Agregar equipo estacion
Route::post('/equipos/add_pozo',[EquipoController::class,'store']); # Agregar equipo pzo
Route::get('/tecnico/{id1}/equipos/{id2}',[EquipoController::class,'obtener_equipos_tecnico']);# Obtener todos los equipos del tecnico

# Vista Soporte
Route::get('/equipos/soportes/{id}',[EquipoController::class,'obtener_equipos_soporte']); # Obtener todos los equipos de coordinacion
Route::post('/equipos/change_state',[EquipoController::class,'change_state']);
Route::put('/equipos/{id}',[EquipoController::class,'actualizar_equipo']);
Route::delete('/equipos/{id}', [EquipoController::class,'delete_equipo']);




