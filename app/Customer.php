<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function getFullNameAttribute()
    {
        return $this->first_name . ' '. $this->last_name;
    }

    public function getPostalCodeCityAttribute()
    {
        return $this->postal_code . ' '. $this->city;
    }

    public function user()
    {
        return $this->belongsTo(App\User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function placeOrder($order)
    {
        return $this->orders()->save($order);
    }
}
