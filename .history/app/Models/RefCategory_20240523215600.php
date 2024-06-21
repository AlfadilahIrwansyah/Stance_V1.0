<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefCategory extends Model
{

    protected $primaryKey = 'REF_CATEGORY_ID';

    protected $table = 'REF_CATEGORY';

    use HasFactory;

    public function REF_ITEM_RELATION()
    {
        return $this->belongsTo(RefItem::class, 'REF_CATEGORY_ID');
    }
}
