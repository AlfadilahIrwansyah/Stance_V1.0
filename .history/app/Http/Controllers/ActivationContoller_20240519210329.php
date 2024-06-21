<?php

namespace App\Http\Controllers;

use App\Models\RefUser;
use Illuminate\Http\Request;

class ActivationContoller extends Controller
{
    public function activate($token)
    {
        $user = RefUser::where('activation_token', $token)->firstOrFail();
        $user->is_activated = true;
        $user->activation_token = null;
        $user->save();

        return redirect('/login')->with('status', 'Your account has been activated!');
    }
}
