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
use App\Http\Controllers\EventController;
use App\Http\Controllers\AttendEventController;
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

Route::middleware(['auth:sanctum', 'isAPIAdmin'])->group(function () {
    Route::get('/checkingAuthenticated', function () {
        return response()->json([
            "message" => "You are in",
            "status" => "200"
        ], 200);
    });
});
////////////////////////////////////////////////////////////////////////
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//ruta establecimientos
// Route::apiResource('establishment', EstablishmentController::class);
//Route::resource('establishment', EstablishmentController::class);
//ruta productos
//Route::apiResource('products', ProductController::class);
//Route::resource('products', ProductController::class);
//ruta categoria
//Route::apiResource('category', CategoryController::class);
//ruta Recetas
// Route::apiResource('recipe', FoodRecipeController::class);
//Route::resource('recipe', FoodRecipeController::class);
//ruta Cocina Con Nosotros
Route::apiResource('cooking', CookwhithusController::class);
//ruta Anuncio
//Route::apiResource('promotion', PromotionController::class);

/**************************************Autenticacion**************************************/
//registro
Route::post('auth/register', [AuthController::class, 'register'])->name('auth/register');
//login
Route::post('auth/login', [AuthController::class, 'login'])->name('auth/login');
//logout
Route::post('auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
/************************************Carrito de compras***********************************/
//Agregar productos al carrito
Route::post('add-to-cart', [OrderController::class, 'addtocart']);
//
Route::post('cart', [OrderController::class, 'viewcart']);
//increment and decrement price of products
Route::put('cart-updatequanty/{card_id}/{scope}', [OrderController::class, 'updatequanty']);
//Delete cartitem
Route::delete('delete-cartitem/{cart_id}', [OrderController::class, 'deleteCartitem']);

/*************************** API **************************/
Route::controller(ProductController::class)->group(function(){
    Route::get('products','index');
    Route::post('product','store');
    Route::put('product/{id}','update');
    Route::get('products/{id}','show');
    Route::delete('delete-product/{id}','destroy');
});

Route::controller(FoodRecipeController::class)->group(function(){
        Route::get('recipes','index');
        Route::post('recipe','store');
        Route::put('recipe/{id}','update');
        Route::get('recipes/{id}','show');
        Route::delete('delete-recipe/{id}', 'destroy');
});

Route::controller(EstablishmentController::class)->group(function(){
        Route::get('establishments','index');
        Route::post('establishment','store');
        Route::put('establishment/{id}','update');
        Route::get('establishments/{id}','show');/*********Esta ruta es una consulta a DB**********/
        Route::delete('delete-establishment/{id}', 'destroy');
});

Route::controller(CategoryController::class)->group(function(){
        Route::get('categories','index');
        Route::post('category','store');
        Route::put('category/{id}','update');
        Route::get('categories/{id}','show');
        Route::delete('delete-category/{id}', 'destroy');
});

Route::controller(PromotionController::class)->group(function(){
    Route::get('promotions','index');
    Route::post('promotion','store');
    Route::put('promotion/{id}','update');
    Route::get('promotions/{id}','show');
    Route::delete('delete-promotion/{id}', 'destroy');
});

Route::controller(EventController::class)->group(function(){
    Route::get('events','index');
    Route::post('event','store');
    Route::put('event/{id}','update');
    Route::get('events/{id}','show'); //vacia xd
    Route::delete('delete-event/{id}', 'destroy');
});

/* asistencia eventos */

Route::post('events-user', [AttendEventController::class, 'AsistirEvento']);
Route::delete('delete-event-user/{id}', [AttendEventController::class], 'destroy');


/****** Falta Consula
Route::get('events-user/{id}',[AttendEventController::class, 'ListarAsistencia']);
*/