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
    public function index()
    {
        $Refrole = RefCategory::paginate(10);
        $RoleData = $Refrole->map(function ($role) {
            $roleAccesses = optional($role)->ROLE_ACCESS ? explode(',', $role->ROLE_ACCESS) : [];
            return [
                'role' => $role,
                'roleAccesses' => $roleAccesses
            ];
        });
        return view('Settings.RoleSettingPaging', ['RoleData' => $RoleData, 'Refrole' => $Refrole]);
    }
}
