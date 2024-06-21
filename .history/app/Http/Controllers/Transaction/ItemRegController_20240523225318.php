<?php

namespace App\Http\Controllers\Transaction;

use App\Models\RefItem;
use App\Models\RefCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemRegController extends Controller
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
        $refCategory = RefCategory::all();
        return view('Transaction.AddItemStock', compact('refCategory'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewItem()
    {
        $RefItem = RefItem::with('REF_CATEGORY_RELATION')->get();
        $usersData = $RefItem->map(function ($item) {
            return [
                'user' => $item,
                'roleAccesses' => $roleAccesses
            ];
        });
        return view('Transaction.ItemStockReg', compact('RefItem'));
    }
}
