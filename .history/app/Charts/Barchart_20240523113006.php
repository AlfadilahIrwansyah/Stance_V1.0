<?php

namespace App\Charts;

use DateTime;
use App\Models\SalesData;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class Barchart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $selectedMonth = request('month');
        $selectedItemGrid = request('item_grid');
        $monthName = 'All Month';
        $ItemName = 'All Items';
        $chart = $this->chart->barChart();

        $query = DB::table('sales_data')
            ->join('ref_item', 'sales_data.ref_item_id', '=', 'ref_item.ref_item_id')
            ->select(
                'ref_item.item_name',
                DB::raw('SUM(amount) as total_sales'),
                DB::raw('MONTH(date_sale) as month')
            )
            ->groupBy('ref_item.item_name', DB::raw('MONTH(date_sale)'));

        if ($selectedMonth && $selectedMonth != 'all') {
            $query->whereRaw('MONTH(date_sale) = ?', [$selectedMonth]);
            $dateObj = DateTime::createFromFormat('!m', $selectedMonth);
            $monthName = $dateObj->format('F');
        }
        if ($selectedItemGrid && $selectedItemGrid != 'all') {
            $query->whereRaw('item_name = ?', [$selectedItemGrid]);
            $ItemName = $selectedItemGrid;
        }

        $salesData = $query
            ->orderBy('month')
            ->orderBy('ref_item.item_name')
            ->get();

        $itemSalesData = $salesData->groupBy('item_name');
        $months = $salesData->pluck('month')->unique()->sort()->values();
        $monthNames = collect($months)->map(function ($month) {
            return Carbon::createFromFormat('m', $month)->format('F');
        })->all();
        $chart->setXAxis($monthNames);

        foreach ($itemSalesData as $item => $data) {
            $monthlySales = [];
            foreach ($months as $month) {
                $monthData = $data->firstWhere('month', $month);
                $monthlySales[] = $monthData ? $monthData->total_sales : 0;
            }

            $chart->addData($item, $monthlySales);
        }


        return $chart
            ->setTitle('Item Sales on ' . $monthName)
            ->setSubtitle($ItemName);
    }


    public function buildHomeLinechart(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $monthName = 'All Month';
        $chart = $this->chart->linechart();

        $query = DB::table('SALES_TRX_H')
            ->join('SALES_TRX_D', 'SALES_TRX_H.SALES_TRX_H_ID', '=', 'SALES_TRX_D.SALES_TRX_H_ID')
            ->selectRaw('YEAR(TRX_DATE) as year, MONTH(TRX_DATE) as month, SUM(amount) as total_sales');

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
                $monthlySales[] = $found ? $found->total_sales : 0;
            }

            $datasets[] = [
                'name' => "Sales $year",
                'data' => $monthlySales
            ];
        }

        $chart->setXAxis($monthNames);
        $chart->setDataset($datasets);
        return $chart
            ->setTitle('Item Sales')
            ->setSubtitle($monthName);
    }
    public function getSaleMonth()
    {
        $salesMonth = SalesData::select(DB::raw("DISTINCT DATENAME(MONTH, date_sale) as month_name, MONTH(date_sale) as month_number"))
            ->orderBy('month_number')
            ->get();

        return $salesMonth;
    }
}
