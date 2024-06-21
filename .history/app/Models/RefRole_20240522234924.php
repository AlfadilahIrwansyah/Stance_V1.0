<?php

namespace App\Models;

use App\Traits\LocalTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefRole extends Model
{
    use HasFactory;

    protected $primaryKey = 'REF_ROLE_ID';

    protected $table = 'REF_ROLE';

    protected $fillable = ['REF_ROLE_ID', 'ROLE_NAME', 'role_access'];

    public function getRouteKeyName()
    {
        return 'id';
    }
    public function ref_user()
    {
        return $this->hasMany(RefUser::class, 'ref_role_id');
    }
}
