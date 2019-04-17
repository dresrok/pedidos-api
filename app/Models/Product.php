<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Product extends Model
{
    use SoftDeletes, Sluggable;

    const CREATED_AT = 'product_created_at';
    const UPDATED_AT = 'product_updated_at';
    const DELETED_AT = 'product_deleted_at';

    protected $table = 'd_products';
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_machine_name',
        'product_normalized_name',
        'product_name',
        'product_description',
        'product_image_path',
        'product_thumbnail_path',
        'category_id'
    ];

    protected $dates = [
        'product_created_at',
        'product_updated_at',
        'product_deleted_at'
    ];

     /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'product_machine_name' => [
                'source' => 'product_name',
                'separator'=> '_'
            ],
            'product_normalized_name' => [
                'source' => 'product_name',
                'separator'=> ' '
            ]
        ];
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function prices() : HasMany
    {
        return $this->hasMany(ProductPrice::class, 'product_id', 'product_id');
    }

    public function orderDetails() : HasMany
    {
        return $this->hasMany(OrderDetail::class, 'product_id', 'product_id');
    }
}
