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
