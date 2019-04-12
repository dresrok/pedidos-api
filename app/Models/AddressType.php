<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\HasMany;

class AddressType extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'address_type_created_at';
    const UPDATED_AT = 'address_type_updated_at';
    const DELETED_AT = 'address_type_deleted_at';

    protected $table = 'c_address_types';
    protected $primaryKey = 'address_type_id';

    protected $fillable = [
        'address_type_name'
    ];
    
    protected $dates = [
        'address_type_created_at',
        'address_type_updated_at',
        'address_type_deleted_at'
    ];

    public function addresses() : HasMany
    {
        return $this->hasMany(Address::class, 'address_type_id', 'address_type_id');
    }
}
