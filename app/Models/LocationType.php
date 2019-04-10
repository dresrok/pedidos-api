<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\HasMany;

class LocationType extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'location_type_created_at';
    const UPDATED_AT = 'location_type_updated_at';
    const DELETED_AT = 'location_type_deleted_at';

    protected $table = 'c_location_types';
    protected $primaryKey = 'location_type_id';

    protected $fillable = [
        'location_type_name'
    ];
    
    protected $dates = [
        'location_type_created_at',
        'location_type_updated_at',
        'location_type_deleted_at'
    ];

    public function addresses() : HasMany
    {
        return $this->hasMany(Address::class, 'location_type_id', 'location_type_id');
    }
}
