<?php

namespace App\Models\ProductionManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RawMaterial extends Model implements Auditable
{
    use HasFactory, AuditableTrait, SoftDeletes;
    
    protected $fillable = [

        'raw_material_reference', 
        'raw_material_reference_no', 
        'raw_material', 
        'description',
        'physical_stock', 
        'current_stock', 
        'minimum_stock', 
        'is_active',
        'status_id',
        'item_id',
        'created_by',        
    ];

}

