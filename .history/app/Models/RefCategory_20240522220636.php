<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefCategory extends Model
{

    protected $primaryKey = 'ref_item_id';

    protected $table = 'ref_item';

    use HasFactory;

    public function RefCategoryRe()
    {
        return $this->belongsTo(RefItem::class, 'REF_CATEGORY_ID');
    }
}
