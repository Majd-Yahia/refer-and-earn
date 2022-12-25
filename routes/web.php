<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
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


Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/clients', [HomeController::class, 'clients'])->name('clients');

    Route::middleware(['can:admin.show'])->group(function () {
        Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
        Route::patch('/users/{id}', [UsersController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UsersController::class, 'delete'])->name('users.delete');

        Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
    });


    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('login', [LoginController::class, 'login_page'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.store');

Route::get('register', [LoginController::class, 'register_page'])->middleware('referal')->name('register');
Route::post('register', [LoginController::class, 'register'])->name('register.store');
