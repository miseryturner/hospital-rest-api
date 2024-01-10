<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'patronymic',
        'mobile',
        'password',
        'policy',
        'birthday',
        'gender',
        'address',
    ];

    protected $hidden = [
        'password',
        'token',
    ];

    protected $casts = [
        'password' => 'hashed'
    ];
}
