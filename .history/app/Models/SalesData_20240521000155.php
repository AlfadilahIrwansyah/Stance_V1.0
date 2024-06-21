<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesData extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'sales_data';


    public function ref_role()
    {
        return $this->belongsTo(RefRole::class, 'ref_role_id');
    }
}
