<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/chauffeur')->name('chauffeur.')->controller(\App\Http\Controllers\Api\AuthDriverController::class)->group(function(){
    Route::post('/login', 'doLogin');
    Route::post('/localisation', 'addLocalisation')->middleware("auth:sanctum");
    Route::post('/carburant', 'addCarburant')->middleware("auth:sanctum");
    Route::post('/maintenance', 'addMaintenance')->middleware("auth:sanctum");
});
