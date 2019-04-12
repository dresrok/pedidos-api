<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentMethod extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'payment_method_created_at';
    const UPDATED_AT = 'payment_method_updated_at';
    const DELETED_AT = 'payment_method_deleted_at';

    protected $table = 'd_payment_methods';
    protected $primaryKey = 'payment_method_id';

    protected $fillable = [
        'payment_method_name',
        'payment_method_description'
    ];
    
    protected $dates = [
        'payment_method_created_at',
        'payment_method_updated_at',
        'payment_method_deleted_at'
    ];

    public function invoices() : HasMany
    {
        return $this->hasMany(Invoice::class, 'payment_method_id', 'payment_method_id');
    }
}
