<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    public $incrementing = true;

    protected $fillable = [
        'id_kategori',
        'kategori',
    ];

    const RUANG_KELAS = 1;
    const TOILET = 2;
    const LABORATORIUM = 3;
    const PERPUSTAKAAN = 4;
    const LAPANGAN = 5;
    const AULA = 6;
    const MUSHOLA = 7;
    const PENDOPO = 8;
    const BANK_MINI = 9;
    const RUANG_TATA_USAHA = 10;

    const KATEGORI_NAMES = [
        self::RUANG_KELAS => 'Ruang Kelas',
        self::TOILET => 'Toilet',
        self::LABORATORIUM => 'Laboratorium',
        self::PERPUSTAKAAN => 'Perpustakaan',
        self::LAPANGAN => 'Lapangan',
        self::AULA => 'Aula',
        self::MUSHOLA => 'Mushola',
        self::PENDOPO => 'Pendopo',
        self::BANK_MINI => 'Bank Mini',
        self::RUANG_TATA_USAHA => 'Ruang Tata Usaha',
    ];

    public function aspirasi()
    {
        return $this -> hasMany(Aspirasi::class, 'id_kategori', 'id_kategori');
        }
        
    public function inputAspirasi()
    {
        return $this -> hasMany(InputAspirasi::class, 'id_kategori', 'id_kategori');
    }   
    
}
