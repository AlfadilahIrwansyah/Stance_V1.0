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
            $userName[] = $dataUser ? ChartFormatter($dataUser->TotalTrx) : 0;
            $userSale[] = $dataUser ? ChartFormatter($dataUser->TotalTrx) : 0;
        }
        $dataUser[] = [
            'name' => 'Sales',
            'data' => $userSale,
        ];
        dd($dataUser);

        return $this->chart->linechart()
            ->setTitle('SALES BULANAN')
            ->setSubtitle('Sales / 1000')
            ->setColors(['#FFC107', '#ff2341'])
            ->setFontColor('#ffffff')
            ->setDataset($dataUser)
            ->setXAxis($Name);
    }
}
