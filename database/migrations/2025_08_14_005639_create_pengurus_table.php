<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengurus', function (Blueprint $table) {
        $table->id('id_pengurus');
        // Relasi ke tabel pengaduan
        $table->foreignId('id_pengaduan')
              ->references('id_pengaduan')
              ->on('pengaduan')
              ->onDelete('cascade');
        $table->string('instansi_pemerintahan');
        $table->string('email')->unique();
        $table->string('password');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengurus');
    }
};
