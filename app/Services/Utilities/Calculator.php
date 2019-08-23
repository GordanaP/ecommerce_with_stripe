<?php

namespace App\Services\Utilities;

class Calculator
{
    /**
     * Get a product of two numbers.
     *
     * @param  mixed $a
     * @param  mixed $b
     * @return mixed
     */
    public static function multiply($a, $b)
    {
        return $a * $b;
    }

    /**
     * Get a quotient of two numbers.

     * @param  mixed $a
     * @param  mixed $b
     * @return mixed
     */
    public static function divide($a, $b, $decimals = 2)
    {
        return number_format(($a / $b), $decimals);
    }

    /**
     * Get a sum of two numbers.

     * @param  mixed $a
     * @param  mixed $b
     * @return mixed
     */
    public static function add($a, $b)
    {
        return $a + $b;
    }

    /**
     * Get a difference of two numbers.

     * @param  mixed $a
     * @param  mixed $b
     * @return mixed
     */
    public static function subtract($a, $b)
    {
        return $a - $b;
    }
}