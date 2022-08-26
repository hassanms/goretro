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
Route::get("/carousel/tier", [ProductsController::class, "checkTier"]);
Route::get("/carousel//checkout", [ProductsController::class, "checkoutCart"]);

//Show Tiers
Route::get("/carousel//show-tier-1", [ProductsController::class, "showTier1"]);
Route::get("/carousel//show-tier-2", [ProductsController::class, "showTier2"]);
Route::get("/carousel//show-tier-3", [ProductsController::class, "showTier3"]);

//Post Routes
Route::post("/carousel", [ProductsController::class, "addProduct"]);
Route::post("/carousel//cart", [ProductsController::class, "addToCart"]);
Route::post("/carousel/damage", [ProductsController::class, "showDamage"]);
Route::get("/carousel//checkout", [ProductsController::class, "checkoutCart"]);

//Pre Order Routes
Route::get("/pre-order", [PreOrderController::class, "preOrders"]);
Route::post("/pre-order/batch", [PreOrderController::class, "filterByBatch"]);

Route::post("/stripe-checkout", [StripeController::class, "processStripe"]);

Route::get("/email", [ProductsController::class, "emailSend"]);
Route::post("/super-item", [ProductsController::class, "superItem"]);