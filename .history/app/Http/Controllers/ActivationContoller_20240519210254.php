<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivationContoller extends Controller
{
    public function activate($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();
        $user->is_activated = true;
        $user->activation_token = null;
        $user->save();

        return redirect('/login')->with('status', 'Your account has been activated!');
    }
}
