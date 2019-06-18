<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'sapo','slug', 'content', 'image', 'category_id', 'user_id'
    ];

    public function getRouteKeyName() {
        return 'slug';
    }
}
