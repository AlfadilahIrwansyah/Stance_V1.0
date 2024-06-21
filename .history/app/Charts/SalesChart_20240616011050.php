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
            $filteredData = $data->filter(function ($item) use ($month) {
                return $item->BULAN == $month;
            });

            $monthlySales = $filteredData->pluck('TOTAL_OMSET')->all();

            $datasets[] = [
                'name' => "Sales Amount / 1000",
                'data' => $monthlySales,
            ];
        }

        return $this->chart->linechart()
            ->setTitle('Los Angeles vs Miami.')
            ->setSubtitle('Wins during season 2021.')
            ->setColors(['#FFC107', '#D32F2F'])
            ->setFontColor('#ffffff')
            ->setDataset($datasets)
            ->setXAxis($monthNames)
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
    }
}
