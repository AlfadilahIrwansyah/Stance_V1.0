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
        // $items = $request->items;
        // foreach ($items as &$item) {
        //     $item['price'] = $this->floatval(str_replace(',', '', $item['price']));
        //     $item['total'] = $this->floatval(str_replace(',', '', $item['total']));
        // }
        // $request->merge(['items' => $items]);
        // dd($request->all());
        // $request->validate([
        //     'ref_user_id' => 'required|exists:ref_user',
        //     'sales_date_hidden' => 'required|date_format:Y-m-d',
        //     'customer_name' => 'required|string|max:255',
        //     'item_desc' => 'required|string',
        //     'items' => 'required|array',
        //     // 'items.*.code' => 'required|string|max:255',
        //     // 'items.*.name' => 'required|string|max:255',
        //     // 'items.*.ref_item_id' => 'required|exists:ref_item',
        //     // 'items.*.qty' => 'required|integer',
        //     // 'items.*.price' => 'required|numeric',
        //     // 'items.*.total' => 'required|numeric',
        // ]);
        $validator = Validator::make($request->all(), [
            'ref_user_id' => 'required|exists:ref_user',
            'sales_date_hidden' => 'required|date_format:Y-m-d',
            'customer_name' => 'required|string|max:255',
            'item_desc' => 'required|string',
        ]);
        foreach ($request->input('items', []) as $key => $item) {
            $validator->sometimes("items.$key.code", 'required|string|max:255', function ($input) use ($key) {
                return !empty($input["items.$key"]);
            });
            $validator->sometimes("items.$key.name", 'required|string|max:255', function ($input) use ($key) {
                return !empty($input["items.$key"]);
            });
            $validator->sometimes("items.$key.ref_item_id", 'required|exists:ref_item,id', function ($input) use ($key) {
                return !empty($input["items.$key"]);
            });
            $validator->sometimes("items.$key.qty", 'required|integer', function ($input) use ($key) {
                return !empty($input["items.$key"]);
            });
            $validator->sometimes("items.$key.price", 'required|numeric', function ($input) use ($key) {
                return !empty($input["items.$key"]);
            });
            $validator->sometimes("items.$key.total", 'required|numeric', function ($input) use ($key) {
                return !empty($input["items.$key"]);
            });
        }
        // dd('1');
        // $totalQty = 0;
        dd($request->items);
        // foreach ($request->items as $item) {
        //     $totalQty += $item['qty'];
        // }

        $transaction = SalesTrxH::create([
            'SALES_TRX_NO' => generateTrxNo(),
            'NAMA_PEMBELI' => $request->customer_name,
            'TOTAL_ITEM' => 0,
            'TOTAL_TRX_AMT' => $request->total,
            'REF_USER_ID' => $request->ref_user_id,
            'TRX_DATE' => $request->sales_date_hidden,
        ]);

        foreach ($request->items as $item) {
            SalesTrxD::create([
                'SALES_TRX_H_ID' => $transaction->SALES_TRX_H_ID,
                'REF_ITEM_ID' => $item['ref_item_id'],
                'ITEM_AMT' => $item['qty'],
                'TOTAL_PRICE_AMT' => ($item['qty'] * $item['price']),
            ]);
        }
        dd('1');
        return view('Transaction.SalesTrx.TransactionView')->with('success', 'Transaksi berhasil ditambahkan');
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
