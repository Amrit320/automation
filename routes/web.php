<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\admin\Createwebinar;
use App\Http\Controllers\admin\UserController;

Route::view('/', 'welcome');

// User submission form (public)
Route::get('/form', [SubmissionController::class, 'create'])->name('submission.form');
Route::post('/form', [SubmissionController::class, 'store'])->name('submission.store');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {

    // Webinar CRUD
    Route::resource('createwebinar', Createwebinar::class);

    // User listing & import
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/import-users', [UserController::class, 'import'])->name('users.import');
});
