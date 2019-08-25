<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'street_address', 'postal_code', 'city',
        'country', 'phone'
    ];

    /**
     * Deteremine if the addresd is default.
     *
     * @return boolean
     */
    public function getIsDefaultAttribute()
    {
        return $this->default_address == true;
    }

    /**
     * Get the customer that owns the shipping.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the customer that owns the shipping.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the shipping from a form.
     *
     * @param  array $data
     * @return \App\Shipping
     */
    public static function fromData(array $data)
    {
        return (new static)->fill($data);
    }
}
