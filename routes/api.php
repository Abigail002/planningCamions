<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Resources\UserResource;
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

Route::name('api.')->group(
    function () {
        Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
            return new UserResource($request->user());
        });

        Route::middleware('guest')->group(function () {
            Route::post('/login', LoginController::class)->name('login');
        });
    }
);