<?php

namespace App\Traits\User;

trait HasAddress
{
    /**
     * Get all the addresses for the user.
     *
     * @return Illuminate\Support\Collection
     */
    public function getAddressBook()
    {
        return $this->shippings
            ->sortBy('default_address')
            ->reverse()
            ->prepend($this->customer);
    }

    /**
     * Get the user's default address.
     *
     * @return Illuminate\Support\Collection
     */
    public function getDefaultAddress()
    {
        return $this->hasDefaultAddress()
            ? $this->findDefaultAddress()->first()
            : $this->customer;
    }

    /**
     * Determine if the address is not a billing address.
     *
     * @param  \Illuminate\Support\Collection  $address
     * @return boolean
     */
    public function isNotBillingAddress($address)
    {
        return $this->customer !== $address;
    }

    /**
     * Determine if the address is a billing address.
     *
     * @param  \Illuminate\Support\Collection  $address
     * @return boolean
     */
    public function isBillingAddress($address)
    {
        return $this->customer == $address;
    }

    /**
     * The user's default address is a shipping address.
     *
     * @return boolean
     */
    public function defaultAddressIsShipping()
    {
        return collect($this->getDefaultAddress())->keys()->contains('customer_id');
    }

    /**
     * Set a new default address.
     *
     * @param \App\Shipping $address null
     */
    public function setNewDefaultAddress($address = null)
    {
        $this->removeOldDefaultAddress();

        optional($address)->setAsDefault();
    }

    /**
     * Remove the user's default address.
     */
    public function removeOldDefaultAddress()
    {
        $this->hasDefaultAddress()
            ? $this->findDefaultAddress()->first()->setAsNonDefault() : '';
    }

    /**
     * Determine if the user has a default shipping address.
     *
     * @return boolean
     */
    public function hasDefaultAddress()
    {
        return $this->findDefaultAddress()->isNotEmpty();
    }

    /**
     * Find the default shipping address.
     *
     * @return \App\Shipping
     */
    private function findDefaultAddress()
    {
        return $this->getAddressBook()->where('default_address', 1);
    }
}