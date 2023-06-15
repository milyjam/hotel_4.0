<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\QuartoController;
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
Route::group(['middleware' => 'check.user.type'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin', [HotelController::class, 'indexAdmin'])->name('admin.hoteis');
    Route::get('/hoteis/show/{id}', [HotelController::class, 'show'])->name('hoteis.show');
    Route::put('/hoteis/create/', [HotelController::class, 'store'])->name('hoteis.create');
    Route::put('/hoteis/edit/{id}', [HotelController::class, 'edit'])->name('hoteis.edit');
    Route::delete('/hoteis/destroy/{id}', [HotelController::class, 'destroy'])->name('hoteis.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/hoteis', [HotelController::class, 'index'])->name('hoteis.index');
    Route::get('/', [HotelController::class, 'index'])->name('hoteis.index');
    Route::get('/hoteis/busca', [HotelController::class, 'busca']);
    Route::get('/quartos/{hotelId}', [QuartoController::class, 'getQuartos']);
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/quartos', [QuartoController::class, 'index'])->name('quartos.index');

});

Route::middleware(['guest'])->group(function () {
    //Login
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login']);
    //Google Login
    Route::get('/login/google', [GoogleController::class, 'redirectToGoogle']);
    Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback']);
});