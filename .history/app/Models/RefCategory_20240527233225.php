<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefCategory extends Model
{

    protected $primaryKey = 'REF_CATEGORY_ID';

    protected $table = 'REF_CATEGORY';

    use HasFactory;

    public function ref_item()
    {
        return $this->hasMany(RefItem::class, 'ref_category_id', 'REF_CATEGORY_ID');
    }
}
