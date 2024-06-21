<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefCust extends Model
{
    use HasFactory;
    protected $table = 'REF_CUST';
    protected $primaryKey = 'REF_CATEGORY_ID';
}
