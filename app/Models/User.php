<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    const CREATED_AT = 'user_created_at';
    const UPDATED_AT = 'user_updated_at';
    const DELETED_AT = 'user_deleted_at';

    protected $table = 'c_users';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'email',
        'email_verified_at',
        'password',
        'person_id',
        'profile_id'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'user_created_at',
        'user_updated_at',
        'user_deleted_at'
    ];

    public function person() : BelongsTo
    {
        return $this->belongsTo(People::class, 'person_id');
    }

    public function profile() : BelongsTo
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function offices() : BelongsToMany
    {
        return $this->belongsToMany(Office::class, 'c_office_user', 'user_id', 'office_id');
    }
}
