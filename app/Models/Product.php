<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Product extends Model
{
    use SoftDeletes, Sluggable;

    const CREATED_AT = 'product_created_at';
    const UPDATED_AT = 'product_updated_at';
    const DELETED_AT = 'product_deleted_at';

    const IMAGES_PATH = '/images/products/';

    protected $table = 'd_products';
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_machine_name',
        'product_normalized_name',
        'product_name',
        'product_description',
        'product_image_name',
        'category_id',
        'office_id'
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
                'separator'=> '_',
                'onUpdate' => true
            ],
            'product_normalized_name' => [
                'source' => 'product_name',
                'separator'=> ' ',
                'onUpdate' => true
            ]
        ];
    }

    public function getProductImageMiniAttribute()
    {
        if (
            !empty($this->product_image_name) &&
            Storage::disk('public')->exists(self::IMAGES_PATH . "mini/{$this->product_image_name}")
        ) {
            $contents = Storage::disk('public')->get(self::IMAGES_PATH . "mini/{$this->product_image_name}");
            return 'data:image/jpeg;base64,' . base64_encode($contents);
        }
        return 'https://via.placeholder.com/36x36.png?text=P';
    }

    public function getProductImageMediumAttribute()
    {
        if (
            !empty($this->product_image_name) &&
            Storage::disk('public')->exists(self::IMAGES_PATH . "medium/{$this->product_image_name}")
        ) {
            $contents = Storage::disk('public')->get(self::IMAGES_PATH . "medium/{$this->product_image_name}");
            return 'data:image/jpeg;base64,' . base64_encode($contents);
        }
        return 'https://via.placeholder.com/300x200.png';
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id');
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
