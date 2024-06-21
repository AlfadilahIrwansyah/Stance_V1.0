<?php

namespace App\Models;

use App\Traits\LocalTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefRole extends Model
{
    use HasFactory;

    protected $primaryKey = 'REF_ROLE_ID';

    protected $table = 'Ref_Role';

    protected $fillable = ['ref_role_id', 'role_name', 'role_access'];

    public function getRouteKeyName()
    {
        return 'id';
    }
    public function ref_user()
    {
        return $this->hasMany(RefUser::class, 'ref_role_id');
    }
}
