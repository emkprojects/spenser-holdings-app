<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetail extends Model implements Auditable
{
    use HasFactory, AuditableTrait, SoftDeletes;

    protected $fillable = [

        'national_identification_number',
        'first_name',
        'last_name',
        'other_name',       
        'gender',
        'date_of_birth',
        //'education_level_id', 
        //'occupation_id',
        // 'current_position',
        'physical_address',
        'alternative_phone',
        'alternative_email',
        'user_id',
        //'village_id',    
    ];
    
}
