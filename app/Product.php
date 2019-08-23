<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function getPriceInDollarsAttribute()
    {
        return Str::presentInDollars($this->price_in_cents);
    }
}
