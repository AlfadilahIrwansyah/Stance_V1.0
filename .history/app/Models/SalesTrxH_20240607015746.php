<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTrxH extends Model
{
    use HasFactory;

    protected $table = 'SALES_TRX_H';

    protected $fil
    public function SALES_TRX_D()
    {
        return $this->hasMany(SalesTrxD::class, 'SALES_TRX_H_ID');
    }
}
