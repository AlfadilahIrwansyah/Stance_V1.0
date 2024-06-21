<?php

namespace App\Http\Controllers\Transaction;

use Carbon\Carbon;
use App\Models\RefItem;
use App\Models\SalesTrxH;
use App\Charts\SalesChart;
use Illuminate\Http\Request;
use App\Charts\CategoryChart;
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
            ->selectRaw('MONTH(H.TRX_DATE) as BULAN, SUM(D.TOTAL_PRICE_AMT) as TOTAL_OMSET, COUNT(1) as TRANSAKSI, SUM((D.ITEM_AMT * RI.SELL_PRICE_AMT) - (D.ITEM_AMT * RI.BUY_PRICE_AMT)) as KEUNTUNGAN, SUM(ITEM_AMT) AS TOTAL_ITEM, TRX_DATE')
            ->groupBy('H.TRX_DATE');

        $dataGrid = DB::table(DB::raw("({$subquery->toSql()}) as Y"))
            ->mergeBindings($subquery)
            ->select('Y.BULAN', 'Y.TOTAL_OMSET', DB::raw('SUM(Y.TRANSAKSI) as TOTAL_TRANSAKSI'), 'KEUNTUNGAN', 'TOTAL_ITEM');

        $Outcome = 0;
        if ($dateStart !== null && $dateEnd !== null) {
            $startYear = substr($dateStart, 0, 4);
            $startMonth = substr($dateStart, 5, 2);

            $endYear = substr($dateEnd, 0, 4);
            $endMonth = substr($dateEnd, 5, 2);
            $Outcome = $this->getOutcome($dateStart, $dateEnd);
            $dataGrid->whereRaw(
                'MONTH(TRX_DATE) BETWEEN ? AND ? AND YEAR(TRX_DATE) BETWEEN ? AND ?',
                [$startMonth, $endMonth, $startYear, $endYear]
            );
        } else {
            $Outcome = $this->getOutcome();
        }
        $dataGrid
            ->groupBy('Y.BULAN', 'Y.TOTAL_OMSET', 'TOTAL_ITEM', 'KEUNTUNGAN')
            ->orderBy('Y.BULAN');

        $totalDetails = $dataGrid->get();
        $Income = 0;

        foreach ($totalDetails as $Omzet) {
            $Income += $Omzet->TOTAL_OMSET;
        }
        $Surplus = $Income - $Outcome;
        $dataSales = [
            'TotalTrx' => $totalDetails->sum('TOTAL_TRANSAKSI'),
            'TotalSoldItem' => $totalDetails->SUM('TOTAL_ITEM'),
            'Income' => $Income,
            'Outcome' => $Surplus,
        ];
        $salesGridData = [
            'Summary' => $dataSales,
            'Details' => $totalDetails
        ];
        return $salesGridData;
    }

    private function getCategorySold($dateStart = null, $dateEnd = null)
    {

        $subQuery = DB::table('SALES_TRX_D as STD')
            ->join('SALES_TRX_H as STH', 'STH.SALES_TRX_H_ID', '=', 'STD.SALES_TRX_H_ID')
            ->join('REF_ITEM as RI', 'RI.REF_ITEM_ID', '=', 'STD.REF_ITEM_ID')
            ->select(
                'RI.REF_CATEGORY_ID',
                DB::raw('SUM(STD.ITEM_AMT) AS TOTAL_ITEM_TERJUAL'),
                DB::raw('SUM(STD.TOTAL_PRICE_AMT) AS JUMMLAH_NOMINAL_TERJUAL'),
                'STH.TRX_DATE'
            )
            ->groupBy('RI.REF_CATEGORY_ID', 'STH.TRX_DATE');

        if ($dateStart !== null && $dateEnd !== null) {
            $startYear = substr($dateStart, 0, 4);
            $startMonth = substr($dateStart, 5, 2);

            $endYear = substr($dateEnd, 0, 4);
            $endMonth = substr($dateEnd, 5, 2);
            $subQuery->whereRaw(
                '(MONTH(TRX_DATE) BETWEEN ? AND ?) AND (YEAR(TRX_DATE) BETWEEN ? AND ?)',
                [$startMonth, $endMonth, $startYear, $endYear]
            );
        }

        $CategoryDataSold = DB::table('REF_ITEM as RI')
            ->join('REF_CATEGORY as RC', 'RI.REF_CATEGORY_ID', '=', 'RC.REF_CATEGORY_ID')
            ->joinSub(
                $subQuery,
                'IC',
                function ($join) {
                    $join->on('IC.REF_CATEGORY_ID', '=', 'RC.REF_CATEGORY_ID');
                }
            )
            ->selectRaw('RC.CATEGORY_NAME, SUM(IC.TOTAL_ITEM_TERJUAL) AS TOTAL_ITEM_TERJUAL, SUM(IC.JUMMLAH_NOMINAL_TERJUAL) AS JUMMLAH_NOMINAL_TERJUAL')
            ->groupBy('RC.CATEGORY_NAME')
            ->get();
        return $CategoryDataSold;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showSales(SalesChart $salesChart, CategoryChart $CategoryChart)
    {
        $categoryView = $this->getCategorySold();
        $datetime = Carbon::now()->format('Y-m');
        $dataView = $this->getTotalTransactionDetail();
        $salesChart = $salesChart->SalesChart($dataView['Details']);
        $CategoryChart = $CategoryChart->CategoryChart($categoryView);
        return view('Transaction.SalesTrx.SalesInfo.SalesInfo', compact('datetime', 'dataView', 'categoryView', 'salesChart', 'CategoryChart'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showSalesFiltered(SalesChart $salesChart, CategoryChart $CategoryChart, Request $request)
    {
        $datetime = Carbon::now()->format('Y-m');
        $periodStart = $request->input('periodStart', $datetime);
        $periodEnd = $request->input('periodEnd', $datetime);
        $dataView = $this->getTotalTransactionDetail($periodStart, $periodEnd);
        $categoryView = $this->getCategorySold($periodStart, $periodEnd);
        $salesChart = $salesChart->SalesChart($dataView['Details']);
        $CategoryChart = $CategoryChart->CategoryChart($categoryView);

        if ($periodEnd < $periodStart || $periodStart > $periodEnd) {
            return back()->with('error', 'Input tanggal periode tidak sesuai');
        }

        return view(
            'Transaction.SalesTrx.SalesInfo.SalesInfo',
            [
                'datetime',
                'dataView' => $dataView,
                'periodStart' => $periodStart,
                'periodEnd' => $periodEnd,
                'categoryView' => $categoryView,
                'salesChart' => $salesChart,
                'CategoryChart' => $CategoryChart
            ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showPeronalSales()
    {
        $datetime = Carbon::now()->format('Y-m');
        $userSales = SalesTrxH::selectRaw('REF_USER.name as user_name, SALES_TRX_H.total_trx_amt')
            ->join('REF_USER', 'SALES_TRX_H.REF_USER_ID', '=', 'REF_USER.REF_USER_ID')
            ->get();

        return view('Transaction.SalesTrx.SalesInfo.SalesPersonal', compact('datetime'));
    }
}
