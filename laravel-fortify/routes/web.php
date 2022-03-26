<?php

use App\Http\Controllers\AccountDeletionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', DashboardController::class)->name('dashboard');

Route::get('profile', ProfileController::class)->name('profile');
Route::get('auth/password', PasswordController::class)->name('auth.password');

Route::get('auth/delete', [AccountDeletionController::class, 'index'])->name('auth.delete');
Route::post('auth/delete', [AccountDeletionController::class, 'destroy']);

Route::get('auth/twofactor', TwoFactorController::class)->name('auth.twofactor');
