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

        foreach ($months as $month) {

            $found = $data->firstWhere('BULAN', $month);
            dd()
            $monthlySales[] = $found ? ChartFormatter($found->TOTAL_OMSET) : 0;
            $monthNames[] =
        }
        $datasets[] = [
            'name' => $monthNames,
            'data' => $monthlySales,
        ];

        return $this->chart->linechart()
            ->setTitle('SALES BULANAN')
            ->setColors(['#FFC107', '#ff2341'])
            ->setFontColor('#ffffff')
            ->setDataset($datasets)
            ->setDataset($datasets)
            ->setXAxis($monthNames);
    }
}
