<?php

namespace App\Models;

namespace App\Models\ProductionManagement;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ItemProduction extends Pivot implements Auditable
{
    use HasFactory, AuditableTrait, SoftDeletes;

    protected $fillable =  [
         
        'quantity',
        'status_id',
        'is_active',
        
    ];

}
