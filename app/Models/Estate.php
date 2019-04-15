<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Estate extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'estate_created_at';
    const UPDATED_AT = 'estate_updated_at';
    const DELETED_AT = 'estate_deleted_at';

    protected $table = 'd_estates';
    protected $primaryKey = 'estate_id';

    protected $fillable = [
        'estate_name',
        'estate_used_by'
    ];
    
    protected $dates = [
        'estate_created_at',
        'estate_updated_at',
        'estate_deleted_at'
    ];
}
