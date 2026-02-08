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
        'ket_kategori',
    ];

    // ==========================================
    // KONSTANTA KATEGORI FIXED
    // ==========================================
    const RUANG_KELAS = 1;
    const TOILET = 2;
    const LABORATORIUM = 3;
    const PERPUSTAKAAN = 4;
    const LAPANGAN = 5;
    const KANTIN = 6;
    const LAINNYA = 7;

    const KATEGORI_NAMES = [
        self::RUANG_KELAS => 'Ruang Kelas',
        self::TOILET => 'Toilet',
        self::LABORATORIUM => 'Laboratorium',
        self::PERPUSTAKAAN => 'Perpustakaan',
        self::LAPANGAN => 'Lapangan',
        self::KANTIN => 'Kantin',
        self::LAINNYA => 'Lainnya',
    ];

    // ==========================================
    // RELASI
    // ==========================================
    public function aspirasi()
    {
        return $this->hasMany(Aspirasi::class, 'id_kategori', 'id_kategori');
    }

    public function inputAspirasi()
    {
        return $this->hasMany(InputAspirasi::class, 'id_kategori', 'id_kategori');
    }

    // ==========================================
    // HELPER METHODS - PENTING!
    // ==========================================
    
    /**
     * Mendapatkan nama kategori berdasarkan ID
     */
    public static function getNameById($id_kategori)
    {
        return self::KATEGORI_NAMES[$id_kategori] ?? null;
    }

    /**
     * Mendapatkan semua kategori sebagai array
     */
    public static function getAllAsArray()
    {
        return self::KATEGORI_NAMES;
    }

    /**
     * Validasi apakah ID kategori valid
     * METHOD INI YANG SERING ERROR JIKA TIDAK ADA!
     */
    public static function isValidId($id_kategori)
    {
        return array_key_exists($id_kategori, self::KATEGORI_NAMES);
    }

    /**
     * Get icon emoji untuk kategori
     */
    public function getIconAttribute()
    {
        $icons = [
            self::RUANG_KELAS => '🏫',
            self::TOILET => '🚽',
            self::LABORATORIUM => '🔬',
            self::PERPUSTAKAAN => '📚',
            self::LAPANGAN => '⚽',
            self::KANTIN => '🍽️',
            self::LAINNYA => '📍',
        ];
        return $icons[$this->id_kategori] ?? '📋';
    }

    /**
     * Get warna untuk badge
     */
    public function getColorAttribute()
    {
        $colors = [
            self::RUANG_KELAS => 'blue',
            self::TOILET => 'purple',
            self::LABORATORIUM => 'green',
            self::PERPUSTAKAAN => 'indigo',
            self::LAPANGAN => 'yellow',
            self::KANTIN => 'orange',
            self::LAINNYA => 'gray',
        ];
        return $colors[$this->id_kategori] ?? 'gray';
    }

    /**
     * Scope untuk count aspirasi
     */
    public function scopeWithAspirasiCount($query)
    {
        return $query->withCount('aspirasi');
    }

    /**
     * Prevent deletion
     */
    protected static function boot()
    {
        parent::boot();
        
        static::deleting(function ($kategori) {
            throw new \Exception('Kategori tidak dapat dihapus karena bersifat fixed.');
        });
    }
}