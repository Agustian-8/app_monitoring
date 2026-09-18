<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\VisitController;

// ======================================================
// RUTE PUBLIK (Tanpa Login)
// ======================================================
Route::post('/login', [AuthController::class, 'login']);


// ======================================================
// RUTE PRIVAT (Wajib Login)
// ======================================================
Route::middleware('auth:sanctum')->group(function () {

    // ---------- Auth ----------
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // Route change-password DISIMPAN sebagai cadangan (kebijakan: hanya admin)
    // Kalau perlu diaktifkan, tinggal panggil dari frontend
    Route::post('/change-password', [AuthController::class, 'changePassword']);

    // ---------- Absensi ----------
    Route::post('/attendances',     [AttendanceController::class, 'store']);
    Route::get('/work-today',       [AttendanceController::class, 'todaySchedule']);
    Route::get('/attendance-codes', [AttendanceController::class, 'kodeList']);
    Route::get('/my-stats',         [AttendanceController::class, 'myStats']);
    Route::get('/today-attendance', [AttendanceController::class, 'todayAttendance']);

    // ---------- Kunjungan ----------
    Route::get('/outlets', [VisitController::class, 'getOutlets']);
    Route::post('/visits', [VisitController::class, 'store']);
});