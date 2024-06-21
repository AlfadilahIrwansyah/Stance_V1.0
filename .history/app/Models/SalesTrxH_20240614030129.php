<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTrxH extends Model
{
    use HasFactory;

    protected $table = 'SALES_TRX_H';

    protected $fillable = [
        'SALES_TRX_NO',
        'NAMA_PEMBELI',
        'TOTAL_ITEM',
        'TOTAL_TRX_AMT',
        'REF_USER_ID',
        'TRX_DATE',
    ];
    /**
     * Scope a query to filter transactions by month and year.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $yearMonth The year and month in format 'yyyy-mm'
     * @return \Illuminate\Database\Eloquent\Builder
     */
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
            $query->whereYear('TRX_DATE', '>=', $startYear)
                ->whereMonth('TRX_DATE', '>=', $startMonth)
                ->orWhere(function ($query) use ($startYear, $startMonth, $endYear, $endMonth) {
                    $query->whereYear('TRX_DATE', '<=', $endYear)
                        ->whereMonth('TRX_DATE', '<=', $endMonth);
                });
        });
    }
    public function SALES_TRX_D()
    {
        return $this->hasMany(SalesTrxD::class, 'SALES_TRX_H_ID');
    }

    public function REF_USER()
    {
        return $this->belongsTo(RefUser::class, 'REF_USER_ID');
    }
}
