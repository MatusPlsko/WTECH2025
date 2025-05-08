<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// App\Models\User.php
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'email',
        'password',

        'is_admin', // aj keď ho nastavíš defaultne, môžeš ho mať tu
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
