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
}
