<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function post(){
        return $this->belongsTo('App\Models\Post','post_id');
    }
    public function creator(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
