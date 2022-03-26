<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\EpisodeController;
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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/articles/{article:slug}', ArticleController::class);
Route::get('/episodes/{episode:slug}', EpisodeController::class);

require __DIR__ . '/auth.php';
