<?php

namespace App\Http\Controllers;

use App\Models\RefRole;
use App\Models\RefUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($refUserId)
    {
        $refUser = RefUser::findOrFail($refUserId);
        return view('Settings.AccountDetail', compact($refUser));
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {

    // }
}
