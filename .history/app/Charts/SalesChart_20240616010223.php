<?php

namespace App\Charts;

use Carbon\Carbon;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class SalesChart extends LarapexChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function SalesChart($data): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $months = collect($data)->pluck('BULAN')->all();
        $monthNames = collect($months)->map(function ($month) {
            return MonthIndo($month);
        })->all();

        $datasets = [];

        foreach ($data as $item) {
            $monthlySales = [];
            foreach ($months as $month) {
                if ($item->BULAN == $month) {
                    $monthlySales[] = $item->TOTAL_OMSET; // Assuming TOTAL_OMSET is the sales amount
                } else {
                    $monthlySales[] = 0; // If no data found for the month, set to 0
                }
            }

            $datasets[] = [
                'name' => "Sales Amount / 1000", // Example name
                'data' => $monthlySales,
            ];
        }

        dd($datasets);

        return $this->chart->linechart()
            ->setTitle('Los Angeles vs Miami.')
            ->setSubtitle('Wins during season 2021.')
            ->setColors(['#FFC107', '#D32F2F'])
            ->setFontColor('#ffffff')
            ->addData('San Francisco', [6, 9, 3, 4, 10, 8])
            ->addData('Boston', [7, 3, 8, 2, 6, 4])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
    }
}
