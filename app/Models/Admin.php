<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';

    protected $fillable = [
        'username',
        'password',
        'nama'
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
