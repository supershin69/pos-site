<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('UserMiddleware')->group(function () {
  Route::get("/user/home", [UserController::class, 'home'])->name('user#home');
});