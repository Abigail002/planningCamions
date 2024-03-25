<?php

use App\Http\Controllers\PdfGeneratorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/file', function () {
    return view('loadingPDF');
});
Route::get('/file/download/{id}', [PdfGeneratorController::class, 'generate'])->name('file.generate');


