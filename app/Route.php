<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
 
    protected $appends = [ 'items' ];
    protected $fillable = [ 'name' ];
    protected $relations = [ 'items' ];

    public function items()
    {
        return $this->hasMany(RouteItem::class);
    }

    public function getItemsAttribute()
    {
        return $this->items()->get()->keyBy('index');
    }

}
