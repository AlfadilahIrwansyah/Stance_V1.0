<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefAccess extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'Ref_Access';
}
