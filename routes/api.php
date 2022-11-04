<?php

use App\Http\Controllers\Api\CookwhithusController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Api\FoodRecipeController;
use App\Http\Controllers\Api\PromotionController;

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

//ruta establecimientos
Route::apiResource('establishment', EstablishmentController::class);
//ruta productos
Route::apiResource('products', ProductController::class);
//ruta orden 
Route::apiResource('orders', OrderController::class);
//ruta categoria
Route::apiResource('category', CategoryController::class);
//ruta Recetas
Route::apiResource('foodrecipe', FoodRecipeController::class);
//ruta Cocina Con Nosotros
Route::apiResource('cooking', CookwhithusController::class);
//ruta Anuncio
Route::apiResource('promotions', PromotionController::class);

/**************************************Autenticacion**************************************/ 
//registro
Route::post('auth/register', [AuthController::class, 'register'])->name('auth/register');
//login
Route::post('auth/login', [AuthController::class, 'login'])->name('auth/login');
//logout
Route::post('auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
