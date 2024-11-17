<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Auth;
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

Route::get('/contact', function () {
    return view('contact');
});
Route::post('/contact',[PortfolioController:: class, 'mail'] )->name('mail');
Route::post('/subscribe', [PortfolioController::class, 'post_'])->name('subscribe');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::get('/ajout', [PortfolioController:: class, 'create']);
    Route::post('/ajout', [PortfolioController::class, 'store'])->name('ajout');
    Route::get('/modifier/{id}',[PortfolioController::class, 'edit'])->name('edit');
    Route::put('/modifier/{id}',[PortfolioController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [PortfolioController::class, 'destroy'])->name('delete');
    Route::get('/tableau', [PortfolioController::class, 'tableau'])->name('tableau');


Route::middleware([Admin::class . ':user'])->group(function () {
    Route::get('/dashboad', [PortfolioController::class, 'dashboad'])->name('dashboad');

});