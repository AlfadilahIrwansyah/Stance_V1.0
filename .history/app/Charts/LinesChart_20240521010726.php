<?php

namespace App\Charts;

use App\Models\SalesData;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class LinesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $selectedItem = request('item_name');
        $query = DB::table('sales_data')
            ->join('ref_item', 'sales_data.ref_item_id', '=', 'ref_item.ref_item_id')
            ->select(
                'ref_item.item_name',
                DB::raw('SUM(amount) as total_sales'),
                DB::raw('MONTH(date_sale) as month')
            )
            ->groupBy('item_name', DB::raw('MONTH(date_sale)'));

        // if ($selectedMonth && $selectedMonth != '') {
        //     $query->whereRaw('MONTH(date_sale) = ?', [$selectedMonth]);
        // }
        if ($selectedItem && $selectedItem != 'all') {
            $query->where('ref_item.item_name', [$selectedItem]);
        }
        $salesData = $query
            ->orderBy('month')
            ->orderBy('ref_item.item_name')
            ->get();
        $chart = $this->chart->LineChart();

        $itemSalesData = $salesData->groupBy('item_name');
        $months = $salesData->pluck('month')->unique()->sort()->values()->all();

        foreach ($itemSalesData as $item => $data) {
            $monthlySales = [];
            foreach ($months as $month) {
                $monthData = $data->firstWhere('month', $month);
                $monthlySales[] = $monthData ? $monthData->total_sales : 0;
            }

            $chart->addData($item, $monthlySales);
        }
        $chart->setXAxis($months);

        return $chart
            ->setTitle('Item Sales.')
            ->setSubtitle('PC VS TV');
    }

    public function getItemName()
    {

        $selectedMonth = request('month');
        $query = SalesData::SalesData::with('ref_item')
            ->join('ref_item', 'sales_data.ref_item_id', '=', 'ref_item.ref_item_id')
            ->select
        if ($selectedMonth && $selectedMonth != 'all') {
            $query->whereRaw('MONTH(date_sale) = ?', [$selectedMonth]);
        }
        $itemName = $query->get();
        return $itemName;
    }
}
