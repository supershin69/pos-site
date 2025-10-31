<?php

use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware('AdminMiddleware')->prefix('admin')->group(function() {
  Route::get("/home", [AdminDashboard::class, 'dashboard'])->name('admin#home');
  Route::prefix('category')->group(function() {
    Route::get('/list', [CategoryController::class, 'list'])->name('CategoryList');
    Route::post('/create', [CategoryController::class, 'create'])->name('category#create');
  });
});

