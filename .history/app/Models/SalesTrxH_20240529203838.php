<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTrxH extends Model
{
    use HasFactory;




    public function SALES_TRX_D()
    {
        return $this->belongsTo(Sae::class, 'REF_ITEM_ID');
    }
}
