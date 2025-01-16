<?php

use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register',[PassportAuthController::class, 'register']);
Route::post('login',[PassportAuthController::class, 'login']);

Route::middleware(['auth:api'])->group(function() {
  Route::get('userInfo', [PassportAuthController::class, 'userInfo']);
  Route::resource('products', ProductController::class);
});
