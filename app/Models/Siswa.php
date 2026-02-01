<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends  Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nis',
        'nama,',
        'kelas',
        'password',
    ];

    protected $hidden = [
        'password',
        'remembertoken',
    ];

        public function setPasswordAttribute($value)
    {
        $this ->attribute['password'] = bcrypt($value);
    }
}
