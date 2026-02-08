<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;


class Siswa extends Authenticatable
{
    use Notifiable;

    protected $table = 'siswa';
    
    
    protected $fillable = [
        'nis',
        'nama',
        'kelas',
        'password',
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
    ];

   
    protected function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Relasi one-to-many dengan tabel aspirasi
     * Satu siswa dapat memiliki banyak aspirasi/pengaduan
     */
    public function aspirasi()
    {
        return $this->hasMany(Aspirasi::class, 'siswa_id');
    }

    /**
     * Relasi one-to-many dengan tabel input_aspirasi
     * Untuk melihat detail laporan yang dibuat siswa
     */
    public function inputAspirasi()
    {
        return $this->hasMany(InputAspirasi::class, 'nis', 'nis');
    }
}