<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefItem extends Model
{

    protected $primaryKey = 'ref_item_id';

    protected $table = 'ref_item';

    use HasFactory;

    public function RefCategory()
    {
        return $this->belongsTo(RefItem::class, 'REF_CATEGORY_ID');
    }
}
