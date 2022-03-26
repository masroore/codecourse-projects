<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDownloadController;
use App\Http\Controllers\WebhookController;
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

Route::get('/', HomeController::class)->name('home');

Route::get('/products/{product:slug}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('/products/downloads/{product:slug}', [ProductDownloadController::class, 'show'])
    ->name('products.downloads.show');

Route::post('/cart/products', [CartProductController::class, 'store'])
    ->name('cart.products.store');

Route::delete('/cart/products/{product:slug}', [CartProductController::class, 'destroy'])
    ->name('cart.products.destroy');

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout.index');

Route::get('/orders', [OrderController::class, 'index'])
    ->name('orders.index');

Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook']);

require __DIR__ . '/auth.php';
