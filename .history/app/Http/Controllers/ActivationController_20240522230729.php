<?php

namespace App\Http\Controllers;

use App\Models\RefUser;
use Illuminate\Http\Request;

class ActivationController extends Controller
{
    public function activate($token)
    {
        $user = RefUser::where('ACTIVATION_TOKEN', $token)->firstOrFail();
        $user->IS_ACTIVATED = true;
        $user->activation_token = null;
        $user->save();

        return redirect('/activate/', $token)->with('status', 'Your account has been activated!');
    }
}
