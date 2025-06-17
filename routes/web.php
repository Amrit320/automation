<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\admin\Createwebinar;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\AdminAuthController;

Route::view('/', 'welcome');

// User submission form (public)
Route::get('/form', [SubmissionController::class, 'create'])->name('submission.form');
Route::post('/form', [SubmissionController::class, 'store'])->name('submission.store');

// Admin authentication
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Protected admin routes
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {

    // Webinar CRUD
    Route::resource('createwebinar', Createwebinar::class);

    // User listing & import
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/import-users', [UserController::class, 'import'])->name('users.import');
});
