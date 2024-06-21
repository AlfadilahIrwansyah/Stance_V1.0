<?php

namespace App\Http\Controllers\Setting;

use App\Models\RefCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function validateCategory(Request $request)
    {
        $field = $request->input('field');
        $value = $request->input('value');
        $rules = [
            'category_name' => 'required|unique:REF_CATEGORY,CATEGORY_NAME',
        ];

        $messages = [
            'category_name.unique' => 'Nama Kategori sama atau sudah digunakan',
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
