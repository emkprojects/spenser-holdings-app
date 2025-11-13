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

class Customer extends Model implements Auditable
{
    use HasFactory, AuditableTrait, SoftDeletes;

    protected $fillable = [

        'customer_reference',
        'national_identification_number',
        'tax_identification_number',
        'customer',
        'phone_number',
        'alternative_phone',
        'email_address', 
        'alternative_email', 
        'physical_address', 
        'contact_first_name',
        'contact_last_name',
        'contact_other_name',
        'contact_phone_number',
        'contact_alternative_phone',
        'contact_email_address', 
        'contact_alternative_email',
        'contact_physical_address',
        'contact_gender',
        'contact_date_of_birth',
        'customer_type_id',
        'referrer_type_id', 
        'user_id', 
        'customer_id',
        'supplier_id',
        'position_id',
        'referrer_id',
        'is_active',        
        'created_by',        
    ];
    
}

