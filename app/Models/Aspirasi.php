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

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
    
    public function kategori()
    {
        return $this->belongsTo(Siswa::class, 'id_kategori', 'id_kategori');
    }
    
    public function inputAspirasi()
    {
        return $this->belongsTo(InputAspirasi::class, 'id_pelapporan', 'id_pelaporan');
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
