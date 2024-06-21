<?php

namespace App\Charts;

use App\Models\SalesTrxH;
use DateTime;
use DOMDocument;
use App\Models\SalesData;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\JsExpression;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class CategoryChart extends LarapexChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }
    public function categoryChart($data): \ArielMejiaDev\LarapexCharts\LineChart
    {
        dd($data);
        $CategoryNames = collect($data)->pluck('CATEGORY_NAME')->all();

        foreach ($CategoryNames as $item) {

            $found = $data->firstWhere('BULAN', $item);
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
}
