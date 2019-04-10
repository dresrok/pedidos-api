<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceDetail extends Model
{
    protected $table = 'd_invoice_details';
    protected $primaryKey = 'invoice_detail_id';

    protected $fillable = [
        'invoice_detail_description',
        'invoice_detail_amount',
        'invoice_id',
        'order_detail_id'
    ];
    
    protected $dates = [
        'invoice_detail_created_at',
        'invoice_detail_updated_at',
        'invoice_detail_deleted_at'
    ];

    public function invoice() : BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function orderDetail() : BelongsTo
    {
        return $this->belongsTo(OrderDetail::class, 'order_detail_id');
    }
}
