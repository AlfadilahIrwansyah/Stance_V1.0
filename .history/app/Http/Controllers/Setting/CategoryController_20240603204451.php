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
    public function update(Request $request, $refRoleId)
    {
        $refRole = RefRole::findOrFail($refRoleId);
        $allAccesses = RefAccess::pluck('Access_name')->toArray();

        // Validation of request data
        $request->validate([
            'role_access' => 'array',
            'role_access.*' => 'in:' . implode(',', $allAccesses)
        ]);

        $accesses = $request->input('role_access', []);
        if (empty($accesses)) {
            $refRole->role_access = 'NoAccess';
        } else {
            if (in_array('ALL', $accesses) || count($accesses) === count($allAccesses)) {
                $refRole->role_access = 'ALL';
            } else {
                $refRole->role_access = implode(',', array_intersect($accesses, $allAccesses));
            }
        }
        $refRole->update();

        return redirect()->route('rolePaging')->with('success', 'Role updated successfully!');
    }
}
