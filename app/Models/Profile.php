<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasMany};

class Profile extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'profile_created_at';
    const UPDATED_AT = 'profile_updated_at';
    const DELETED_AT = 'profile_deleted_at';

    protected $table = 'c_profiles';
    protected $primaryKey = 'profile_id';

    protected $fillable = [
        'profile_machine_name',
        'profile_name'
    ];
    
    protected $dates = [
        'profile_created_at',
        'profile_updated_at',
        'profile_deleted_at'
    ];

    public function menus() : BelongsToMany
    {
        return $this->belongsToMany(Menu::class, 'c_menu_profile', 'profile_id', 'menu_id');
    }

    public function users() : HasMany
    {
        return $this->hasMany(User::class, 'profile_id', 'profile_id');
    }
}
