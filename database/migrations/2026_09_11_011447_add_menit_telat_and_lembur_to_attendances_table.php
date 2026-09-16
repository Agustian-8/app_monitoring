<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->unsignedInteger('menit_telat')->default(0)->after('notes');
            $table->unsignedInteger('menit_lembur')->default(0)->after('menit_telat');
            $table->string('keterangan_telat')->nullable()->after('menit_lembur');
        });
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn(['menit_telat', 'menit_lembur', 'keterangan_telat']);
        });
    }
};