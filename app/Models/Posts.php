<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'title', 'author', 'section', 'message', 'code',
        'likes', 'is_active'
    ];

    protected $dates = [
        'created_at',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section');
    }
}
