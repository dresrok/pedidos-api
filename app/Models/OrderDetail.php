<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasOne};

class OrderDetail extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'order_detail_created_at';
    const UPDATED_AT = 'order_detail_updated_at';
    const DELETED_AT = 'order_detail_deleted_at';

    protected $table = 'd_order_details';
    protected $primaryKey = 'order_detail_id';

    protected $fillable = [
        'order_detail_quantity',
        'order_id',
        'product_id',
        'concept_id'
    ];
    
    protected $dates = [
        'order_detail_created_at',
        'order_detail_updated_at',
        'order_detail_deleted_at'
    ];

    public function order() : BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function concept() : BelongsTo
    {
        return $this->belongsTo(Concept::class, 'concept_id');
    }

    public function invoiceDetail() : HasOne
    {
        return $this->hasOne(InvoiceDetail::class, 'order_detail_id', 'order_detail_id');
    }
}
