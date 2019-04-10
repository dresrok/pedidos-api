<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Concept extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'concept_created_at';
    const UPDATED_AT = 'concept_updated_at';
    const DELETED_AT = 'concept_deleted_at';

    protected $table = 'd_concepts';
    protected $primaryKey = 'concept_id';

    protected $fillable = [
        'concept_factor',
        'concept_name',
        'concept_description',
        'concept_formula',
        'concept_amount',
        'office_id'
    ];
    
    protected $dates = [
        'concept_created_at',
        'concept_updated_at',
        'concept_deleted_at'
    ];

    public function office() : BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    public function orderDetails() : HasMany
    {
        return $this->hasMany(OrderDetail::class, 'concept_id', 'concept_id');
    }
}
