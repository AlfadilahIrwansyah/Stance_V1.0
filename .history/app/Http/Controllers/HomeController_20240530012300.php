<?php

namespace App\Http\Controllers;

use DOMDocument;
use App\Models\RefRole;
use App\Charts\Barchart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function index(Barchart $Barchart, bool $IsDark = false)
    {
        dd($_POST['darkMode'])
        if (isset($_POST['darkMode'])) {
            $darkMode = $_POST['darkMode'];
        }
        // $IsDark = filter_var($request->input('isDark'), FILTER_VALIDATE_BOOLEAN);
        $adminRoleId = RefRole::where('ROLE_NAME', 'admin')->first()->REF_ROLE_ID;
        $homeChart = $Barchart->buildHomeLinechart($IsDark);
        return view('home', compact('homeChart', 'adminRoleId'));
    }
}
