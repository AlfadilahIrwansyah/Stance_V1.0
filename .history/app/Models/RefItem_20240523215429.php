<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefItem extends Model
{

    protected $primaryKey = 'ref_item_id';

    protected $table = 'REF_ITEM';

    use HasFactory;

    public function RefCategoryRelation()
    {
        return $this->hasOne(RefCategory::class, 'REF_CATEGORY_ID');
    }
}
