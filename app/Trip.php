<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    
    protected $fillable = [ 'user_id', 'post_id', 'place' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
