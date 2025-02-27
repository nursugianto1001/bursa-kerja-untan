<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobVacanciesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Group route untuk Auth (Tanpa Middleware)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json([
        'user' => $request->user(),
    ]);
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');  // Registrasi Admin & Alumni
    Route::post('/login', 'login');        // Login Admin & Alumni
});

// Group route yang membutuhkan autentikasi Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);   // Mendapatkan data user yang sedang login
    Route::post('/logout', [AuthController::class, 'logout']); // Logout user
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/job', [JobVacanciesController::class, 'index']); // Melihat semua lowongan kerja yang sudah disetujui
    Route::get('/job/{id}', [JobVacanciesController::class, 'show']); // Melihat detail lowongan kerja

    Route::post('/job', [JobVacanciesController::class, 'store']); // Admin menambahkan lowongan kerja
    Route::patch('/job/{id}/status', [JobVacanciesController::class, 'updateStatus']); // Admin menyetujui/menolak lowongan
    Route::delete('/job/{id}', [JobVacanciesController::class, 'destroy']); // Admin menghapus lowongan kerja
});

