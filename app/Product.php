<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Get price_in_dollars attribute.
     *
     * @return string
     */
    public function getPriceInDollarsAttribute()
    {
        return Str::presentInDollars($this->price_in_cents);
    }

    /**
     * Get the orders that belong to the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->as('from_cart')
            ->withPivot('quantity', 'price_in_cents');
    }
}
