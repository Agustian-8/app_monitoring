<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_settings', function (Blueprint $table) {
            $table->id();
            // 0 = Minggu, 1 = Senin, ..., 6 = Sabtu (mengikuti Carbon dayOfWeek)
            $table->unsignedTinyInteger('day_of_week')->unique();
            $table->string('day_name'); // "Senin", "Selasa", dst
            $table->time('jam_masuk')->nullable();   // null = libur
            $table->time('jam_pulang')->nullable();
            $table->unsignedInteger('toleransi_telat')->default(15); // menit
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_settings');
    }
};