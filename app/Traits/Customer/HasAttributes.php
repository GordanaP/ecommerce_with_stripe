<?php

namespace App\Traits\Customer;

trait HasAttributes
{
    /**
     * Get the customers's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' .$this->last_name;
    }

    /**
     * Get the customers's city along with the postal code.
     *
     * @return string
     */
    public function getZipAndCityAttribute()
    {
        return $this->postal_code . ' ' .$this->city;
    }

    /**
     * Set the customers's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucwords(strtolower($value));
    }

    /**
     * Set the customers's last name.
     *
     * @param  string  $value
     * @return void
     */
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucwords(strtolower($value));
    }

    /**
     * Set the customers's street address.
     *
     * @param  string  $value
     * @return void
     */
    public function setStreetAddressAttribute($value)
    {
        $this->attributes['street_address'] = ucwords(strtolower($value));
    }

    /**
     * Set the customers's city.
     *
     * @param  string  $value
     * @return void
     */
    public function setCityAttribute($value)
    {
        $this->attributes['city'] = ucwords(strtolower($value));
    }
}