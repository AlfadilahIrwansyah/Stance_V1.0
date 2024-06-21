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
            ->select('RC.CUST_NAME', DB::raw('SUM(X.TOTAL_TRX) as TOTAL_TRX'), 'RC.REF_CUST_ID')
            ->groupBy('RC.CUST_NAME', 'RC.REF_CUST_ID')
            ->paginate(5);
        return $results;
    }

    private function getCustDetail($CustId): RefCust
    {
        $CustDetail = RefCust::findOrFail($CustId);
        return $CustDetail;
    }
    public function custPaging()
    {
        $CustData = $this->getCustTrxData();
        return view('Settings.CustomerPaging', compact('CustData'));
    }

    public function custDetail($CustId)
    {
        $CustData = $this->getCustDetail($CustId);
        return view('Settings.CustomerDetail', compact('CustData'));
    }

    public function custNew()
    {
        return view('Settings.CustomerDetail');
    }

    public function custAdd(Request $request)
    {
        RefCust::create(
            [
                'CUST_NAME' => $request->name,
                'CUST_PHONE_NUMBER' => $request->phone,
                'CUST_EMAIL' => $request->email
            ]
        );
        if ($request->ModalCust != 'Modal' || $request->ModalCust != '' || $request->ModalCust != null) {
            return redirect()->back();
        }
        return redirect()->route('custPaging')->with('success', 'Berhasil tambahkan pembeli');
    }

    public function searchCustomers(Request $request)
    {
        $searchQuery = $request->query('search');
        $refCust = RefCust::where('CUST_NAME', 'like', '%' . $searchQuery . '%')
            ->orWhere('CUST_PHONE_NUMBER', 'like', '%' . $searchQuery . '%')
            ->select(['CUST_NAME', 'CUST_PHONE_NUMBER'])
            ->paginate($this->custPaginateDatacount);

        return view('LookUp.CustLookupWithInput', compact('refCust'))->render();
    }

    public function deleteCust($refCustID){
        $refCust = RefCust::findOrFail('')
    }
}
