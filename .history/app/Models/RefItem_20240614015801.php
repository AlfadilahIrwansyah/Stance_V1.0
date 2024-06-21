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
        'IS_SELL',
        'BUY_DATE'
    ];

    public function filterDate($query, $yearMonth)
    {
        $year = substr($yearMonth, 0, 4);
        $month = substr($yearMonth, 5, 2);

        return $query->whereYear('TRX_DATE', $year)
            ->whereMonth('TRX_DATE', $month);
    }

    public function ref_category()
    {
        return $this->belongsTo(RefCategory::class, 'REF_CATEGORY_ID');
    }

    public function SALES_TRX_D()
    {
        return $this->hasMany(SalesTrxD::class, 'REF_ITEM_ID');
    }
}
