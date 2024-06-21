<?php

namespace App\Http\Controllers\Transaction;

use Carbon\Carbon;
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

    public function getTotalTransactionDetail()
    {
        $salesTrxH = SalesTrxH::all();
        $TotalSoldItem = $salesTrxH->TOTAL_ITEM->sum();
        return $TotalSoldItem;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showSales(Request $request)
    {
        $datetime = Carbon::now()->format('Y-m-d');
        $periodStart = $request->input('period_start', $datetime);
        $periodEnd = $request->input('period_end', $datetime);
        dd(getTotalTransactionDetail());
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
        $datetime = Carbon::now()->format('Y-m-d');
        return view('Transaction.SalesTrx.SalesInfo.SalesPersonal', compact('datetime'));
    }
}
