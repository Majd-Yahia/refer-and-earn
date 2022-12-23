<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth'])->group(function() {
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
});

Route::get('login', [LoginController::class, 'login_page'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.store');

Route::get('register', [LoginController::class, 'register_page'])->middleware('referal')->name('register');
Route::post('register', [LoginController::class, 'register'])->name('register.store');
