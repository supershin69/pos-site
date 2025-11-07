<?php

use App\Http\Controllers\AdminDashboard;

Route::middleware('SuperAdminMiddleware')->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('create-admins', [AdminDashboard::class, 'admin_creation_page'])->name('create-admins');
    Route::post('create-admins', [AdminDashboard::class, 'create_admin'])->name('create-new-admin');
    Route::get('delete/users/{id}', [AdminDashboard::class, 'deleteUser'])->name('user#delete');
});