<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function AddItem()
    {
        $TransData = (object) [
            'user' => Auth::user(),
            'message' => 'This data is not stored in the database.'
        ];
        return view('Transaction.SalesTrx.AddTransaction');
    }
}
