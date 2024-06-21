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

class Barchart extends LarapexChart
{
    protected $chart;
    // protected $dataLabels = 'enabled';
    // protected $theme = 'dark';

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function buildExpenseChart(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $selectedMonth = request('month');
        $selectedItemGrid = request('item_grid');
        $monthName = 'All Month';
        $ItemName = 'All Items';
        $chart = $this->chart->barChart();

        $query = DB::table('SALES_TRX_H')
            ->join('SALES_TRX_D', 'SALES_TRX_H.SALES_TRX_H_ID', '=', 'SALES_TRX_D.SALES_TRX_H_ID')
            ->join('REF_ITEM', 'SALES_TRX_D.REF_ITEM_ID', '=', 'REF_ITEM.REF_ITEM_ID')
            ->select(
                'REF_ITEM.ITEM_NAME',
                'TOTAL_PRICE_AMT',
                DB::raw('MONTH(TRX_DATE) as month')
            )
            ->groupBy('REF_ITEM.ITEM_NAME', DB::raw('MONTH(TRX_DATE)'), 'TOTAL_PRICE_AMT');

        if ($selectedMonth && $selectedMonth != 'all') {
            $query->whereRaw('MONTH(TRX_DATE) = ?', [$selectedMonth]);
            $dateObj = DateTime::createFromFormat('!m', $selectedMonth);
            $monthName = $dateObj->format('F');
        }
        if ($selectedItemGrid && $selectedItemGrid != 'all') {
            $query->whereRaw('ITEM_NAME = ?', [$selectedItemGrid]);
            $ItemName = $selectedItemGrid;
        }

        $salesData = $query
            ->orderBy('month')
            ->orderBy('REF_ITEM.ITEM_NAME')
            ->get();

        $itemSalesData = $salesData->groupBy('ITEM_NAME');
        $months = $salesData->pluck('month')->unique()->sort()->values();
        $monthNames = collect($months)->map(function ($month) {
            return Carbon::createFromFormat('m', $month)->format('F');
        })->all();
        $chart->setXAxis($monthNames);
        $chart->setDataLabels(false)
            ->setGrid('#000000', 0.1)
            ->setFontColor('#ffffff')
            ->setColors(
                [
                    '#db1604',
                ]
            );

        foreach ($itemSalesData as $item => $data) {
            $monthlySales = [];
            foreach ($months as $month) {
                $monthData = $data->firstWhere('month', $month);
                $monthlySales[] = $monthData ? $monthData->TOTAL_PRICE_AMT : 0;
            }

            $chart->addData($item, $monthlySales);
        }


        return $chart
            ->setTitle('Item Sales on ' . $monthName)
            ->setSubtitle($ItemName);
    }




    public function buildHomeLinechart(bool $isDark): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $chart = $this->chart->linechart();

        $query = DB::table('SALES_TRX_H')
            ->join('SALES_TRX_D', 'SALES_TRX_H.SALES_TRX_H_ID', '=', 'SALES_TRX_D.SALES_TRX_H_ID')
            ->selectRaw('YEAR(TRX_DATE) as year, MONTH(TRX_DATE) as month, SUM(TOTAL_TRX_AMT) as total_sales')
            ->groupBy('TRX_DATE');

        $salesData = $query
            ->orderby('year')
            ->orderBy('month')
            ->get();

        $salesByYear = $salesData->groupBy('year');
        $datasets = [];

        $months = $salesData->pluck('month')->unique()->sort()->values();
        $monthNames = collect($months)->map(function ($month) {
            return Carbon::createFromFormat('m', $month)->format('F');
        })->all();

        foreach ($salesByYear as $year => $data) {
            $monthlySales = [];
            foreach ($months as $month) {
                $found = $data->firstWhere('month', $month);
                $monthlySales[] = $found ? ChartFormatter($found->total_sales) : 0;
            }


            $datasets[] = [
                'name' => "Sales Amount / 1000",
                'data' => $monthlySales,
            ];
        }

        $chart->setXAxis($monthNames);
        $chart->setDataset($datasets);
        $chart->setDataLabels(false)
            ->setGrid('#000000', 0.1)
            ->setFontColor('#ffffff')
            ->setColors(
                [
                    '#db1604',
                ]
            );


        return $chart
            ->setTitle('Transaction Amount')
            ->setSubtitle('Sales Amount/1000');
    }
    public function getSaleMonth()
    {
        $salesMonth = SalesTrxH::select(DB::raw("DISTINCT DATENAME(MONTH, TRX_DATE) as month_name, MONTH(TRX_DATE) as month_number"))
            ->orderBy('month_number')
            ->get();

        return $salesMonth;
    }
}
