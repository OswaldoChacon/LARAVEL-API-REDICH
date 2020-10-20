<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExperienciaController;
use App\Http\Controllers\RequisitoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VacanteController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [AuthController::class, 'login']);
Route::post('registro', [AuthController::class, 'registrar']);

Route::group(['prefix' => 'candidatos', 'middleware' => ['jwt:Candidato']], function () {
    Route::post('CV', [UsuarioController::class, 'uploadCV']);
    Route::delete('CV/{archivo}', [UsuarioController::class, 'eliminarCV']);
    Route::apiResource('experiencias', ExperienciaController::class);
    Route::post('postularme',[UsuarioController::class,'postularme']);
});


Route::group(['prefix' => 'admin', 'middleware' => ['jwt:Administrador']], function () {
    Route::apiResource('vacantes', VacanteController::class);
    Route::apiResource('requisitos', RequisitoController::class);    
    Route::get('postulados',[UsuarioController::class,'postulados']);
});

Route::group(['middleware' => ['jwt:Candidato,Administrador']], function () {
    Route::get('datos_personales', [UsuarioController::class, 'datosPersonales']);
});

Route::group(['middleware' => ['jwt:Candidato,Invitado']], function () {
    Route::get('vacantes', [VacanteController::class, 'index']);
});
