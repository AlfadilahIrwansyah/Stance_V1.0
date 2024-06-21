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
            ->join('REF_ITEM', 'SALES_TRX_D.REF_ITEM_ID', '=', 'REF_ITEM.REF_ITEM_ID')
            ->selectRaw('SALES_TRX_D.*, REF_ITEM.ITEM_NAME, TRX_DATE', 'TRX_DATE');
        if ($selectedMonth != 'all')
            $salesData->whereRaw('MONTH(TRX_DATE) = ?', $selectedMonth);
        if ($selectedItemGrid != 'all')
            $salesData->whereRaw('ITEM_NAME = ?', $selectedItemGrid);
        // dd($salesData);
        $salesData = $salesData
            ->orderBy('TRX_DATE')
            ->orderBy('REF_ITEM.ITEM_NAME')
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
