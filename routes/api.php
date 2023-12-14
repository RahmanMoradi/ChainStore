<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\CityController;
use App\Http\Controllers\Api\v1\OrderController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\ShopController;
use App\Http\Controllers\Api\v1\UserController;
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

Route::post("register", [AuthController::class, "register"])->name("register");
Route::post("login", [AuthController::class, "login"])->name("login");

Route::middleware("auth:sanctum")->group(function (){
    Route::apiResource("user", UserController::class)->parameter("user", "user:uuid");
    Route::apiResource("shop", ShopController::class)->parameter("shop", "shop:uuid");
    Route::apiResource("product", ProductController::class)->parameter("product", "product:uuid");
    Route::apiResource("category", CategoryController::class);
    Route::apiResource("order", OrderController::class)->parameter("order", "order:uuid");
    Route::apiResource("city", CityController::class)->parameter("city", "city:uuid");
});
