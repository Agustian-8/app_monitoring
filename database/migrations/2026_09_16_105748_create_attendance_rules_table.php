<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_rules', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10)->unique();           // S, TL1, CT1, dll
            $table->string('label');                         // Sakit, Terlambat 1-10 menit, dll
            $table->text('penjelasan')->nullable();          // Penjelasan detail dari HRD
            $table->string('kategori', 20);                  // hadir, terlambat, izin, cuti, absen, khusus

            // Denda (0 = tidak ada denda)
            $table->unsignedInteger('denda')->default(0);    // dalam Rupiah

            // Dampak ke upah & tunjangan
            $table->boolean('potong_upah')->default(false);       // upah pokok dipotong?
            $table->boolean('potong_tunjangan')->default(false);  // tunjangan harian dipotong?
            $table->boolean('potong_hak_cuti')->default(false);   // mengurangi kuota cuti tahunan?
            $table->boolean('tetap_dapat_upah')->default(false);  // keterangan tegas: tetap dapat upah?
            $table->boolean('tetap_dapat_tunjangan')->default(false);

            $table->boolean('is_active')->default(true);
            $table->integer('urutan')->default(0);           // urutan tampil di tabel
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_rules');
    }
};