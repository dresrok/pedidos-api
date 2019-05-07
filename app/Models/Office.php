<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany};

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

    public function businessTypes() : BelongsToMany
    {
        return $this->belongsToMany(BusinessType::class, 'b_business_type_office', 'office_id', 'business_type_id');
    }

    public function addresses() : HasMany
    {
        return $this->hasMany(Address::class, 'office_id', 'office_id');
    }

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'c_office_user', 'office_id', 'user_id');
    }

    public function categories() : HasMany
    {
        return $this->hasMany(Category::class, 'office_id', 'office_id');
    }

    public function concepts() : HasMany
    {
        return $this->hasMany(Concept::class, 'office_id', 'office_id');
    }

    public function orders() : HasMany
    {
        return $this->hasMany(Order::class, 'office_id', 'office_id');
    }

    public function invoices() : HasMany
    {
        return $this->hasMany(Invoice::class, 'office_id', 'office_id');
    }
}
