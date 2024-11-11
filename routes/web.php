<?php

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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resources([
    'payee'=>PayController::class,
    'user'=> UserController::class,
    'mpesa'=>MpesaController::class,
    'payment'=>PaymentController::class
]);
Route::get('/payment/save', [PaymentController::class, 'save']);