<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hasil_pengaduan', function (Blueprint $table) {
            $table->string('lokasi_kejadian', 255)->change(); // Ubah dari 65 ke 255
            $table->decimal('latitude', 10, 8)->nullable()->after('lokasi_kejadian');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
        });
    }

    public function down(): void
    {
        Schema::table('hasil_pengaduan', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']);
            $table->string('lokasi_kejadian', 65)->change();
        });
    }
};