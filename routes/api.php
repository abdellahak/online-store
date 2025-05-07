<?php

use App\Http\Controllers\api\ApiAuthController;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\api\CheckLoggedInMiddleware;

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
Route::middleware(CheckLoggedInMiddleware::class)->group(function(){
    Route::post('/register',[ApiAuthController::class,'register']);
    Route::post('/login',[ApiAuthController::class,'login']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware("auth:sanctum")->controller(OrderController::class)->group(function() {
        Route::get("orders","getOrders");
        Route::get("orders/{id}","show");
        
    });