<?php

namespace App\Http\Controllers\Transaction;

use Carbon\Carbon;
use App\Models\RefItem;
use App\Models\SalesTrxH;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

    private function getOutcome($dateStart = null, $dateEnd = null)
    {
        if ($dateStart !== null && $dateEnd !== null) {
            $items = RefItem::filterDateRange($dateStart, $dateEnd)->get();
        } else {
            $items = RefItem::all();
        }
        $outcome = 0;
        foreach ($items as $item) {
            $outcome += $item->BUY_PRICE_AMT * $item->STOCK;
        }

        return $outcome;
    }

    private function getTotalTransactionDetail($dateStart = null, $dateEnd = null)
    {
        $subquery = DB::table('SALES_TRX_H as H')
            ->join('SALES_TRX_D as D', 'H.SALES_TRX_H_ID', '=', 'D.SALES_TRX_H_ID')
            ->join('REF_ITEM as RI', 'D.REF_ITEM_ID', '=', 'RI.REF_ITEM_ID')
            ->selectRaw('MONTH(H.TRX_DATE) as BULAN, SUM(H.TOTAL_TRX_AMT) as TOTAL_OMSET, COUNT(1) as TRANSAKSI, SUM((D.ITEM_AMT * RI.SELL_PRICE_AMT) - (D.ITEM_AMT * RI.BUY_PRICE_AMT)) as KEUNTUNGAN, TRX_DATE')
            ->groupBy('H.TOTAL_TRX_AMT', 'H.TRX_DATE', 'D.ITEM_AMT', 'RI.SELL_PRICE_AMT', 'TRX_DATE', 'RI.BUY_PRICE_AMT');

        $dataGrid = DB::table(DB::raw("({$subquery->toSql()}) as Y"))
            ->mergeBindings($subquery)
            ->select('Y.BULAN', 'Y.TOTAL_OMSET', DB::raw('SUM(Y.TRANSAKSI) as TOTAL_TRANSAKSI'), DB::raw('SUM(Y.KEUNTUNGAN) as TOTAL_KEUNTUNGAN'));
        $Outcome = 0;
        if ($dateStart !== null && $dateEnd !== null) {
            $startYear = substr($dateStart, 0, 4);
            $startMonth = substr($dateStart, 5, 2);

            $endYear = substr($dateEnd, 0, 4);
            $endMonth = substr($dateEnd, 5, 2);
            $Outcome = $this->getOutcome($dateStart, $dateEnd);
            $dataGrid->whereRaw(
                '(MONTH(TRX_DATE) >= ? AND YEAR(TRX_DATE) = ?) AND (MONTH(TRX_DATE) <= ? AND YEAR(TRX_DATE) = ?)',
                [$startMonth, $startYear, $endMonth, $endYear]
            );
        } else {
            $Outcome = $this->getOutcome();
        }
        $dataGrid->groupBy('Y.BULAN', 'Y.TOTAL_OMSET')
            ->orderBy('Y.BULAN');
        $TotalDetails = $dataGrid->get();
        $Income = 0;
        foreach ($TotalDetails as $Omzet) {
            $Income += $Omzet->TOTAL_OMSET;
        }
        $Surplus = $Income - $Outcome;
        $dataSales = [
            'TotalTrx' => $dataGrid->count(),
            'TotalSoldItem' => $dataGrid->count(),
            'Income' => $Income,
            'Outcome' => $Surplus,
        ];
        $salesGridData = [
            'Summary' => $dataSales,
            'Details' => $TotalDetails
        ];
        return $salesGridData;
    }

    private function getCategorySold()
    {

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
        $periodStart = request('period-start', $datetime);
        $periodEnd = request('period-end', $datetime);
        $dataView = $this->getTotalTransactionDetail($periodStart, $periodEnd);
        return view('Transaction.SalesTrx.SalesInfo.SalesInfo', ['datetime', 'dataView' => $dataView, 'periodStart' => $periodStart, 'periodEnd' => $periodEnd]);
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
