<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->string('tipe_absen')->default('Masuk')->after('user_id'); // Masuk / Pulang
            $table->string('photo_path')->nullable()->after('status'); // Foto Selfie
        });
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn(['tipe_absen', 'photo_path']);
        });
    }
};