<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            // Kode absensi (H, S, DLK, CT1/2, CT1, TL1, TL2, TL3, GA, IZ1/2, IZ1, MK, CTK)
            // Nullable karena data lama belum ada kode
            $table->string('kode_absen', 10)->nullable()->after('status');

            // Index biar filter cepat
            $table->index('kode_absen');
        });
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropIndex(['kode_absen']);
            $table->dropColumn('kode_absen');
        });
    }
};