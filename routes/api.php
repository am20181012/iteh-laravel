<?php

use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\DiagnosisTherapyController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientDiagnosisController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDiagnosisController;
use App\Http\Controllers\UserPatientController;
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

//rute za registraciju i logovanje korisnika
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//rute za pregled svih korisnika i prikaz jednog korisnika
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);

//rute za pregled svih pacijenata, dijagnoza i terapija kao i za pojedinacan pregled
Route::resource('patients', PatientController::class)->only(['index', 'show']);
Route::resource('diagnoses', DiagnosisController::class)->only(['index', 'show']);
Route::resource('users.patients', UserPatientController::class)->only(['index']);
Route::resource('users.diagnoses', UserDiagnosisController::class)->only(['index']);
Route::resource('patients.diagnoses', PatientDiagnosisController::class)->only(['index']);
Route::resource('diagnoses.therapies', DiagnosisTherapyController::class)->only(['index', 'show']);

//rute kojima je ogranicen pristup
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });

    Route::resource('patients', PatientController::class)->only(['store', 'update']);
    Route::delete('/patient/{id}', [PatientController::class, 'destroy']);

    Route::resource('diagnoses', DiagnosisController::class)->only(['store', 'update']);

    Route::resource('diagnoses.therapies', DiagnosisTherapyController::class)->only(['store', 'update', 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);

});

