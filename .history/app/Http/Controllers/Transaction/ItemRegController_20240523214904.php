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
        $RefItem = RefItem::with('REF_CATEGORY')->get();
        $itemData = $RefItem->map(function ($item) {
            $itemList = optional($item->REF_ROLE)->ROLE_ACCESS ? explode(',', $user->REF_ROLE->ROLE_ACCESS) : [];
            return [
                'user' => $user,
                'roleAccesses' => $roleAccesses
            ];
        });
        return view('Transaction.ItemStockReg');
    }
}
