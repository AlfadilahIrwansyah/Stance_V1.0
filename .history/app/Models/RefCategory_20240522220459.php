<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefCategory extends Model
{

    protected $primaryKey = 'ref_item_id';

    protected $table = 'ref_item';

    use HasFactory;

    public function ref_role()
    {
        return $this->belongsTo(RefRole::class, 'ref_role_id');
    }
}
