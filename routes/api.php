<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\Productcontroller;
use App\Http\Controllers\Categorycontroller;
use App\Http\Controllers\PurchaseOrderController;

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

Route::get('login', function() {
    abort(401);
})->name('login');

Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/auth/{provider}', [AuthController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [AuthController::class, 'handleProviderCallback']);

Route::group(['middleware' => ['auth:sanctum', 'verify.permission']], function(){
    Route::resource('/products', ProductController::class);
    Route::resource('/categories', CategoryController::class);
});

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/public/products', [ProductController::class, 'cacheList']);
    Route::post('/public/purchase-order', [PurchaseOrderController::class, 'store']);
});

