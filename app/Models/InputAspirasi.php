<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InputAspirasi extends Model
{
    protected $table = 'input_aspirasi';
    protected $primaryKey = 'id_pelaporan';
    public $incrementing = true;
    
    protected $fillable = [
        'id_pelaporan',
        'nis',
        'id_kategori',
        'lokasi',
        'ket',
    ];

    /**
     * Relasi ke Siswa melalui NIS
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    /**
     * Relasi ke Kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    /**
     * Relasi ke Aspirasi
     */
    public function aspirasi()
    {
        return $this->hasOne(Aspirasi::class, 'id_pelaporan', 'id_pelaporan');
    }
}