<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasMany};

class Company extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'company_created_at';
    const UPDATED_AT = 'company_updated_at';
    const DELETED_AT = 'company_deleted_at';

    protected $table = 'b_companies';
    protected $primaryKey = 'company_id';

    protected $fillable = [
        'company_legal_name',
        'company_commercial_name',
        'company_slug',
        'company_image',
        'city',
        'company_is_certified'
    ];

    protected $dates = [
        'company_created_at',
        'company_updated_at',
        'company_deleted_at'
    ];

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
