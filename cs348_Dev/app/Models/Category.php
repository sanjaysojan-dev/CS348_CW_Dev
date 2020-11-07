<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Posts()
    {
        return $this->belongsToMany('App\Models\Post', 'category_posts',
            'category_id', 'post_id');
    }
}
