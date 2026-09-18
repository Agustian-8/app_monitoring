<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 'kantor' = karyawan kantor (tidak perlu kunjungan)
            // 'lapangan' = sales/operasional (perlu kunjungan outlet)
            $table->enum('tipe_karyawan', ['kantor', 'lapangan'])
                ->default('kantor')
                ->after('role');

            $table->index('tipe_karyawan');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['tipe_karyawan']);
            $table->dropColumn('tipe_karyawan');
        });
    }
};