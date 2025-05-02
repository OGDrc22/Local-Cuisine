<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    protected $table = 'rating';
    protected $fillable = ['user_id', 'book_id', 'stars_rated'];
}
