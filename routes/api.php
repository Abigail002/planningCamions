<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\ForecastController;
use App\Http\Controllers\LoadingFileController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\UserController;
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

        Route::post('/container/delivered/{id}', [ContainerController::class, 'update'])->name('container.delivered');
        Route::post('/container/status/{id}', [ContainerController::class, 'updateStatus'])->name('container.update.status');
        Route::post('/forecast/update/{id}', [ForecastController::class, 'update'])->name('forecast.update');

        Route::get('/driver/{id}', [MissionController::class, 'index'])->name('driver.mission');
        Route::get('/drivers', [UserController::class, 'getDriversListArray'])->name('drivers');
        Route::post('/mission/add', [MissionController::class, 'store'])->name('mission.add');
        Route::post('/file/add', [LoadingFileController::class, 'store'])->name('file.add');
        Route::post('/file/update/{id}', [LoadingFileController::class, 'update'])->name('file.update');

        Route::post('/user/updatePassword/{id}', [UserController::class, 'updatePassword'])->name('user.update');
    }
);
