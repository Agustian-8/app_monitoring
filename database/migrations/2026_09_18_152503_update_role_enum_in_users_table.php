<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Update data lama dulu: sales → karyawan
        DB::table('users')
            ->where('role', 'sales')
            ->update(['role' => 'karyawan']);

        // 2. Ubah enum role
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'karyawan'])
                ->default('karyawan')
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'sales'])
                ->default('sales')
                ->change();
        });
    }
};