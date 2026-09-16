<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('outlet_id')->constrained('outlets')->cascadeOnDelete();
            
            // Kolom untuk menyimpan path foto
            $table->string('photo_path');
            
            // Kolom untuk kordinat GPS (pakai decimal agar akurat)
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            
            // Catatan tambahan dari sales (opsional)
            $table->text('notes')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};