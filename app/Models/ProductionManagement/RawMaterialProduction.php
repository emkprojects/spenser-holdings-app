<?php

namespace App\Models\ProductionManagement;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RawMaterialProduction extends Pivot implements Auditable
{
    use HasFactory, AuditableTrait, SoftDeletes;

    protected $fillable =  [
         
        'quantity',
        'status_id',
        'is_active',
        
    ];
    
}
