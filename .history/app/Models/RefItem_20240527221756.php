<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefItem extends Model
{

    protected $primaryKey = 'REF_ITEM_ID';

    protected $table = 'REF_ITEM';

    use HasFactory;

    protected $fillable = [
        'ITEM_CODE',
        'ITEM_NAME',
        'REF_CATEGORY_ID',
        'STOCK',
        'BUY_PRICE_AMT',
        'SELL_PRICE_AMT',
        'IS_SELL'
    ];
    protected function create(array $data)
    {

        return RefUser::create([
            'ITEM_CODE' => $data['item_code'],
            'ITEM_NAME' => $data['item_code'],
            'REF_CATEGORY_ID' => $data['item_category'],
            'STOCK' => $data['item_stock'],
            'BUY_PRICE_AMT' => $data['item_buy_price'],
            'SELL_PRICE_AMT' => $data['item_sell_price'],
            'IS_SELL' => $data['item_code']
        ]);
    }

    public function ref_category()
    {
        return $this->hasOne(RefCategory::class, 'REF_CATEGORY_ID');
    }
}
