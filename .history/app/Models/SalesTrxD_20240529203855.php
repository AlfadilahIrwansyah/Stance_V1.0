<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTrxD extends Model
{
    use HasFactory;


    public function ref_item()
    {
        return $this->belongsTo(RefItem::class, 'REF_ITEM_ID');
    }
}
