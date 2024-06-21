<?php

namespace App\Http\Controllers\Setting;

use App\Models\RefRole;
use App\Models\RefUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ShowAccountPage()
    {
        $refUserId = Auth::user()->ref_user_id;
        $Refuser = RefUser::with('REF_ROLE')->paginate(10);
        $refRole = RefRole::all();
        $usersData = $Refuser->map(function ($user) {
            $roleAccesses = optional($user->REF_ROLE)->ROLE_ACCESS ? explode(',', $user->REF_ROLE->ROLE_ACCESS) : [];
            return [
                'user' => $user,
                'roleAccesses' => $roleAccesses
            ];
        });
        return view('Settings.AccountPaging', compact('usersData', 'refUserId', 'refRole', 'Refuser'));
    }

    public function edit($refUserId)
    {
        $refUser = RefUser::with('REF_ROLE')->findOrFail($refUserId);
        $refRole = RefRole::all();
        return view('Settings.AccountDetail', compact('refUser', 'refRole'));
    }

    public function update(Request $request, $refUserId)
    {
        $refUser = RefUser::with('REF_ROLE')->findOrFail($refUserId);
        $refUser->name = $request->name;
        $refUser->password = Hash::make($request->password);
        $refUser->save();
        return redirect()->route('accsetting')->with('success', 'Data User Berhasil di update');
    }
}
