<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class bookuser extends Authenticatable
{
    protected $table = 'bookuser';
    protected $fillable = ['username', 'email', 'password', 'user_type', 'chefs_level'];
    protected $hidden = ['password'];
}
