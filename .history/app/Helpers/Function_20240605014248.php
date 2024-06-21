<?php

use Illuminate\Support\Str;
use PhpParser\Node\Expr\AssignOp\Concat;

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
    function format_currency($amount, $currency = false)
    {
        if (condition) {
            # code...
        }
        $formatted = number_format($amount, 2, '.', ',');
        return "Rp {$formatted}";
    }
}

if (!function_exists('ChartFormatter')) {
    function ChartFormatter($amount)
    {
        $formatted = $amount/1000;
        if($formatted <= 1000)
            return "{$amount}";
        return "{$formatted}";
    }
}
