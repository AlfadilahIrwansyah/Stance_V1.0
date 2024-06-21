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

        $userName [] = []

        foreach ($data as $dataUser) {
            $found = collect($data)->firstWhere('Nama', $dataUser['Nama']);
            $userName[] = $found ? $found['Nama'] : '';
            $userSale[] = $found ? ChartFormatter($found['TotalTrx']) : 0;
        }
        $SalesUser[] = [
            'name' => $userName,
            'data' => $userSale,
        ];

        return $this->chart->Barchart()
            ->setTitle('SALES BULANAN')
            ->setSubtitle('Sales / 1000')
            ->setColors(['#FFC107', '#ff2341'])
            ->setFontColor('#ffffff')
            ->setDataset($SalesUser)
            ->setXAxis($Name);
    }
}
