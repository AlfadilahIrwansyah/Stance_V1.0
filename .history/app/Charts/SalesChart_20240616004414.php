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
        // foreach ($data as $data) {
        //     $monthlySales = [];
        //     foreach ($data as $month) {
        //         $found = $data->firstWhere('month', $month);
        //         $monthlySales[] = $found ? ChartFormatter($found->total_sales) : 0;
        //     }


        //     $datasets[] = [
        //         'name' => "Sales Amount / 1000",
        //         'data' => $monthlySales
        //     ];
        // }
        dd($monthNames);

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
