<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Category extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'category_created_at';
    const UPDATED_AT = 'category_updated_at';
    const DELETED_AT = 'category_deleted_at';

    protected $table = 'd_categories';
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'category_machine_name',
        'category_normalized_name',
        'category_name',
        'category_image_path',
        'category_thumbnail_path',
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
     * Set the Category's machine name.
     *
     * @param  string  $value
     * @return void
     */
    public function setCategoryMachineNameAttribute($value)
    {
        $this->attributes['category_machine_name'] = Str::slug($value, '_');
    }

    /**
     * Set the Category's normalized name.
     *
     * @param  string  $value
     * @return void
     */
    public function setCategoryNormalizedNameAttribute($value)
    {
        $this->attributes['category_normalized_name'] = Str::slug($value, ' ');
    }

    public function parent() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function office() : BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    public function subcategories() : HasMany
    {
        return $this->hasMany(Category::class, 'subcategory_id', 'category_id');
    }

    public function products() : HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}
