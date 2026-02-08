<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $table = 'aspirasi';
    protected $primaryKey = 'id_aspirasi';
    public $incrementing = true;
    
    protected $fillable = [
        'id_aspirasi',
        'siswa_id',
        'id_kategori',
        'id_pelaporan',
        'status',
        'feedback',
    ];

    /**
     * Relasi ke Siswa
     * KUNCI: foreign_key 'siswa_id' di tabel aspirasi → 'id' di tabel siswa
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    /**
     * Relasi ke Kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    /**
     * Relasi ke InputAspirasi
     */
    public function inputAspirasi()
    {
        return $this->belongsTo(InputAspirasi::class, 'id_pelaporan', 'id_pelaporan');
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByKategori($query, $idKategori)
    {
        return $query->where('id_kategori', $idKategori);
    }
}