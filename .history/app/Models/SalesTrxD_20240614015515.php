<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTrxD extends Model
{
    use HasFactory;

    protected $table = 'SALES_TRX_D';
    protected $fillable = [
        'SALES_TRX_H_ID',
        'REF_ITEM_ID',
        'ITEM_AMT',
        'TOTAL_PRICE_AMT',
    ];
    /**
     * Scope a query to filter transactions by month and year.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $yearMonth The year and month in format 'yyyy-mm'
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filterDate($query, $columns, $yearMonth)
    {
        $year = substr($yearMonth, 0, 4);
        $month = substr($yearMonth, 5, 2);

        return $query->whereYear($columns, $year)
            ->whereMonth($columns, $month);
    }
    public function SALES_TRX_H()
    {
        return $this->belongsTo(SalesTrxH::class, 'SALES_TRX_H_ID');
    }

    public function REF_ITEM()
    {
        return $this->belongsTo(RefItem::class, 'REF_ITEM_ID');
    }
}
