<?php

namespace App\Http\Controllers\Auth;

use App\Models\RefUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function showChangeForm($token)
    {
        return view('auth.passwords.reset');
    }
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function changePassword(Request $request, $token)
    {
        $request->validate([
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = RefUser::where('ACTIVATION_TOKEN', $token)->firstOrFail();


        if (Hash::check($request->new_password, $user->password)) {
            return back()->withErrors(['new_password' => 'Password perlu diganti']);
        }

        $user->password = Hash::make($request->new_password);
        $user->IS_ACTIVATED = true;
        $user->ACTIVATION_TOKEN = null;
        $user->save();

        return redirect()->route('home')->with('success', 'Password berhasil diganti');
    }
}
