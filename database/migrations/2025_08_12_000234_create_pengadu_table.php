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
        Schema::create('pengadu', function (Blueprint $table) {
            $table->id('id_pengadu'); // Auto increment
            $table->string('nik', 16)->unique();
            $table->string('nama_pengadu', 100);
            $table->text('alamat');
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->string('no_telp', 20);
            $table->string('email')->unique();
            $table->string('password'); // password akan di-hash
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengadu');
    }
};
