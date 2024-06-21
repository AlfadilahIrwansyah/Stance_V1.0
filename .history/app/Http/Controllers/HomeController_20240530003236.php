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
    public function index(Barchart $Barchart)
    {
        $IsDark = $request->input('isDark', false);
        $adminRoleId = RefRole::where('ROLE_NAME', 'admin')->first()->REF_ROLE_ID;
        $homeChart = $Barchart->buildHomeLinechart($IsDark);
        return view('home', compact('homeChart', 'adminRoleId'));
    }

    public function homeChart(Barchart $Barchart, Request $request)
    {
        $isDark = $request->input('isDark', false); // Default to false if not provided
        $homeChart = $Barchart->buildHomeLinechart($isDark);

        // Assuming you return a view or JSON response with the chart
        return response()->json([
            'chart' => $homeChart->toVue()
        ]);
    }
}
