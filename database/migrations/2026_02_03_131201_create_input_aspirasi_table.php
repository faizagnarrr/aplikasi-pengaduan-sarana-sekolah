<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('input_aspirasi', function (Blueprint $table) {
            $table->integer('id_pelaporan', false, true)->length(5)->primary();
            $table->string('nis', 10);
            $table->integer('id_kategori', false, true)->length(5);
            $table->string('lokasi', 50);
            $table->string('ket', 50);
            $table->timestamps();
            
            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('input_aspirasi');
    }
};