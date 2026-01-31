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
        Schema::create('kategori', function (Blueprint $table) {
            $table->integer('id_kategori', false, true)->length(5)->primary();
            $table->string('ket_kategori', 30);
            $table->timestamps();
            });
        
        // DB::table('kategori')->insert([
        //         [
        //             'id_kategori' => 1,
        //             'ket_kategori' => 'Ruang Kelas',
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ],
        //         [
        //             'id_kategori' => 2,
        //             'ket_kategori' => 'Toilet',
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ],
        //         [
        //             'id_kategori' => 3,
        //             'ket_kategori' => 'Laboratorium',
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ],
        //         [
        //             'id_kategori' => 4,
        //             'ket_kategori' => 'Perpustakaan',
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ],
        //         [
        //             'id_kategori' => 5,
        //             'ket_kategori' => 'Lapangan',
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ],
        //         [
        //             'id_kategori' => 6,
        //             'ket_kategori' => 'Aula',
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ],
        //         [
        //             'id_kategori' => 7,
        //             'ket_kategori' => 'Mushola',
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ],
        //         [
        //             'id_kategori' => 8,
        //             'ket_kategori' => 'Pendopo',
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ],
        //         [
        //             'id_kategori' => 9,
        //             'ket_kategori' => 'Bank Mini',
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ],
        //         [
        //             'id_kategori' => 10,
        //             'ket_kategori' => 'Ruang Tata Usaha',
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ],
        //     ]);
    }
            
            
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori');
    }
};
