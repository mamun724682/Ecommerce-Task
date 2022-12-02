<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->group(function () {
    // Auth
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Import products
    Route::post('/products-import', [ProductController::class, 'import']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('auth-user', [AuthController::class, 'authUser']);
        Route::get('logout', [AuthController::class, 'logout']);

    });
});
