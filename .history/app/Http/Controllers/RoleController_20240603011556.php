<?php

namespace App\Http\Controllers;

use App\Models\RefRole;
use App\Models\RefAccess;
use Illuminate\Http\Request;

class RoleController extends Controller
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
        $Refrole = RefRole::paginate(2);
        $RoleData = $Refrole->map(function ($role) {
            $roleAccesses = optional($role)->ROLE_ACCESS ? explode(',', $role->ROLE_ACCESS) : [];
            return [
                'role' => $role,
                'roleAccesses' => $roleAccesses
            ];
        });
        // dd($refAccess);
        return view('Settings.RoleSettingPaging', compact('RoleData'));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RefRole  $refRole
     * @return \Illuminate\Http\Response
     */
    public function show(RefRole $refRole)
    {
        return view('Settings.RoleSettingDetail', compact('refRole'));
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RefRole  $refRole
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

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\RefRole  $refRole
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(RefRole $refRole)
    // {
    //     //
    // }
}
