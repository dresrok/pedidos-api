<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPrice extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'product_price_created_at';
    const UPDATED_AT = 'product_price_updated_at';
    const DELETED_AT = 'product_price_deleted_at';

    protected $table = 'd_product_prices';
    protected $primaryKey = 'product_price_id';

    protected $fillable = [
        'product_price_amount',
        'product_id'
    ];

    protected $dates = [
        'product_price_created_at',
        'product_price_updated_at',
        'product_price_deleted_at'
    ];

    public function getProductPriceStatusAttribute(): string
    {
        return empty($this->product_price_deleted_at) ? 'Activo' : 'Inactivo';
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
