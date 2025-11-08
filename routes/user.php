<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('UserMiddleware')->group(function () {
  Route::get("/user/home", [UserController::class, 'home'])->name('user#home');
  Route::prefix('profile')->group(function () {
    Route::get('view/{id}', [UserController::class, 'viewProfile'])->name('user#profile');
    Route::get('edit/{id}', [UserController::class, 'editProfile'])->name('user#profile#edit');
    Route::post('edit/{id}', [UserController::class, 'updateProfile'])->name('user#profile#update');
  });

  Route::prefix('product')->group(function () {
    Route::get('details/{id}', [UserController::class, 'productDetails'])->name('user#product#details');
    Route::post('comment', [UserController::class, 'comment'])->name('user#product#comment');
    Route::get('comment/delete/{id}', [CommentController::class, 'delete'])->name('comment#delete');
  });
});