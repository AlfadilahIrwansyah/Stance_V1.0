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

    public function filterDate($query, $columns, $yearMonth)
    {
        $year = substr($yearMonth, 0, 4);
        $month = substr($yearMonth, 5, 2);

        return $query->whereYear($columns, $year)
            ->whereMonth($columns, $month);
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
