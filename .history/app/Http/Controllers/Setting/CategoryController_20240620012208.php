<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\RefCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function validateCategory(Request $request){
        $validate = $request->validate([
            'category_name' => 'string|unique:REF_CATEGORY,CATEGORY_NAME',
        ], [
            'category_name.unique' => 'Nama Kategori sama atau sudah digunakan',
        ]);
        if ($validate) {
            return response()->json(['errors' => $validate->errors()->get($field)]);
        }
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

        return response()->json(['valid' => true]);
    }

    public function categoryPaging()
    {
        $RefCategory = RefCategory::withCount('ref_item')->paginate(10);
        return view('Settings.CategoryPaging', compact('RefCategory'));
    }

    public function categoryEdit($refCategoryid)
    {
        $refCategory = RefCategory::findOrFail($refCategoryid);
        return view('Settings.CategoryEdit', compact('refCategory'));
    }

    public function categoryUpdate(Request $request, $refCategoryid)
    {
        $refCategory = RefCategory::findOrFail($refCategoryid);

        $request->validate([
            'category_name' => 'string|unique:REF_CATEGORY,CATEGORY_NAME',
        ], [
            'category_name.unique' => 'Nama Kategori sama atau sudah digunakan',
        ]);

        $refCategory->CATEGORY_NAME = $request->category_name;
        $refCategory->update();

        return redirect()->route('CategoryP')->with('success', 'kategori updated successfully!');
    }

    public function categoryDelete(Request $request, $refCategoryid)
    {
        $refCategory = RefCategory::findOrFail($refCategoryid);
        if ($refCategory->ref_item()->exists()) {
            return redirect()->route('CategoryP')->with('error', 'Kategori ini masih memiliki item dan hanya bisa di edit.');
        }
        $refCategory->delete();

        return redirect()->route('CategoryP')->with('success', 'kategori updated successfully!');
    }

    public function categoryCancel()
    {
        return redirect()->back()->with('error', 'Gagal Update kategori');
    }

    public function categoryNew(Request $request)
    {
        $request->validate(
            [
                'category_name' => 'string|unique:REF_CATEGORY,CATEGORY_NAME',
            ],
            [
                'category_name.unique' => 'Nama Kategori sama atau sudah digunakan',
            ]
        );
        RefCategory::create(
            [
                'CATEGORY_NAME' => $request->category_name
            ]
        );
        return redirect()->route('CategoryP')->with('success', $request->category_name . ' Berhasil tambah kategori!');
    }

    public function categoryAdd()
    {
        return view('Settings.CategoryEdit');
    }
}
