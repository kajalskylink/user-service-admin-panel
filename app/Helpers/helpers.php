<?php


if (!function_exists('money')) {
    function money($amount)
    {
        $amount = (float) $amount;
        return '৳ ' . number_format($amount, 2);
    }
}
