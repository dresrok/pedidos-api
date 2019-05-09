<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany};

class Invoice extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'invoice_created_at';
    const UPDATED_AT = 'invoice_updated_at';
    const DELETED_AT = 'invoice_deleted_at';

    protected $table = 'd_invoices';
    protected $primaryKey = 'invoice_id';

    protected $fillable = [
        'invoice_date',
        'invoice_serial',
        'invoice_number',
        'invoice_description',
        'order_id',
        'person_id',
        'payment_method_id',
        'office_id'
    ];
    
    protected $dates = [
        'invoice_date',
        'order_created_at',
        'order_updated_at',
        'order_deleted_at'
    ];

    public function order() : BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function person() : BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function paymentMethod() : BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function office() : BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    public function estates() : BelongsToMany
    {
        return $this->belongsToMany(Estate::class, 'd_estate_invoice', 'invoice_id', 'estate_id');
    }

    public function invoiceDetails() : HasMany
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id', 'invoice_id');
    }
}
