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
    public function SALES_TRX_H()
    {
        return $this->belongsTo(SalesTrxH::class, 'SALES_TRX_H_ID');
    }

    public function REF_ITEM(){
        
    }
}
