<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
        'due_date', 'available_seats', 'comments'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFeed($query)
    {
        return $query->where('due_date', '>', date('Y-m-d H:i:s'))
                     ->orderBy('due_date', 'DESC')
                     ->get();
    }

}
