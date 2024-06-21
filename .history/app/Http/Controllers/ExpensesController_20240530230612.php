<?php

namespace App\Http\Controllers;

use App\Charts\Barchart;
use App\Models\SalesData;
use App\Charts\LinesChart;
use App\Charts\HoriBarchart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpensesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Barchart $Barchart, LinesChart $Linechart, HoriBarchart $horiBarchart, Request $request)
    {
        $selectedMonth = request('month', 'all');
        $selectedItem = request('item_name', 'all');
        $selectedItemGrid = request('item_grid', 'all');
        $salesData = DB::table('SALES_TRX_H')
            ->join('SALES_TRX_D', 'SALES_TRX_H.SALES_TRX_H_ID', '=', 'SALES_TRX_D.SALES_TRX_H_ID')
            ->join('REF_ITEM', )
            ->select('sales_data.*', 'ref_item.item_name')
            ->getQuery();
        if ($selectedMonth != 'all')
            $salesData->whereRaw('MONTH(date_sale) = ?', $selectedMonth);
        if ($selectedItemGrid != 'all')
            $salesData->whereRaw('item_name = ?', $selectedItemGrid);
        // dd($salesData);
        $salesData = $salesData
            ->orderBy('date_sale')
            ->orderBy('ref_item.item_name')
            ->get();
        return view('expense.expense', [
            'chart' => [
                'barchart' => $Barchart->build(),
                'linechart' => $Linechart->build(),
                'HoriBarchart' => $horiBarchart->build(),
            ],
            'itemName' => $Linechart->getItemName(),
            'salesMonth' => $Barchart->getSaleMonth(),
            'selectedMonth' => $selectedMonth,
            'selectedItem' => $selectedItem,
            'selectedItemGrid' => $selectedItemGrid,
            'salesData' => $salesData,
        ]);
    }
}
