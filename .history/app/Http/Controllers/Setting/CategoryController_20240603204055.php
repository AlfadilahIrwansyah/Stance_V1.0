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
     * @param  \App\Models\RefRole  $refRole
     * @return \Illuminate\Http\Response
     */
    public function edit($refRoleId)
    {
        $refRole = RefRole::findOrFail($refRoleId); // Fetch the role
        $possibleAccesses = RefAccess::pluck('access_name')->toArray(); // Define all possible permissions

        $currentAccesses = explode(',', $refRole->role_access); // Split the role_access string into an array

        return view('Settings.RoleSettingDetail', compact('refRole', 'possibleAccesses', 'currentAccesses'));
    }
}
