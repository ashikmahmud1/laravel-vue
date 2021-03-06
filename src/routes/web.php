<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentMethodController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('billing', [BillingController::class, 'index'])->name('billing');
    Route::get('checkout/{plan_id}', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::get('cancel', [BillingController::class, 'cancel'])->name('cancel');
    Route::get('resume', [BillingController::class, 'resume'])->name('resume');

    Route::get('payment-methods/default/{methodId}', [PaymentMethodController::class, 'markDefault'])->name('payment-methods.markDefault');

    Route::resource('payment-methods', PaymentMethodController::class);
});
