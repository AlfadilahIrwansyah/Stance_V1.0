<?php

namespace App\Http\Controllers\Setting;

use App\Models\RefCust;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CustController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function getCustTrxData()
    {
        $subquery = DB::table('REF_CUST as RC')
            ->leftJoin('SALES_TRX_H as STH', 'STH.REF_CUST_ID', '=', 'RC.REF_CUST_ID')
            ->selectRaw('RC.REF_CUST_ID, ISNULL(COUNT(STH.SALES_TRX_H_ID), 0) as TOTAL_TRX')
            ->groupBy('RC.REF_CUST_ID');

        $results = DB::table('REF_CUST as RC')
            ->joinSub($subquery, 'X', function ($join) {
                $join->on('RC.REF_CUST_ID', '=', 'X.REF_CUST_ID');
            })
            ->select('RC.CUST_NAME', DB::raw('SUM(X.TOTAL_TRX) as TOTAL_TRX'))
            ->groupBy('RC.CUST_NAME', 'RC.REF_CUST_ID')
            ->get();
        return $results;
    }

    private function getCustDetail($CustId) : RefCust
    {
        $CustDetail = RefCust::findOrFail($CustId);
        return $CustDetail;
    }
    public function custPaging()
    {
        $CustData = $this->getCustTrxData();
        return view('Settings.CustomerPaging', compact('CustData'));
    }

    public function custDetail()
    {
        $CustData = $this->getCustDetail();
        return view('Settings.CustomerDetail', compact('CustData'));
    }
}
