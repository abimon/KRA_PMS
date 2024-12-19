<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get("/logout", function () {
    Auth::logout();
    return redirect("/");
});
Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resources([
        'payee' => PayController::class,
        'user' => UserController::class,
        'mpesa' => MpesaController::class,
        'payment' => PaymentController::class
    ]);
});
Route::get('/payments/save', [PaymentController::class, 'save']);
Route::get('/profile/{id}',[UserController::class, 'show'])->middleware('auth');
Route::get('/returnform', [PayController::class, 'formpr']);