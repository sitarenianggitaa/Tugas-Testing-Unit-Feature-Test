<?php

namespace App\Helpers;

class SquareCalculatorHelper
{
    public static function calculate($number): float
    {
        if (!is_numeric($number)) {
            throw new \InvalidArgumentException("Input harus berupa angka");
        }

        return (float)$number * (float)$number;
    }
}