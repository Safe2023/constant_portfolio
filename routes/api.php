<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\EssaiController;
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

Route::post('/register', [ApiController::class, 'register']);
Route::post('/login', [ApiController::class, 'login']);
Route::post('/forgot-password', [ApiController::class, 'forgot_password']);
Route::post('/reset-password', [ApiController::class, 'reset_password'])->name('reset_password');
Route::post('/logout', [ApiController::class, 'logout']);

Route::post('/ajout', [EssaiController::class, 'store']);
Route::get('/delete/{id}', [EssaiController::class, 'destroy']);
Route::post('/updatetevol/{id}', [EssaiController::class, 'update']);
Route::get('/tableau', [EssaiController::class, 'tableau']);
Route::get('/liste', [EssaiController::class, 'liste']);
