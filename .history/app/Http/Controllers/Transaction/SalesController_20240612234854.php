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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showSales()
    {
        $datetime = Carbon::now()
        return view('Transaction.SalesTrx.SalesInfo.SalesInfo');
    }
}
