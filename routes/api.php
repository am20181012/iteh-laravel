<?php

use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\DiagnosisTherapyController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//rute za pregled svih korisnika i prikaz jednog korisnika
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);

Route::resource('patients', PatientController::class)->only(['index', 'show', 'store', 'update']);
Route::delete('/patients/{id}', [PatientController::class, 'destroy']);

Route::resource('diagnoses', DiagnosisController::class)->only(['index', 'show', 'store', 'update']);

Route::resource('diagnoses.therapies', DiagnosisTherapyController::class);
