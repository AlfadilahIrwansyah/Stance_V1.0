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
        $Refrole = RefRole::paginate(10);
        $RoleData = $Refrole->map(function ($role) {
            $roleAccesses = optional($role)->ROLE_ACCESS ? explode(',', $role->ROLE_ACCESS) : [];
            return [
                'role' => $role,
                'roleAccesses' => $roleAccesses
            ];
        });
        return view('Settings.RoleSettingPaging', ['RoleData' => $RoleData, 'Refrole' => $Refrole]);
    }

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
        $refRole = RefRole::findOrFail($refRoleId);
        $possibleAccesses = RefAccess::pluck('access_name')->toArray();
        $currentAccesses = explode(',', $refRole->ROLE_ACCESS);
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
