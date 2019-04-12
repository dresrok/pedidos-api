<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\HasMany;

class PersonIdentificationType extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'person_identification_type_created_at';
    const UPDATED_AT = 'person_identification_type_updated_at';
    const DELETED_AT = 'person_identification_type_deleted_at';

    protected $table = 'c_person_identification_types';
    protected $primaryKey = 'person_identification_type_id';

    protected $fillable = [
        'person_identification_type_code',
        'person_identification_type_description'
    ];
    
    protected $dates = [
        'person_identification_type_created_at',
        'person_identification_type_updated_at',
        'person_identification_type_deleted_at'
    ];

    public function people() : HasMany
    {
        return $this->hasMany(Person::class, 'person_identification_type_id', 'person_identification_type_id');
    }
}
