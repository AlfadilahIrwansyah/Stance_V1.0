<?php

namespace App\Models;

use App\Models\RefItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesData extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'sales_data';


    public function ref_item()
    {
        return $this->belongsTo(RefItem::class, 'ref_role_id');
    }
}
