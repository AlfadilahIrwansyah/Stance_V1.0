<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

    protected function getTotalTransactionDetail(){

    }
}
