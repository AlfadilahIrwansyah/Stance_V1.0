<?php

namespace App\Http\Controllers\Transaction;

use Carbon\Carbon;
use App\Models\RefItem;
use App\Models\RefCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ItemRegController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AddItem()
    {
        $refCategory = RefCategory::all();
        $date = Carbon::now()->format('Y-m-d');
        return view('Transaction.ItemStock.AddItemStock', compact('refCategory', 'date'));
    }

    public function viewItem()
    {
        $RefItem = RefItem::with('ref_category')->get();
        return view('Transaction.ItemStock.ItemStockReg', compact('RefItem'));
    }

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
            'item_stock' => 'required|integer',
            'buy_date' => 'required|date'
        ];

        $messages = [
            'item_code.required' => 'Kode Barang Perlu di Isi dan Unik',
            'item_code.unique' => 'Kode Barang sudah ada dalam sistem.',
            'item_name.required' => 'Nama Barang harus diisi.',
            'item_category.required' => 'Kategori Barang harus diisi.',
            'item_desc.required' => 'Deskripsi Barang harus diisi.',
            'item_buy_price.required' => 'Harga Beli harus diisi.',
            'item_buy_price.regex' => 'Harga Beli harus berupa angka dengan format xx000 contoh 50000.',
            'item_sell_price.regex' => 'Harga Jual harus berupa angka dengan format xx000 contoh 50000.',
            'item_stock.required' => 'Stok Barang harus diisi.',
            'item_stock.integer' => 'Stok Barang harus berupa angka.',
            'buy_date.required' => 'Tanggal harus di isi'
        ];

        $validator = Validator::make(
            [$field => $value],
            [$field => $rules[$field]],
            $messages
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->get($field)]);
        }

        return response()->json(['valid' => true]);
    }

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
            'IS_SELL' => $isSell,
            'BUY_DATE' => $request->input('buy_date'),
            'DESC' => $request->input('item_desc')
        ]);
        $newItem->save();
        return redirect()->route('viewItem')->with('success', 'Add item successfully!');
    }

    public function StockOpname()
    {
        $RefItem = RefItem::all();
        return view('Transaction.ItemStock.StockOpname', compact('RefItem'));
    }

    public function updateStock(Request $request)
    {
        $stocks = $request->input('item_stock');
        foreach ($stocks as $itemCode => $stock) {
            $item = RefItem::where('ITEM_CODE', (string) $itemCode)->first();
            if ($item) {
                $item->STOCK = $stock;
                $item->save();
            }
        }

        return redirect()->route('viewItem')->with('success', 'Stock updated successfully!');
    }

    public function editItem($refItemId)
    {
        $item = RefItem::findOrFail($refItemId);
        $refCategory = RefCategory::all();
        return view('Transaction.ItemStock.AddItemStock', compact('item', 'refCategory'));
    }

    public function updateItem(Request $request, $refItemId)
    {
        $itemBuyPrice = str_replace(',', '', $request->input('item_buy_price'));
        $itemSellPrice = str_replace(',', '', $request->input('item_sell_price'));
        $item = RefItem::findOrFail($refItemId);
        $item->ITEM_NAME = $request->item_name;
        $item->REF_CATEGORY_ID = $request->item_category;
        $item->BUY_PRICE_AMT = $itemBuyPrice;
        $item->SELL_PRICE_AMT = $itemSellPrice;
        $item->STOCK = $request->item_stock;
        $item->IS_SELL = $request->has('item_active') ? 1 : 0;
        $item->BUY_DATE = $request->buy_date;
        $item->DESC = $request->item_desc;
        $item->save();

        return redirect()->route('viewItem')->with('success', 'Barang berhasil diperbarui!');
    }
}
