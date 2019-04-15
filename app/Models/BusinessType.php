<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\{BelongsToMany};

class BusinessType extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'business_type_created_at';
    const UPDATED_AT = 'business_type_updated_at';
    const DELETED_AT = 'business_type_deleted_at';

    protected $table = 'b_business_types';
    protected $primaryKey = 'business_type_id';

    protected $fillable = [
        'business_type_machine_name',
        'business_type_normalized_name',
        'business_type_name'
    ];

    protected $dates = [
        'business_type_created_at',
        'business_type_updated_at',
        'business_type_deleted_at'
    ];

    public function offices() : BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'b_business_type_office', 'business_type_id', 'office_id');
    }

}
