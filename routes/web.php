<?php

use Illuminate\Support\Facades\Route;

// Halaman Login Sales
Route::get('/', function () {
    return view('mobile.login');
});

// Halaman Utama Sales (Absen & Kunjungan)
Route::get('/app', function () {
    return view('mobile.app');
});