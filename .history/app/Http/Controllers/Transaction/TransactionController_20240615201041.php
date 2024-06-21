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
use Illuminate\Support\Facades\Validator;

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
        $salesData = SalesTrxH::with('REF_USER')->paginate(10);
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
            'ref_user_id' => 'required|exists:ref_user',
            'sales_date_hidden' => 'required|date_format:Y-m-d',
            'customer_name' => 'required|string|max:255',
            'item_desc' => 'required|string',
            'items' => 'required|array',
            'items.*.code' => 'required|string|max:255',
            'items.*.name' => 'required|string|max:255',
            'items.*.ref_item_id' => 'required|exists:ref_item',
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
            'REF_USER_ID' => $request->ref_user_id,
            'TRX_DATE' => $request->sales_date_hidden,
        ]);
        foreach ($request->items as $item) {
            $RefItem = RefItem::where('REF_ITEM_ID', $item['ref_item_id'])->get();
            dd($RefItem);
            $RefItem->STOCK = $RefItem->STOCK - $item['qty'];
            $RefItem->save();

            SalesTrxD::create([
                'SALES_TRX_H_ID' => $transaction->id,
                'REF_ITEM_ID' => $item['ref_item_id'],
                'ITEM_AMT' => $item['qty'],
                'TOTAL_PRICE_AMT' => ($item['qty'] * $item['price']),
            ]);
        }
        return redirect()->route('TransactionPaging')->with('success', 'Transaksi berhasil ditambahkan');
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getTrxDetail($trxno)
    {
        $salesTrxH = SalesTrxH::with('REF_USER')->where('SALES_TRX_NO', $trxno)->first();
        $salesTrxD = SalesTrxD::with('REF_ITEM')->where('SALES_TRX_H_ID', $salesTrxH->SALES_TRX_H_ID)->get();
        return view('Transaction.SalesTrx.TransactionDetailView', compact('salesTrxH', 'salesTrxD'));
    }
}
