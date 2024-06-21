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
    public function filterDateSales($query, $yearMonth)
    {
        $year = substr($yearMonth, 0, 4);
        $month = substr($yearMonth, 5, 2);

        return $query->whereYear('TRX_DATE', $year)
            ->whereMonth('TRX_DATE', $month);
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
