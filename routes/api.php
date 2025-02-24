<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthAlumniController;

Route::post('/admin/register', [AuthAdminController::class, 'register']);
Route::post('/admin/login', [AuthAdminController::class, 'login']);

Route::post('/alumni/register', [AuthAlumniController::class, 'register']);
Route::post('/alumni/login', [AuthAlumniController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/admin/logout', [AuthAdminController::class, 'logout']);
    Route::post('/alumni/logout', [AuthAlumniController::class, 'logout']);
});
