<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\LocalTimestamps;

class RefUser extends Authenticatable
{
    // use HasApiTokens, HasFactory, Notifiable;
    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array<int, string>
    //  */
    // protected $primaryKey = 'REF_USER_ID';
    // protected $table = 'REF_USER';
    // protected $fillable = [
    //     'NAME',
    //     'REF_ROLE_ID',
    //     'PHONE_NUMBER',
    //     'EMAIL',
    //     'PASSWORD',
    //     'IS_ACTIVATED',
    // ];

    // /**
    //  * The attributes that should be hidden for serialization.
    //  *
    //  * @var array<int, string>
    //  */
    // protected $hidden = [
    //     'PASSWORD',
    //     'REMEMBER_TOKEN',
    // ];

    // /**
    //  * The attributes that should be cast.
    //  *
    //  * @var array<string, string>
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];


    // public function ref_role()
    // {
    //     return $this->belongsTo(RefRole::class, 'REF_ROLE_ID');
    // }
    
}
