<?php

namespace App\Http\Controllers\Transaction;

use App\Models\RefUser;
use App\Models\SalesTrxH;
use Carbon\Carbon;
use App\Models\RefItem;
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

        $transaction = SalesTrxH::create([
            'SALES_TRX_NO' => generateTrxNo(),
            'NAMA_PEMBELI' => 
            'user_cashier_id' => $request->user_cashier,
            'sales_date' => $request->sales_date,
            'customer_name' => $request->customer_name,
            'item_desc' => $request->item_desc,
        ]);
        return view('Transaction.SalesTrx.AddTransaction', compact('refItem', 'TransData'));
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
