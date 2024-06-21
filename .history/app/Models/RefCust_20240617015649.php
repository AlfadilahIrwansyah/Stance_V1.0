<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefCust extends Model
{
    use HasFactory;
    protected $table = 'REF_CUST';
    protected $primaryKey = 'REF_CUST_ID';
    protected $fillable = [
        'CUST_NAME',
        'CUST_PHONE_NUMBER',
        'CUST_EMAIL',
        'email',
        'password',
        'is_activated',
    ];
}
