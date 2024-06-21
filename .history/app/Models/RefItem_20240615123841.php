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
    /**
     * Scope a query to filter transactions by a range of years and months.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $startYearMonth The start year and month in format 'yyyy-mm'
     * @param string $endYearMonth The end year and month in format 'yyyy-mm'
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterDateRange($query, $startYearMonth, $endYearMonth)
    {
        $startYear = substr($startYearMonth, 0, 4);
        $startMonth = substr($startYearMonth, 5, 2);

        $endYear = substr($endYearMonth, 0, 4);
        $endMonth = substr($endYearMonth, 5, 2);

        return $query->where(function ($query) use ($startYear, $startMonth, $endYear, $endMonth) {
            $query
                ->whereYear('BUY_DATE', '>=', $startYear)
                ->whereYear('BUY_DATE', '>=', $startYear)
                ->whereMonth('BUY_DATE', '>=', $startMonth)
                ->and(function ($query) use ($startYear, $startMonth, $endYear, $endMonth) {
                    $query->whereYear('BUY_DATE', '<=', $endYear)
                        ->whereMonth('BUY_DATE', '<=', $endMonth);
                });
        });
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
