<?php
namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class UserSalesChart extends LarapexChart
{

    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }
    public function UserChart($data)
    {

        $Name = collect($data)->pluck('Nama')->all();

        // $monthNames = collect($months)->map(function ($month) {
        //     return MonthIndo($month);
        // })->all();

        foreach ($data as $dataUser) {

            $found = $dataUser->firstWhere('Nama', $Name);
            $userSale[] = $found ? ChartFormatter($found->TotalTrx) : 0;
        }
        // $dataOmset[] = [
        //     'name' => 'Sales',
        //     'data' => $monthlySales,
        // ];
        // $dataOmset[] = [
        //     'name' => 'Surplus',
        //     'data' => $monthlySurplus,
        // ];
        $dataUser[] = [

        ];
        dd($data);

        return $this->chart->linechart()
            ->setTitle('SALES BULANAN')
            ->setSubtitle('Sales / 1000')
            ->setColors(['#FFC107', '#ff2341'])
            ->setFontColor('#ffffff')
            ->setDataset($dataOmset)
            ->setXAxis($monthNames);
    }
}
