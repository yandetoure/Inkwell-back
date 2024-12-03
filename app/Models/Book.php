<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'description', 'cover', 'status', 'is_completed', 'author_id',
    ];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}

