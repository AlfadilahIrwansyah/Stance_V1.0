<?php

namespace App\Http\Controllers\Setting;

use App\Models\RefUser;
use Illuminate\Http\Request;

class ActivationController extends Controller
{
    public function activate($token)
    {
        $user = RefUser::where('ACTIVATION_TOKEN', $token)->firstOrFail();
        $user->IS_ACTIVATED = true;
        $user->ACTIVATION_TOKEN = null;
        $user->save();

        return redirect('/login')->with('status', 'Your account has been activated!');
    }
}
