<?php

use Illuminate\Support\Facades\Route;

Route::middleware('UserMiddleware')->group(function() {
  Route::get("/user/home", function() {
    return view('user.dashboard.home');
  })->name('user#home');
});