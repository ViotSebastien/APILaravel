<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProduitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::group(['middleware' =>['auth:sanctum']], function() {
    Route::apiResource('produit', ProduitController::class);
});
Route::post('inscription', [AuthController::class, 'InscrisUtilisateur']);
Route::post('connexion', [AuthController::class, 'connexion']);
