<?php

namespace App\Models;

use App\Traits\LocalTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefRole extends Model
{
    use HasFactory;

    protected $primaryKey = 'ref_role_id';

    protected $table = 'Ref_Role';

    protected $fillable = ['ref_role_id', 'role_name', 'role_access'];

    public function getRouteKeyName()
    {
        return 'id';
    }
    public function RefCategory()
    {
        return $this->belongsTo(RefItem::class, 'REF_CATEGORY_ID');
    }
}
