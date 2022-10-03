<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
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



// Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('is_admin');
    Route::get('/changePassword/{id}', [AdminUserController::class, 'createChangePassword'])
        ->name('admin.changePassword');
    Route::put('/updatePassword/{id}', [AdminUserController::class, 'updateChangePassword'])
        ->name('admin.updatePassword');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
