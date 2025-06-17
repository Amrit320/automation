<?php

use Illuminate\Http\Request;
use App\Models\Submission;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/submissions', function () {
    return Submission::all();
});
