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

if (!function_exists('generateTrxNo')) {
    function generateTrxNo($prefix = 'TRX')
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
        $formatted = number_format($amount, 2, '.', ',');
        if ($currency) {
            return "Rp {$formatted}";
        }
        return "{$formatted}";
    }
}

if (!function_exists('ChartFormatter')) {
    function ChartFormatter($amount)
    {
        $formatted = $amount / 1000;
        if ($formatted <= 1000)
            return "{$amount}";
        return "{$formatted}";
    }
}

if (!function_exists('DateFormatter')) {
    function DateFormatter($date)
    {
        if (!($date instanceof \DateTime)) {
            try {
                $date = new \DateTime($date);
            } catch (\Exception $e) {
                return '';
            }
        }

        $monthNames = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        // Format the date as 'dd-mm-yyyy'
        $day = $date->format('d');
        $month = $monthNames[(int) $date->format('m')];
        $year = $date->format('Y');

        return "{$day} {$month} {$year}";
    }
}

if (!function_exists('MonthIndo')) {
    function MonthIndo($date)
    {
        if (!($date instanceof \DateTime)) {
            try {
                $date = new \DateTime($date);
            } catch (\Exception $e) {
                return '';
            }
        }

        $monthNames = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $month = $monthNames[(int) $date->format('m')];
        dd()
        return "$month";
    }
}


