<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\{BelongsToMany};

class SocialNetwork extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'social_network_created_at';
    const UPDATED_AT = 'social_network_updated_at';
    const DELETED_AT = 'social_network_deleted_at';

    protected $table = 'b_social_networks';
    protected $primaryKey = 'social_network_id';

    protected $fillable = [
        'social_network_name',
        'social_network_url',
        'social_network_icon'
    ];
    
    protected $dates = [
        'social_network_created_at',
        'social_network_updated_at',
        'social_network_deleted_at'
    ];

    
    public function companies() : BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'b_company_social_networks', 'social_network_id', 'company_id');
    }
}
