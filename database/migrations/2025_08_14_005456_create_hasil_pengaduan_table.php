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
        Schema::create('hasil_pengaduan', function (Blueprint $table) {
        $table->id('id_hasil');

        // Relasi ke tabel pengadu
        $table->foreignId('id_pengadu')
              ->references('id_pengadu')
              ->on('pengadu')
              ->onDelete('cascade');

        // Relasi ke tabel pengaduan
        $table->foreignId('id_pengaduan')
              ->references('id_pengaduan')
              ->on('pengaduan')
              ->onDelete('cascade');

        $table->string('kabupaten_kota');
        $table->string('bukti_foto')->nullable();
        $table->string('status');
        $table->text('deskripsi')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_pengaduan');
    }
};
