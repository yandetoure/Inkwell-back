<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = [
        'title', 'content', 'status', 'likes_count', 'views_count', 'book_id',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}

