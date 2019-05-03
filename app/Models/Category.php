<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Category extends Model
{
    use SoftDeletes, Sluggable;

    const CREATED_AT = 'category_created_at';
    const UPDATED_AT = 'category_updated_at';
    const DELETED_AT = 'category_deleted_at';

    const IMAGES_PATH = '/images/categories/';

    protected $table = 'd_categories';
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'category_machine_name',
        'category_normalized_name',
        'category_name',
        'category_image_name',
        'category_order',
        'subcategory_id',
        'office_id'
    ];

    protected $dates = [
        'category_created_at',
        'category_updated_at',
        'category_deleted_at'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'category_machine_name' => [
                'source' => 'category_name',
                'separator' => '_',
                'onUpdate' => true
            ],
            'category_normalized_name' => [
                'source' => 'category_name',
                'separator' => ' ',
                'onUpdate' => true
            ]
        ];
    }

    public function getCategoryImageMiniAttribute()
    {
        if (
            !empty($this->category_image_name) &&
            Storage::disk('public')->exists(self::IMAGES_PATH . "mini/{$this->category_image_name}")
        ) {
            $contents = Storage::disk('public')->get(self::IMAGES_PATH . "mini/{$this->category_image_name}");
            return 'data:image/jpeg;base64,' . base64_encode($contents);
        }
        return 'https://via.placeholder.com/36x36.png?text=C';
    }

    public function getCategoryImageMediumAttribute()
    {
        if (
            !empty($this->category_image_name) &&
            Storage::disk('public')->exists(self::IMAGES_PATH . "medium/{$this->category_image_name}")
        ) {
            $contents = Storage::disk('public')->get(self::IMAGES_PATH . "medium/{$this->category_image_name}");
            return 'data:image/jpeg;base64,' . base64_encode($contents);
        }
        return 'https://via.placeholder.com/300x200.png';
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    public function subcategories(): HasMany
    {
        return $this->hasMany(Category::class, 'subcategory_id', 'category_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }

    public function scopeGetNextOrder($query, $officeId): int
    {
        return ($query->withTrashed()
            ->where('office_id', $officeId)
            ->orderBy('category_order', 'desc')
            ->pluck('category_order')->first()) + 1;
    }
}
