<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\VisitController;

// Rute Publik
Route::post('/login', [AuthController::class, 'login']);

// Rute Privat
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // ---------- Absensi ----------
    Route::post('/attendances',    [AttendanceController::class, 'store']);
    Route::get('/work-today',      [AttendanceController::class, 'todaySchedule']);
    Route::get('/attendance-codes', [AttendanceController::class, 'kodeList']); // 👈 BARU

    // ---------- Kunjungan ----------
    Route::get('/outlets', [VisitController::class, 'getOutlets']);
    Route::post('/visits', [VisitController::class, 'store']);
});