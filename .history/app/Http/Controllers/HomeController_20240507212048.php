<?php

namespace App\Http\Controllers;

use App\Models\RefRole;
use App\Charts\Barchart;
use Illuminate\Http\Request;

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
     */
    public function index(Barchart $Barchart)
    {
        $adminRoleId = RefRole::where('role_name', 'admin')->first()->ref_role_id;
        $homeChart = $Barchart->buildHomeLinechart();
        return view('home', compact('homeChart', 'adminRoleId'));
    }
}
