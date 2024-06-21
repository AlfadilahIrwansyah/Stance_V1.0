<?php

namespace App\Http\Controllers\Transaction;

use Carbon\Carbon;
use App\Models\RefItem;
use App\Models\SalesTrxH;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function getOutcome($date = null)
    {
        if ($date !== null) {
            $items = RefItem::filterDateItem($date)->get();
        } else {
            $items = RefItem::all();
        }
        $outcome = 0;
        foreach ($items as $item) {
            $outcome += $item->BUY_PRICE_AMT * $item->STOCK;
        }

        return $outcome;
    }

    public function getTurnover($date = null)
    {
        if ($date !== null) {
            $items = SalesTrxH::filterDateSales($date)->get();
        } else {
            $items = SalesTrxH::all();
        }
        $Turnover = 0;
        foreach ($items as $item) {
            $Turnover += $item->TOTAL_TRX_AMT;
        }

        return $Turnover;
    }

    public function getTotalTransactionDetail($dateStart = null, $dateEnd = null)
    {
        if ($date !== null) {
            $salesTrxH = SalesTrxH::filterDateSales($dateStart, $dateEnddateEnd)->get();
        } else {
            $salesTrxH = SalesTrxH::all();
        }
        $TotalSoldItem = $salesTrxH->sum('TOTAL_ITEM');
        $TotalTrx = $salesTrxH->count();
        $Income = ($this->getTurnover($date) - $this->getOutcome($date));
        $Outcome = $this->getOutcome($date);

        $dataSales = [
            'TotalTrx' => $TotalTrx,
            'TotalSoldItem' => $TotalSoldItem,
            'OutCome' => $Outcome,
            'Income' => $Income < 0 ? 0 : $Income,
        ];

        $subquery = DB::table('SALES_TRX_H as H')
            ->join('SALES_TRX_D as D', 'H.SALES_TRX_H_ID', '=', 'D.SALES_TRX_H_ID')
            ->join('REF_ITEM as RI', 'D.REF_ITEM_ID', '=', 'RI.REF_ITEM_ID')
            ->selectRaw('MONTH(H.TRX_DATE) as BULAN, H.TOTAL_TRX_AMT as TOTAL_OMSET, COUNT(1) as TRANSAKSI, SUM(D.ITEM_AMT * RI.BUY_PRICE_AMT) as KEUNTUNGAN')
            ->whereRaw('')
            ->groupBy('H.TOTAL_TRX_AMT', 'H.TRX_DATE', 'D.ITEM_AMT', 'RI.BUY_PRICE_AMT');

        $dataGrid = DB::table(DB::raw("({$subquery->toSql()}) as Y"))
            ->mergeBindings($subquery)
            ->select('Y.BULAN', 'Y.TOTAL_OMSET', DB::raw('SUM(Y.TRANSAKSI) as TOTAL_TRANSAKSI'), DB::raw('SUM(Y.KEUNTUNGAN) as TOTAL_KEUNTUNGAN'))
            ->groupBy('Y.BULAN', 'Y.TOTAL_OMSET')
            ->get();

        $salesGridData = [
            'Summary' => $dataSales,
            'Details' => $dataGrid
        ];
        return $salesGridData;
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
        dd($this->getTotalTransactionDetail($datetime));
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
