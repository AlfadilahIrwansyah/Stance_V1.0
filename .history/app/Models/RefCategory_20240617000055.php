<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefCategory extends Model
{

    protected $primaryKey = 'REF_CATEGORY_ID';

    protected $table = 'REF_CATEGORY';

    use HasFactory;

    protected $fillable = [
        'ITEM_CODE',
        'ITEM_NAME',
        'REF_CATEGORY_ID',
        'STOCK',
        'BUY_PRICE_AMT',
        'SELL_PRICE_AMT',
        'IS_SELL',
        'BUY_DATE'
    ];
    public function ref_item()
    {
        return $this->hasMany(RefItem::class, 'REF_CATEGORY_ID');
    }
}
