<?php

namespace App\Http\Controllers\Transaction;

use App\Models\RefItem;
use App\Models\RefCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ItemRegController extends Controller
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
        $refCategory = RefCategory::all();
        return view('Transaction.AddItemStock', compact('refCategory'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewItem()
    {
        $RefItem = RefItem::with('ref_category')->get();
        return view('Transaction.ItemStockReg', compact('RefItem'));
    }


    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function validateItem(Request $request)
    {
        $field = $request->input('field');
        $value = $request->input('value');

        $rules = [
            'item_code' => 'required|string|max:255|unique:REF_ITEM',
            'item_name' => 'required|string|max:255',
            'item_category' => 'required|integer',
            'item_desc' => 'required',
            'item_buy_price' => 'required|regex:/^\d+(\.\d{2})?$/',
            'item_sell_price' => 'regex:/^\d+(\.\d{2})?$/',
            'item_stock' => 'required|int',
        ];

        $validator = Validator::make(
            [$field => $value],
            [$field => $rules[$field]]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->get($field)]);
        }

        return response()->json(['valid' => true]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\RefItem
     */
    protected function NewItem(array $data)
    {
        $newItem = RefItem::create([
            'ITEM_CODE' => $data['item_code'],
            'ITEM_NAME' => $data['item_name'],
            'REF_CATEGORY_ID' => $data['item_category'],
            'STOCK' => $data['item_stock'],
            'BUY_PRICE_AMT' => $data['item_buy_price'],
            'SELL_PRICE_AMT' => $data['item_sell_price'],
            'IS_SELL' => $data['item_active']
        ]);
        return
    }
}
