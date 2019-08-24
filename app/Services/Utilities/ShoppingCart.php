<?php

namespace App\Services\Utilities;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use App\Services\Utilities\CartItem;

class ShoppingCart extends Collection
{
    /**
     * Get a shopping cart stored in a session.
     *
     * @return Illuminate\Support\Collection
     */
    public static function fromSession()
    {
        return session('cart', new self);
    }

    /**
     * Add a product with a quantity to the cart.
     *
     * @param \App\Product  $product
     * @param integer $quantity
     */
    public function add($product, $quantity = 1)
    {
        $totalQuantity = $this->getTotalQuantity($product, $quantity);

        $this->put($product->id, CartItem::fromProductAndQuantity($product, $totalQuantity));

        $this->save();
    }

    /**
     * Update the cart item's quantity.
     *
     * @param  \App\Product $product
     * @param  integer $quantity
     */
    public function update($product, $quantity)
    {
        $this->put($product->id, CartItem::fromProductAndQuantity($product, $quantity));

        $this->save();
    }

    /**
     * Remove an item from the cart.
     *
     * @param  integer $productId
     */
    public function remove($productId)
    {
        $this->forget($productId);

        $this->save();
    }

    /**
     * Remove all items from the cart.
     */
    public function destroy()
    {
        session()->forget('cart');
    }

    /**
     * Present the cart's total in dollars.
     *
     * @return  string
     */
    public function presentTotal()
    {
        return Str::presentInDollars($this->getTotalInCents());
    }

    /**
     * Present the cart's shipping costs in dollars.
     *
     * @return string
     */
    public function presentShippingCosts()
    {
        return Str::presentInDollars($this->getShippingCostsInCents());
    }

    /**
     * Present the cart's tax amount in dollars.
     *
     * @return string
     */
    public function presentTaxAmount()
    {
        return Str::presentInDollars($this->getTaxAmountInCents());
    }

    /**
     * Present the tax rate.
     *
     * @return  string
     */
    public function presentTaxRate()
    {
        return Str::presentAsPercent(config('cart.tax_rate'));
    }

    /**
     * Present the cart's subtotal in dollars.
     *
     * @return string
     */
    public function presentSubtotal()
    {
        return Str::presentInDollars($this->getSubtotalInCents());
    }

    /**
     * Determine if there is any item in the cart.
     *
     * @return boolean
     */
    public function isEmpty()
    {
        return $this->sum('quantity') == 0;
    }

    /**
     * Get the order summary
     *
     * @return illuminate\Support\Collection
     */
    public function getSummary()
    {
        return collect([
            'subtotal_in_cents' => $this->getSubtotalInCents(),
            'tax_amount_in_cents' => $this->getTaxAmountInCents(),
            'shipping_costs_in_cents' => $this->getShippingCostsInCents(),
            'total_in_cents' => $this->getTotalInCents(),
        ]);
    }

    /**
     * Calculate the cart's total in cents.
     *
     * @return integer
     */
    public function getTotalInCents()
    {
        return collect([
            $this->getSubtotalInCents(),
            $this->getTaxAmountInCents(),
            $this->getShippingCostsInCents(),
        ])->sum();
    }

    /**
     * Calculate the cart's shipping costs in cents.
     *
     * @return integer
     */
    public function getShippingCostsInCents()
    {
        $shippingCosts = Calculator::multiply($this->getSubtotalInCents(), 0.1);

        return round($shippingCosts);
    }

    /**
     * Calculate the cart's tax amount in cents.
     *
     * @return integer
     */
    public function getTaxAmountInCents()
    {
        $taxAmount = Calculator::multiply($this->getSubtotalInCents(), config('cart.tax_rate'));

        return round($taxAmount);
    }

    /**
     * Calculate the cart's subtotal in cents.
     *
     * @return integer
     */
    public function getSubtotalInCents()
    {
        return $this->sum('subtotal_in_cents');
    }

    /**
     * Get cart items.
     *
     * @return Illuminate\Support\Collection
     */
    public function getItems()
    {
        return $this->values();
    }

    /**
     * Update the cart's content;
     *
     * @return \Illuminate\Support\Collection
     */
    private function save()
    {
        return session()->put('cart', $this);
    }

    /**
     * Calculate the cart item's total quantity.
     *
     * @param  \App\Product $product
     * @param  integer $quantity
     * @return integer
     */
    private function getTotalQuantity($product, $quantity)
    {
        return $quantity + $this->getInCartQuantity($product);
    }

    /**
     * Get the cart item's quantity already in cart.
     *
     * @param  \App\Product $product
     * @return integer
     */
    private function getInCartQuantity($product)
    {
        return optional($this->get($product->id))->quantity ?? 0;
    }
}