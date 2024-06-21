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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RefCategory  $refCategory
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RefCategory  $refCategory
     * @return \Illuminate\Http\Response
     */
    public function categoryDelete(Request $request, $refCategoryid)
    {
        $refCategory = RefCategory::findOrFail($refCategoryid);
        if ($refCategory->ref_item()->exists()) {
            return redirect()->route('CategoryP')->with('error', 'Kategori ini masih memiliki item dan hanya bisa di edit.');
        }
        $refCategory->delete();

        return redirect()->route('CategoryP')->with('success', 'kategori updated successfully!');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function categoryCancel(Request $request)
    {
        return redirect()->back()->with('error', 'Gagal Update kategori');
    }
}
