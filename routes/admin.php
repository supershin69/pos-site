<?php

use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('AdminMiddleware')->prefix('admin')->group(function () {
  Route::get("/home", [AdminDashboard::class, 'dashboard'])->name('admin#home');
  Route::prefix('category')->group(function () {
    Route::get('/list', [CategoryController::class, 'list'])->name('CategoryList');
    Route::post('/create', [CategoryController::class, 'create'])->name('category#create');
    Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
    Route::post('/update/{id}', [CategoryController::class, 'update'])->name(('category#update'));
  });

  Route::prefix('product')->group(function () {
    Route::get('list', [ProductController::class, 'list'])->name('product#list');
    Route::get('/create', [ProductController::class, 'showCreatePage'])->name('product#createForm');
    Route::post('/create', [ProductController::class, 'create'])->name('product#create');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product#editPage');
    Route::post('/edit/{id}', [ProductController::class, 'update'])->name('product#update');
    Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('product#delete');
    Route::get('details/{id}', [ProductController::class, 'detailsPage'])->name('product#details');
  });

  Route::prefix('payment')->group(function () {
    Route::get('list', [PaymentController::class, 'list'])->name('payment#list');
    Route::post('create', [PaymentController::class, 'create'])->name('payment#create');
    Route::get('edit/{id}', [PaymentController::class, 'edit'])->name('payment#edit');
    Route::post('update/{id}', [PaymentController::class, 'update'])->name('payment#update');
    Route::get('delete/{id}', [PaymentController::class, 'delete'])->name('payment#delete');
  });
});

