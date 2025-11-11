<?php

namespace App\Models\SalesManagement;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductSale extends Pivot implements Auditable
{
    use HasFactory, AuditableTrait, SoftDeletes;

    protected $fillable =  [
         
        'quantity',
        'unit_cost',
        'status_id',
        'is_active',
        
    ];
    

}
