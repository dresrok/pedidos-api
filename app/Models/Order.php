<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Order extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'order_created_at';
    const UPDATED_AT = 'order_updated_at';
    const DELETED_AT = 'order_deleted_at';

    protected $table = 'd_orders';
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'order_date',
        'order_serial',
        'order_number',
        'person_id',
        'address_id',
        'office_id'
    ];
    
    protected $dates = [
        'order_date',
        'order_created_at',
        'order_updated_at',
        'order_deleted_at'
    ];

    public function person() : BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function address() : BelongsTo
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function office() : BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    public function estates() : BelongsToMany
    {
        return $this->belongsToMany(Estate::class, 'd_estate_order', 'order_id', 'estate_id');
    }

    public function orderDetails() : HasMany
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }

    public function invoice() : HasOne
    {
        return $this->hasOne(Invoice::class, 'order_id', 'order_id');
    }
}
