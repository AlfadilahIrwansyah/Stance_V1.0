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
            $income += $item->TOTAL_TRX_AMT;
        }

        return $Turnover;
    }

    public function getTotalTransactionDetail($date = null)
    {
        if ($date !== null) {
            $salesTrxH = SalesTrxH::filterDateSales($date)->get();
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

        $dataGrid = SalesTrxH::selectRaw('MONTH(TRX_DATE) as BULAN, TOTAL_OMSET, COUNT(1) as TRANSAKSI, (ITEM_AMT * BUY_PRICE_AMT) as KEUNTUNGAN')
            ->join('sales_trx_d', 'sales_trx_h.sales_trx_h_id', '=', 'sales_trx_d.sales_trx_h_id')
            ->join('ref_item', 'sales_trx_d.ref_item_id', '=', 'ref_item.ref_item_id')
            ->groupBy('TOTAL_TRX_AMT', 'TRX_DATE', 'ITEM_AMT', 'BUY_PRICE_AMT')
            ->selectSub(function ($query) {
                $query->from('sales_trx_h')
                    ->join('sales_trx_d', 'sales_trx_h.sales_trx_h_id', '=', 'sales_trx_d.sales_trx_h_id')
                    ->join('ref_item', 'sales_trx_d.ref_item_id', '=', 'ref_item.ref_item_id')
                    ->groupBy('TOTAL_TRX_AMT', 'TRX_DATE', 'ITEM_AMT', 'BUY_PRICE_AMT')
                    ->selectRaw('MONTH(TRX_DATE) as BULAN, TOTAL_TRX_AMT AS TOTAL_OMSET, COUNT(1) as TRANSAKSI, (ITEM_AMT * BUY_PRICE_AMT) as KEUNTUNGAN');
            }, 'Y')
            ->groupBy('BULAN', 'TOTAL_OMSET')
            ->select('BULAN', 'TOTAL_OMSET', DB::raw('SUM(TRANSAKSI) as TOTAL_TRANSAKSI'), DB::raw('SUM(KEUNTUNGAN) as TOTAL_KEUNTUNGAN'))
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
