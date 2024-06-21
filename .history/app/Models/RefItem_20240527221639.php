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
        'REF_ITEM_ID',
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
            'REF_ITEM_ID' $data['name'],
            'ITEM_CODE',
            'ITEM_NAME',
            'REF_CATEGORY_ID',
            'STOCK',
            'BUY_PRICE_AMT',
            'SELL_PRICE_AMT',
            'IS_SELL'
        ]);
    }

    public function ref_category()
    {
        return $this->hasOne(RefCategory::class, 'REF_CATEGORY_ID');
    }
}
