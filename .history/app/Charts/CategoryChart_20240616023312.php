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
    public function categoryChart($data): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $CategoryNames = collect($data)->pluck('CATEGORY_NAME')->all();

        foreach ($CategoryNames as $item) {

            $found = $data->firstWhere('CATEGORY_NAME', $item);
            $CategorySell[] = $found ? ChartFormatter($found->TOTAL_ITEM_TERJUAL) : 0;
        }

        $DataSelling[] = [
            'name' => 'Item Terjual',
            'data' => $CategorySell,
        ];

        return $this->chart->barChart()
            ->setTitle('Kategori Terjual')
            ->setColors(['#FFC107', '#ff2341'])
            ->setFontColor('#ffffff')
            ->addData('Sales',$CategorySell)
            ->setXAxis($CategoryNames);
    }
}
