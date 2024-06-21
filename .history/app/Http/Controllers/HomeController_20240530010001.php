<?php

namespace App\Http\Controllers;

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
    public function index(Barchart $Barchart, Request $request)
    {
        $dom = new DOMDocument();
        @$dom->loadHTML($htmlContent);

// Get all div elements
$divs = $dom->getElementsByTagName('div')

        $IsDark = $request->input('isDark', false);
        dd($IsDark);
        $adminRoleId = RefRole::where('ROLE_NAME', 'admin')->first()->REF_ROLE_ID;
        $homeChart = $Barchart->buildHomeLinechart($IsDark);
        return view('home', compact('homeChart', 'adminRoleId'));
    }
}
