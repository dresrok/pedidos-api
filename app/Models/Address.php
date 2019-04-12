<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Address extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'address_created_at';
    const UPDATED_AT = 'address_updated_at';
    const DELETED_AT = 'address_deleted_at';

    protected $table = 'c_addresses';
    protected $primaryKey = 'address_id';

    protected $fillable = [
        'address_name',
        'address_location_i',
        'address_location_ii',
        'address_location_iii',
        'address_description',
        'address_district',
        'address_phone',
        'address_type_id',
        'location_type_id',
        'person_id',
        'office_id'
    ];
    
    protected $dates = [
        'address_created_at',
        'address_updated_at',
        'address_deleted_at'
    ];

    public function addressType() : BelongsTo
    {
        return $this->belongsTo(AddressType::class, 'address_type_id');
    }

    public function locationType() : BelongsTo
    {
        return $this->belongsTo(LocationType::class, 'location_type_id');
    }

    public function person() : BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function office() : BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    public function orders() : HasMany
    {
        return $this->hasMany(Order::class, 'address_id', 'address_id');
    }
}
