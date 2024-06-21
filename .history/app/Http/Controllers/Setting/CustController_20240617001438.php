<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function custPaging()
}
