<?php

namespace App\Http\Controllers\Transaction;

use Carbon\Carbon;
use App\Models\RefItem;
use App\Models\SalesTrxH;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesController extends Controller
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
    public function filterDate($query, $yearMonth)
    {
        $year = substr($yearMonth, 0, 4);
        $month = substr($yearMonth, 5, 2);

        return $query->whereYear('transaction_date', $year)
            ->whereMonth('transaction_date', $month);
    }

    public function getOutcome($date = null)
    {
        if ($date !== null) {
            $items = RefItem::filterDate($date)->get();
        } else {
            $items = RefItem::all();
        }
        $outcome = 0;
        foreach ($items as $item) {
            $outcome += $item->SELL_PRICE_AMT * $item->STOCK;
        }

        return $outcome;
    }

    public function getTurnover($date = null)
    {
        if ($date !== null) {
            $items = SalesTrxH::filterDate($date)->get();
        } else {
            $items = SalesTrxH::all();
        }
        $Turnover = 0;
        foreach ($items as $item) {
            $income += $item->TOTAL_TRX_AMT;
        }

        return $Turnover;
    }

    public function getTotalTransactionDetail($date = null)
    {
        if ($date !== null) {
            $items = SalesTrxH::filterDate($date)->get();
        } else {
            $items = SalesTrxH::all();
        }
        $salesTrxH = SalesTrxH::all();
        $TotalSoldItem = $salesTrxH->sum('TOTAL_ITEM');
        $TotalTrx = $salesTrxH->count();

        $dataSales = [
            'TotalTrx' => $TotalTrx,
            'TotalSoldItem' => $TotalSoldItem,
            'OutCome' => $this->getOutcome(),
            'Income' => ($this->getTurnover() - $this->getOutcome()),
        ];

        $salesGridData = [

        ];
        return $dataSales;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showSales(Request $request)
    {
        $datetime = Carbon::now()->format('Y-m');
        $periodStart = $request->input('period_start', $datetime);
        $periodEnd = $request->input('period_end', $datetime);
        $Data = [
        ];
        return view('Transaction.SalesTrx.SalesInfo.SalesInfo', compact('datetime'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showPeronalSales()
    {
        $datetime = Carbon::now()->format('Y-m');
        return view('Transaction.SalesTrx.SalesInfo.SalesPersonal', compact('datetime'));
    }
}
