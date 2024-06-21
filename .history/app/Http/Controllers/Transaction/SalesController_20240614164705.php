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

    public function getOutcome($dateStart = null, $dateEnd = null)
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

    public function getTurnover($dateStart = null, $dateEnd = null)
    {
        if ($dateStart !== null && $dateEnd !== null) {
            $items = SalesTrxH::filterDateRange($dateStart, $dateEnd)->get();
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
        

        $dataGrid = DB::table(DB::raw("({$subquery->toSql()}) as Y"))
            ->mergeBindings($subquery)
            ->select('Y.BULAN', 'Y.TOTAL_OMSET', DB::raw('SUM(Y.TRANSAKSI) as TOTAL_TRANSAKSI'), DB::raw('SUM(Y.KEUNTUNGAN) as TOTAL_KEUNTUNGAN'), DB::raw('SUM(Y.PENGELUARAN) as TOTAL_PENGELUARAN'));

        if ($dateStart !== null && $dateEnd !== null) {
            $startYear = substr($dateStart, 0, 4);
            $startMonth = substr($dateStart, 5, 2);

            $endYear = substr($dateEnd, 0, 4);
            $endMonth = substr($dateEnd, 5, 2);
            $dataGrid->whereRaw(
                '(MONTH(TRX_DATE) >= ? AND YEAR(TRX_DATE) = ?) OR (MONTH(TRX_DATE) <= ? AND YEAR(TRX_DATE) = ?) OR (YEAR(TRX_DATE) BETWEEN ? AND ?)',
                [$startMonth, $startYear, $endMonth, $endYear, $startYear, $endYear]
            );
        }
        $dataGrid->groupBy('Y.BULAN', 'Y.TOTAL_OMSET')
            ->orderBy('Y.BULAN')
            ->get();

        $dataSales = [
            'TotalTrx' => $dataGrid->count(),
            'TotalSoldItem' => $dataGrid->count(),
            'Income' => $dataGrid->sum('TOTAL_OMSET'),
            'Outcome' => $dataGrid->sum('PENGELUARAN')
        ];
        dd($dataSales);
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
        $dataView = $this->getTotalTransactionDetail($periodStart, $periodEnd);
        // dd($dataView['Summary']);
        return view('Transaction.SalesTrx.SalesInfo.SalesInfo', compact('datetime', 'dataView'));
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
