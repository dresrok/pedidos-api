<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\HasMany;

class PersonType extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'person_type_created_at';
    const UPDATED_AT = 'person_type_updated_at';
    const DELETED_AT = 'person_type_deleted_at';

    protected $table = 'c_person_types';
    protected $primaryKey = 'person_type_id';

    protected $fillable = [
        'person_type_code',
        'person_type_description'
    ];
    
    protected $dates = [
        'person_type_created_at',
        'person_type_updated_at',
        'person_type_deleted_at'
    ];

    public function people() : HasMany
    {
        return $this->hasMany(Person::class, 'person_type_id', 'person_type_id');
    }
}
