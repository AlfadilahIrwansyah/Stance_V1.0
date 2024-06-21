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
        return view('Transaction.ItemStock.AddItemStock', compact('refCategory'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewItem()
    {
        $RefItem = RefItem::with('REF_CATEGORY')->get();
        return view('Transaction.ItemStock.ItemStockReg', compact('RefItem'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\RefItem
     */
    protected function NewItem(Request $request)
    {
        $itemBuyPrice = str_replace(',', '', $request->input('item_buy_price'));
        $itemSellPrice = str_replace(',', '', $request->input('item_sell_price'));
        $isSell = $request->has('item_active') ? 1 : 0;
        $newItem = RefItem::create([
            'ITEM_CODE' => $request->input('item_code'),
            'ITEM_NAME' => $request->input('item_name'),
            'REF_CATEGORY_ID' => $request->input('item_category'),
            'STOCK' => $request->input('item_stock'),
            'BUY_PRICE_AMT' => $itemBuyPrice,
            'SELL_PRICE_AMT' => $itemSellPrice,
            'IS_SELL' => $isSell
        ]);
        $newItem->save();
        return redirect()->route('viewItem')->with('success', 'Add item successfully!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function StockOpname()
    {
        $RefItem = RefItem::all();
        return view('Transaction.ItemStock.StockOpname', compact('RefItem'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\RefItem
     */
    public function updateStock(Request $request)
    {
        $stocks = $request->input('item_stock');
        foreach ($stocks as $itemCode => $stock) {
            $item = RefItem::where('ITEM_CODE', $itemCode)->first();
            if ($item) {
                $item->STOCK = $stock;
                $item->save();
            }
        }

        return redirect()->route('viewItem')->with('success', 'Stock updated successfully!');
    }
}
