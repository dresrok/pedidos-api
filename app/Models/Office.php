<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Office extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'office_created_at';
    const UPDATED_AT = 'office_updated_at';
    const DELETED_AT = 'office_deleted_at';

    protected $table = 'b_offices';
    protected $primaryKey = 'office_id';

    protected $fillable = [
        'office_name',
        'office_email',
        'office_open_from',
        'office_open_to',
        'office_delivery_time',
        'office_minimum_order_price',
        'city',
        'company_id'
    ];
    
    protected $dates = [
        'office_created_at',
        'office_updated_at',
        'office_deleted_at'
    ];


    public function company() : BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function addresses() : HasMany
    {
        return $this->hasMany(Address::class, 'office_id', 'office_id');
    }

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
