<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\CarburantController;
use App\Http\Controllers\ChauffeurController;
use Koossaayy\LaravelMapbox\Components\Mapbox;
use App\Http\Controllers\AttributionController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\LocalisationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/connexion', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'doLogin'])->name('connecting');
Route::delete('/deconnexion', [LoginController::class, 'logout'])->name('disconnect');


 Route::get('/admin', [MainController::class, 'index'])->name('dashboard')->middleware('auth:sanctum');

 Route::get('/chauffeur', [ChauffeurController::class, 'index'])->name('chauffeur')->middleware('auth:sanctum');
 Route::get('/vehicule',[VehiculeController::class, 'vehicule'])->name('vehicule')->middleware('auth:sanctum');
 Route::get('/attribution', [AttributionController::class, 'index'])->name('attribution')->middleware('auth:sanctum');
 Route::get('/carburant',[CarburantController::class, 'index'])->name('carburant')->middleware('auth:sanctum')->middleware('auth:sanctum');
 Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance')->middleware('auth:sanctum');
 Route::get('/localisation', [LocalisationController::class, 'index'])->name('localisation')->middleware('auth:sanctum');

Route::post('/creerChauffeur', [ChauffeurController::class, 'doPost'])->name('creerChauffeur')->middleware('auth:sanctum');
Route::delete('/supprimerChauffeur/{id}', [ChauffeurController::class, 'deleteDriver'])->name('supprimerChauffeur')->middleware('auth:sanctum');
Route::post('/creerVehicule', [VehiculeController::class, 'creerVehicule'])->name('creerVehicule')->middleware('auth:sanctum');
Route::post('/attribuer', [AttributionController::class, 'attribuer'])->name('attribuer')->middleware('auth:sanctum');
Route::post('/rechercheCarburant', [CarburantController::class, 'rechercheCarburant'])->name('rechercheCarburant')->middleware('auth:sanctum');
Route::post('/rechercheMaintenance', [MaintenanceController::class, 'rechercheMaintenance'])->name('rechercheMaintenance')->middleware('auth:sanctum');
Route::post('/rechercheLocalisation', [LocalisationController::class, 'rechercheLocalisation'])->name('rechercheLocalisation')->middleware('auth:sanctum');
