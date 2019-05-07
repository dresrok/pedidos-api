<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasMany};

class Company extends Model
{
    use SoftDeletes, Sluggable;

    const CREATED_AT = 'company_created_at';
    const UPDATED_AT = 'company_updated_at';
    const DELETED_AT = 'company_deleted_at';

    const IMAGES_PATH = '/images/companies';

    protected $table = 'b_companies';
    protected $primaryKey = 'company_id';

    protected $fillable = [
        'company_legal_name',
        'company_commercial_name',
        'company_identification',
        'company_slug',
        'company_image_name',
        'city',
        'company_is_certified'
    ];

    protected $dates = [
        'company_created_at',
        'company_updated_at',
        'company_deleted_at'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'company_slug' => [
                'source' => 'company_legal_name',
                'onUpdate' => true
            ]
        ];
    }

    public function getCompanyImageMiniAttribute()
    {
        if (
            !empty($this->company_image_name) &&
            Storage::disk('public')->exists(self::IMAGES_PATH . "/mini/{$this->company_image_name}")
        ) {
            $contents = Storage::disk('public')->get(self::IMAGES_PATH . "/mini/{$this->company_image_name}");
            return 'data:image/jpeg;base64,' . base64_encode($contents);
        }
        return 'https://via.placeholder.com/36x36.png?text=R';
    }

    public function getCompanyImageMediumAttribute()
    {
        if (
            !empty($this->company_image_name) &&
            Storage::disk('public')->exists(self::IMAGES_PATH . "/medium/{$this->company_image_name}")
        ) {
            $contents = Storage::disk('public')->get(self::IMAGES_PATH . "/medium/{$this->company_image_name}");
            return 'data:image/jpeg;base64,' . base64_encode($contents);
        }
        return 'https://via.placeholder.com/300x200.png?text=Mi+Restaurante';
    }

    public function offices() : HasMany
    {
        return $this->hasMany(Office::class, 'company_id', 'company_id');
    }

    public function socialNetworks() : BelongsToMany
    {
        return $this->belongsToMany(SocialNetwork::class, 'b_company_social_network', 'company_id', 'social_network_id')
                        ->as('network')
                        ->withPivot([
                            'company_social_network_username'
                        ]);
    }

}
