<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefItem extends Model
{

    protected $primaryKey = 'REF_ITEM_ID';

    protected $table = 'REF_ITEM';

    use HasFactory;

    public function REF_CATEGORY()
    {
        return $this->hasOne(RefCategory::class, 'REF_CATEGORY_ID');
    }
}
