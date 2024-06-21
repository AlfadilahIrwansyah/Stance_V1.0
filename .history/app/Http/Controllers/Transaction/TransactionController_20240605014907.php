<?php

namespace App\Http\Controllers\Transaction;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
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
    public function AddItem()
    {
        $totalAmount = 0;

        $TransData = (object) [
            'user' => Auth::user()->name,
            'saleDate' => Carbon::now()->format('Y-m-d')
        ];
        $itemData = [
            (object) [
                'ItemCode' => 'CAS1313',
                'ItemName' => 'NEW HONDA',
                'Qty' => 10,
                'Price' => 1000000,
            ],
            (object) [
                'ItemCode' => 'CAS1314',
                'ItemName' => 'NEW TOYOTA',
                'Qty' => 25,
                'Price' => 1000000,
            ]
        ];
        foreach ($itemData as $item) {
            $totalAmount += $item->Price * $item->Qty;
        }
        dd
        return view('Transaction.SalesTrx.AddTransaction', compact('TransData', 'itemData'));
    }
}
