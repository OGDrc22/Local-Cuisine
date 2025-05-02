<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\bookuser;


class BookComment extends Model
{
    protected $table = 'book_comments';
    protected $fillable = ['user_id', 'book_id', 'comment', 'parent_id'];

    public function parent() {
        return $this->belongsTo(BookComment::class, 'parent_id');
    }

    // Child replies
    public function replies() {
        return $this->hasMany(BookComment::class, 'parent_id')->with('replies'); // recursive
    }

    public function user() {
        return $this->belongsTo(bookuser::class, 'user_id', 'id');
    }
}
