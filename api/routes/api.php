<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrentStockController;
use App\Http\Controllers\ProductsController;

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

Route::get("/currentStock", [CurrentStockController::class, "getData"]);
Route::get("/getViews/{category}", [CurrentStockController::class, "getViews"]);

//Carousel Page routes
Route::get("/carousel", [ProductsController::class, "getAllProducts"]);
Route::get("/carousel/{category}", [ProductsController::class, "displayProductByCategory"]);
Route::get("/carousel/status/{lockstatus}", [ProductsController::class, "checkItemLock"]);

//Post Routes
Route::post("/carousel", [ProductsController::class, "addProduct"]);
