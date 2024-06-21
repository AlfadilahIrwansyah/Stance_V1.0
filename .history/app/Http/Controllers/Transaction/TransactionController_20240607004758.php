<?php

namespace App\Http\Controllers\Transaction;

use Carbon\Carbon;
use App\Models\RefItem;
use App\Models\RefUser;
use App\Models\SalesTrxD;
use App\Models\SalesTrxH;
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
    public function transactionPaging()
    {
        $salesData = SalesTrxH::all();
        return view('Transaction.SalesTrx.TransactionView', compact('salesData'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function AddItem()
    {
        $userId = auth()->id();
        $user = RefUser::findOrFail($userId);
        $refItem = RefItem::all();
        $TransData = (object) [
            'user' => $user,
            'saleDate' => Carbon::now()->format('Y-m-d')
        ];
        return view('Transaction.SalesTrx.AddTransaction', compact('refItem', 'TransData'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * @param  \Illuminate\Http\Request  $request
     */

    public function AddTrx(Request $request)
    {
        $request->validate([
            'user_cashier' => 'required|exists:users,id',
            'sales_date' => 'required|date',
            'customer_name' => 'required|string|max:255',
            'item_desc' => 'required|string',
            'items' => 'required|array',
            'items.*.id' => 'required|integer',
            'items.*.code' => 'required|string|max:255',
            'items.*.name' => 'required|string|max:255',
            'items.*.qty' => 'required|integer',
            'items.*.price' => 'required|numeric',
            'items.*.total' => 'required|numeric',
        ]);
        $totalQty = 0;
        foreach ($request->items as $item) {
            $totalQty += $item['qty'];
        }

        $transaction = SalesTrxH::create([
            'SALES_TRX_NO' => generateTrxNo(),
            'NAMA_PEMBELI' => $request->customer_name,
            'TOTAL_ITEM' => $totalQty,
            'TOTAL_TRX_AMT' => $request->total,
            'REF_USER_ID' => $request->user_cashier_id,
            'TRX_DATE' => $request->sales_date,
        ]);

        foreach ($request->items as $item) {
            SalesTrxD::create([
                'SALES_TRX_H_ID' => $transaction->SALES_TRX_H_ID,
                'REF_ITEM_ID' => $item['itemId'],
                'ITEM_AMT' => $item['qty'],
                'TOTAL_PRICE_AMT' => ($item['qty'] * $item['price']),
            ]);
        }
        return view('Transaction.SalesTrx.AddTransaction', compact('refItem', 'TransData'))->;
    }

    public function getItems()
    {
        $items = RefItem::all(['ITEM_CODE', 'ITEM_NAME']);
        return response()->json($items);
    }

    public function getItemDetails($itemCode)
    {
        $item = RefItem::where('ITEM_CODE', $itemCode)->first();
        return response()->json($item);
    }
}
