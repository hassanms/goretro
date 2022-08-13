<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrentStockController;
use App\Http\Controllers\PreOrderController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StripeController;

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
Route::get("/carousel//checkout", [ProductsController::class, "checkout"]);

//Post Routes
Route::post("/carousel", [ProductsController::class, "addProduct"]);
Route::post("/carousel/cart", [ProductsController::class, "addToCart"]);
Route::get("/carousel//checkout", [ProductsController::class, "checkoutCart"]);

//Pre Order Routes
Route::get("/pre-order", [PreOrderController::class, "preOrders"]);
Route::get("/pre-order/filter/{batch}", [PreOrderController::class, "filterByBatch"]);


Route::post("/pre-order", [PreOrderController::class, "addOrder"]);