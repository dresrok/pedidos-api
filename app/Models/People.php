<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany, HasOne};

class People extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'person_created_at';
    const UPDATED_AT = 'person_updated_at';
    const DELETED_AT = 'person_deleted_at';

    protected $table = 'c_people';
    protected $primaryKey = 'person_id';

    protected $fillable = [
        'person_first_name',
        'person_last_name',
        'person_legal_name',
        'person_identification',
        'person_description',
        'person_type_id',
        'person_identification_type_id',
    ];
    
    protected $dates = [
        'person_created_at',
        'person_updated_at',
        'person_deleted_at'
    ];

    public function getPersonFullNameAttribute () : string
    {
        $personTypeCode = $this->personType->person_type_code;
        if ($personTypeCode === 'JUD') {
            return $this->person_legal_name;
        }
        return "$this->person_first_name $this->person_last_name";
    }

    public function personType() : BelongsTo
    {
        return $this->belongsTo(PersonType::class, 'person_type_id');
    }

    public function personIdentificationType() : BelongsTo
    {
        return $this->belongsTo(PersonIdentificationType::class, 'person_identification_type_id');
    }

    public function user() : HasOne
    {
        return $this->hasOne(User::class, 'person_id', 'person_id');
    }

    public function addresses() : HasMany
    {
        return $this->hasMany(Address::class, 'person_id', 'person_id');
    }

    public function orders() : HasMany
    {
        return $this->hasMany(Order::class, 'person_id', 'person_id');
    }

    public function invoices() : HasMany
    {
        return $this->hasMany(Invoice::class, 'person_id', 'person_id');
    }
}
