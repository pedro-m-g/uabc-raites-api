<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
        'due_date', 'available_seats', 'comments',
        'vehicle_id', 'route_id'
    ];

    protected $hidden = [
        'vehicle_id', 'route_id'
    ];

    protected $appends = [
        'vehicle', 'route'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function scopePassengers($query)
    {
        $sql = 'SELECT users.*, trips.user_id FROM users JOIN trips ON trips.user_id = users.id AND trips.post_id = :post_id';
        return \DB::select($sql, [ 'post_id' => $this->id ]);
    }

    public function scopeFeed($query)
    {
        return $query->where('due_date', '>', date('Y-m-d H:i:s'))
                     ->orderBy('due_date', 'DESC')
                     ->get();
    }

    public function getVehicleAttribute()
    {
        return $this->vehicle()->get()->first();
    }

    public function getRouteAttribute()
    {
        return $this->route()->get()->first();
    }

}
