<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Referrer extends Model implements Auditable
{
    use HasFactory, AuditableTrait, SoftDeletes;

    protected $fillable = [

        'referrer_reference',
        'national_identification_number',
        'tax_identification_number',
        'phone_number',
        'alternative_phone',
        'email_address', 
        'alternative_email',
        'physical_address', 
        'first_name',
        'last_name',
        'other_name',
        'gender',
        'date_of_birth',
        'referrer_type_id', 
        'is_active',        
        'created_by',        
    ];
    
}
