<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Menu extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'menu_created_at';
    const UPDATED_AT = 'menu_updated_at';
    const DELETED_AT = 'menu_deleted_at';

    protected $table = 'c_menus';
    protected $primaryKey = 'menu_id';

    protected $fillable = [
        'menu_name',
        'menu_uri',
        'menu_icon',
        'menu_parent_id'
    ];
    
    protected $dates = [
        'menu_created_at',
        'menu_updated_at',
        'menu_deleted_at'
    ];

    public function parent() : BelongsTo
    {
        return $this->belongsTo(Menu::class, 'menu_parent_id');
    }

    public function subMenus() : HasMany
    {
        return $this->hasMany(Menu::class, 'menu_parent_id', 'menu_id');
    }
}
