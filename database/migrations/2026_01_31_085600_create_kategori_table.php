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
        
        DB::table('kategori')->insert([
                [
                    'id_kategori' => 1,
                    'ket_kategori' => 'Ruang Kelas',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);

    
    
    
    
    
    }
            
            
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori');
    }
};
