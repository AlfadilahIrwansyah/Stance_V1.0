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

        foreach ($data as $dataUser) {
            dd($dataUser);
            // $found = $dataUser->where('Nama', $Name);
            $userSale[] = $found ? ChartFormatter($found->TotalTrx) : 0;
        }
        $dataUser[] = [
            'name' => 'Sales',
            'data' => $userSale,
        ];

        return $this->chart->linechart()
            ->setTitle('SALES BULANAN')
            ->setSubtitle('Sales / 1000')
            ->setColors(['#FFC107', '#ff2341'])
            ->setFontColor('#ffffff')
            ->setDataset($dataUser)
            ->setXAxis($Name);
    }
}
