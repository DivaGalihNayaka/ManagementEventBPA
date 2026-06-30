<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration (tambahkan kolom baru).
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom baru dan membolehkan nilainya kosong (nullable)
            $table->string('phone')->nullable();
            $table->string('department')->nullable();
            $table->string('profile_photo')->nullable();
        });
    }

    /**
     * Batalkan migration (hapus kolom jika di-rollback).
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'department', 'profile_photo']);
        });
    }
};