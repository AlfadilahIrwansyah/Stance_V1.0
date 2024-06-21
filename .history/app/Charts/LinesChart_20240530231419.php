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
        $query = DB::table('SALES_TRX_H')
            ->join('SALES_TRX_D', 'SALES_TRX_H.SALES_TRX_H_ID', '=', 'SALES_TRX_D.SALES_TRX_H_ID')
            ->join('REF_ITEM', 'SALES_TRX_D.REF_ITEM_ID', '=', 'REF_ITEM.REF_ITEM_ID')
            ->select(
                'REF_ITEM.ITEM_NAME',
                'TOTAL_TRX_AMT',
                DB::raw('MONTH(TRX_DATE) as month')
            )
            ->groupBy('REF_ITEM.ITEM_NAME', DB::raw('MONTH(TRX_DATE)'), 'TOTAL_TRX_AMT');

        // if ($selectedMonth && $selectedMonth != '') {
        //     $query->whereRaw('MONTH(date_sale) = ?', [$selectedMonth]);
        // }
        if ($selectedItem && $selectedItem != 'all') {
            $query->where('REF_ITEM.ITEM_NAME', [$selectedItem]);
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
        $query = SalesData::with('ref_item')
            ->join('ref_item', 'sales_data.ref_item_id', '=', 'ref_item.ref_item_id')
            ->select(DB::RAW(("DISTINCT item_name")));
        if ($selectedMonth && $selectedMonth != 'all') {
            $query->whereRaw('MONTH(date_sale) = ?', [$selectedMonth]);
        }
        $itemName = $query->get();
        return $itemName;
    }
}
