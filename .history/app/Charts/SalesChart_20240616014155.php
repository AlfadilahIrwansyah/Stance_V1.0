<?php

namespace App\Charts;

use Carbon\Carbon;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class SalesChart
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

        foreach ($months as $month) {

            $found = $data->firstWhere('BULAN', $month);
            $monthlySales[] = $found ? ChartFormatter($found->TOTAL_OMSET) : 0;
            $monthlySurplus[] = $found ? ChartFormatter($found->KEUNTUNGAN) : 0;
        }
        $dataOmset[] = [
            'name' => 'Sales',
            'data' => $monthlySales,
        ];
        $dataOmset[] = [
            'name' => 'Surplus',
            'data' => $monthlySurplus,
        ];

        return $this->chart->linechart()
            ->setTitle('SALES BULANAN')
            ->setSubtitle('Sales / 1000')
            ->setColors(['#FFC107', '#ff2341'])
            ->setFontColor('#ffffff')
            ->setDataset($dataOmset)
            ->setDataset($dataOmset)
            ->setXAxis($monthNames);
    }
    public function CategoryChart($data): \ArielMejiaDev\LarapexCharts\LineChart
    {
        // $months = collect($data)->pluck('BULAN')->all();

        // $monthNames = collect($months)->map(function ($month) {
        //     return MonthIndo($month);
        // })->all();

        // foreach ($months as $month) {

        //     $found = $data->firstWhere('BULAN', $month);
        //     $monthlySales[] = $found ? ChartFormatter($found->TOTAL_OMSET) : 0;
        //     $monthlySurplus[] = $found ? ChartFormatter($found->KEUNTUNGAN) : 0;
        // }
        // $dataOmset[] = [
        //     'name' => 'Sales',
        //     'data' => $monthlySales,
        // ];
        // $dataOmset[] = [
        //     'name' => 'Surplus',
        //     'data' => $monthlySurplus,
        // ];

        // return $this->chart->linechart()
        //     ->setTitle('SALES BULANAN')
        //     ->setSubtitle('Sales / 1000')
        //     ->setColors(['#FFC107', '#ff2341'])
        //     ->setFontColor('#ffffff')
        //     ->setDataset($dataOmset)
        //     ->setDataset($dataOmset)
        //     ->setXAxis($monthNames);
        return $this->chart->horizontalBarChart()
            ->setTitle('Los Angeles vs Miami.')
            ->setSubtitle('Wins during season 2021.')
            ->setColors(['#FFC107', '#D32F2F'])
            ->addData('San Francisco', [6, 9, 3, 4, 10, 8])
            ->addData('Boston', [7, 3, 8, 2, 6, 4])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
    }
}
