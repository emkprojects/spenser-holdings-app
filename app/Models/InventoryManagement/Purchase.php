<?php

namespace App\Models\InventoryManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model implements Auditable
{
    use HasFactory, AuditableTrait, SoftDeletes;
    
    protected $fillable = [

        'purchase_reference', 
        'purchase_reference_no', 
        'purchase', 
        'description',
        'quantity',
        'unit_cost',
        'is_active',
        'date_of_purchase',
        'item_id',          
        'supplier_id',        
        'created_by',        
    ];

}
