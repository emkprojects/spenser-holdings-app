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

class SupplierType extends Model implements Auditable
{
    use HasFactory, AuditableTrait, SoftDeletes;

     protected $fillable =  [
         
        'supplier_type_reference',
        'supplier_type', 
        'description', 
        #'group_id', 
        'is_active',
        'created_by',

    ];

    
}
