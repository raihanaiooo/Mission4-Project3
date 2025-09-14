<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'USER_ID';

    public $timestamps = true;

    protected $fillable = [
        'USERNAME',
        'PASSWORD',
        'ROLE',
        'FULL_NAME',
    ];

    protected $hidden = [
        'PASSWORD',
    ];

    public function getAuthPassword()
    {
        return $this->PASSWORD;
    }

    public function getAuthIdentifierName()
    {
        return 'USERNAME';
    }

    public function setPASSWORDAttribute($value)
    {
        if ($value && Hash::needsRehash($value)) {
            $this->attributes['PASSWORD'] = Hash::make($value);
        } else {
            $this->attributes['PASSWORD'] = $value;
        }
    }

    public function isAdmin()
    {
        return $this->ROLE === 'admin';
    }
}
