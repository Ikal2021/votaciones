<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginAuth;
use App\Http\Controllers\Api\Register;
use App\Http\Controllers\Api\Departamentos;
use App\Http\Controllers\Api\Partidos;
use App\Http\Controllers\Api\ApiCensoCne;
use App\Http\Controllers\Api\CandidatoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('apiLogin', [LoginAuth::class, 'login'])->name('apiLogin');
Route::post('apiregister',[Register::class,'register'])->name('apiregister');
Route::post('apilogout', [LoginAuth::class, 'logout'])->name('apilogout');
Route::post('/apiCNE/{dni}', [ApiCensoCne::class, 'getPersonaCne']);
Route::post('apiCrearCandidato', [CandidatoController::class, 'CrearCandidato'])->name('apiCrearCandidato');

//get departamentos, municipios y aldeas
Route::get('apiDeptos', [Departamentos::class, 'getDepartamentos'])->name('apiDeptos');
Route::get('apiMuni', [Departamentos::class, 'getMunicipios'])->name('apiMuni');
Route::get('apiAldea', [Departamentos::class, 'getAldeas'])->name('apiAldea');

//Get partidos y movimientos
Route::get('apiPartido', [Partidos::class, 'getPartidos'])->name('apiPartido');
Route::get('apiMovimiento', [Partidos::class, 'getMovimientos'])->name('apiMovimiento');

//GET CANDIDATO
Route::get('apiObtenerCandidato', [CandidatoController::class, 'getCandidatos'])->name('apiObtenerCandidato');




