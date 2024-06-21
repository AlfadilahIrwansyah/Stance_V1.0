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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryPaging()
    {
        $RefCategory = RefCategory::withCount('ref_item')->paginate(10);
        return view('Settings.CategoryPaging', compact('RefCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RefCategory $refCategory
     * @return \Illuminate\Http\Response
     */
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

        $validatedData = $request->validate([
            'category_name' => 'required|string|unique:REF_CATEGORY,CATEGORY_NAME',
        ], [
            'category_name.required' => 'The category name field is required.',
            'category_name.string' => 'The category name must be a string.',
            'category_name.unique' => 'The category name has already been taken.',
        ]);

        $refCategory->CATEGORY_NAME = $request->category_name;
        $refCategory->update();

        return redirect()->route('CategoryP')->with('success', 'kategori updated successfully!');
    }
}
