<?php

use Illuminate\Support\Str;

if (!function_exists('generateCustomUniqueCode')) {
    function generateCustomUniqueCode($prefix = 'PRE')
    {
        $year = now()->year;
        $random = Str::upper(Str::random(6));
        $date = now()->format('dmy');

        return "{$prefix}{$year}{$random}{$date}";
    }
}

if (!function_exists('format_currency')) {
    function format_currency($amount)
    {
        return( 'Rp' number_format($amount, 2, '.', ','));
    }
}
