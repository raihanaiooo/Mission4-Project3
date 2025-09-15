<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'USERS';
    protected $primaryKey = 'USER_ID';

    public $timestamps = true;

    protected $fillable = [
        'USERNAME',
        'PASSWORD',
        'ROLE',
        'FULL_NAME',
        'PROFILE_IMAGE',
    ];

    protected $hidden = [
        'PASSWORD',
    ];

    public function getAuthPassword()
    {
        return $this->PASSWORD;
    }

    // Method untuk mengatur username
    public function getAuthIdentifierName()
    {
        return 'USERNAME';
    }

    // Method untuk mengatur password
    public function setPASSWORDAttribute($value)
    {
        if ($value && Hash::needsRehash($value)) {
            $this->attributes['PASSWORD'] = Hash::make($value);
        } else {
            $this->attributes['PASSWORD'] = $value;
        }
    }

    // Method untuk memeriksa apakah pengguna adalah admin
    public function isAdmin()
    {
        return $this->ROLE === 'admin';
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'USER_ID', 'USER_ID');
    }

    public function takes()
    {
        return $this->hasManyThrough(
            Take::class,
            Student::class,
            'USER_ID',      // FK di STUDENTS ke USERS
            'STUDENT_ID',   // FK di TAKES ke STUDENTS
            'USER_ID',      // PK di USERS
            'STUDENT_ID'    // PK di STUDENTS
        );
    }

    // Courses lewat student
    public function courses()
    {
        return $this->takes()->with('course');
    }

}