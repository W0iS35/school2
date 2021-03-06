<?php

use App\Http\Controllers\AnioAcademicoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConceptoPagoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\VacantesController;
use App\Models\Vacante;
use Illuminate\Support\Facades\Auth;
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


//Auth::routes();

/************************************************************ */

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/custom-signin', [AuthController::class, 'createSignin'])->name('signin.custom');


Route::get('/register', [AuthController::class, 'signup'])->name('register');
Route::post('/create-user', [AuthController::class, 'customSignup'])->name('user.registration');


Route::get('/dashboard', [AuthController::class, 'dashboardView'])->name('dashboard');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/************************************************************ */

/* API */
Route::get('/vacantes-API/{id_anio}/{id_local?}/{id_nivel?}', [HomeController::class, 'getDashboard'])->name('home.vacantesdashboard');
Route::get('/alumno-API/{dni?}/{id_anio?}', [HomeController::class, 'getInfoAlumno'])->name('home.alumno_info');

Route::get('/api/pagos', [PagoController::class, 'index'])->name('pago');
Route::post('/api/pagos', [PagoController::class, 'store'])->name('pago.store');

//Route::post('/Pagos', [PagoController::class, 'store'])->name('pago.store');




/***************************************** Begin: Vistas  ********************************************/
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/anio-academico', [HomeController::class, 'anioAcademico'])->name('home.anio');
Route::get('/vacantes/{id_anio?}', [HomeController::class, 'vacantes'])->name('home.vacantes');
Route::get('/conceptos-pago/{id_anio?}', [HomeController::class, 'conceptosPago'])->name('home.conceptos');
Route::get('/pagos', [HomeController::class, 'facturacion_pagos'])->name('home.facturacion.pagos');



/***************************************** End: Vistas  ********************************************/


/***************************************** Begin: CRUD A??o academico  ********************************************/
Route::post('/anio-academico', [AnioAcademicoController::class, 'store'])->name('anio.store');
Route::put('/anio-academico', [AnioAcademicoController::class, 'update'])->name('anio.update');
Route::get('/anio-academico/delete/{id}', [AnioAcademicoController::class, 'destroy'])->name('anio.delete');
/***************************************** End: CRUD A??o academico  ********************************************/

/***************************************** Begin: CRUD A??o Vacante  ********************************************/
Route::post('/vacante', [VacantesController::class, 'store'])->name('vacantes.store');
Route::put('/vacante', [VacantesController::class, 'update'])->name('vacantes.update');
Route::get('/vacante/{id}', [VacantesController::class, 'destroy'])->name('vacantes.delete');
Route::post('/vacante/masivo', [VacantesController::class, 'masivo'])->name('vacantes.masivo');
//Route::get('/vacante/{id_anio}', [VacantesController::class, 'show'])->name('vacante.show');
/***************************************** End: CRUD A??o Vacante  ********************************************/


/***************************************** Begin: CRUD Concepto de pago  ********************************************/
Route::post('/conceptos-pago', [ConceptoPagoController::class, 'store'])->name('concepto.store');
Route::put('/conceptos-pago', [ConceptoPagoController::class, 'update'])->name('concepto.update');
Route::get('/conceptos-pago/deleted/{id?}', [ConceptoPagoController::class, 'destroy'])->name('concepto.destroy');
//Route::delete('/conceptos-pago/{id}', [VacantesController::class, 'destroy'])->name('vacantes.destroy');
/***************************************** End: CRUD Concepto de pago  ********************************************/



Route::fallback( [HomeController::class, 'error404'])->name('not.found');


