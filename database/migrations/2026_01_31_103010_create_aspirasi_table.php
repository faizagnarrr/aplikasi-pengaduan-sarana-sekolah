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
        Schema::create('aspirasi', function (Blueprint $table) {
            $table->integer('id_aspirasi', false, true)->lenght(5)->primary();
            $table->unsignedBigInteger('siswa_id');
            $table->integer('id_kategori', false, true)->length(5);
            $table->integer('id_pelaporan', false, true)->length(5);
            $table->enum('status',['Menunguu','Proses','Selesai'])->default('Menunggu');
            $table->integer('feedback', false, true)->length(5)->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');
            $table->foreign('id_pelaporan')->references('id_pelaporan')->on('input_aspirasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasi');
    }
};
