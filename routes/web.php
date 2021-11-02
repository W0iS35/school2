<?php

use App\Http\Controllers\AnioAcademicoController;
use App\Http\Controllers\ConceptoPagoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VacantesController;
use App\Models\Vacante;
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

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/anio-academico', [HomeController::class, 'anioAcademico'])->name('home.anio');
Route::get('/vacantes/{id_anio?}', [HomeController::class, 'vacantes'])->name('home.vacantes');
Route::get('/conceptos-pago/{id_anio?}', [HomeController::class, 'conceptosPago'])->name('home.conceptos');

Route::post('/anio-academico', [AnioAcademicoController::class, 'store'])->name('anio.store');
Route::put('/anio-academico', [AnioAcademicoController::class, 'update'])->name('anio.update');

Route::post('/vacante', [VacantesController::class, 'store'])->name('vacantes.store');
Route::put('/vacante', [VacantesController::class, 'update'])->name('vacantes.update');
Route::get('/vacante/{id}', [VacantesController::class, 'destroy'])->name('vacantes.delete');
Route::post('/vacante/masivo', [VacantesController::class, 'masivo'])->name('vacantes.masivo');
//Route::get('/vacante/{id_anio}', [VacantesController::class, 'show'])->name('vacante.show');


Route::post('/conceptos-pago', [ConceptoPagoController::class, 'store'])->name('concepto.store');
Route::put('/conceptos-pago', [ConceptoPagoController::class, 'update'])->name('concepto.update');
//Route::delete('/conceptos-pago/{id}', [VacantesController::class, 'destroy'])->name('vacantes.destroy');


Route::get('/prueba', [HomeController::class, 'prueba'])->name('home.prueba');


