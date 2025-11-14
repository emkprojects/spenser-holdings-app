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

class Inventory extends Model implements Auditable
{
    use HasFactory, AuditableTrait, SoftDeletes;
    
    protected $fillable = [

        'inventory_reference', 
        'inventory_reference_no', 
        'inventory', 
        'description',
        'quantity',
        'is_active',
        'date_of_inventory',
        'raw_material_id',
        'created_by',   
        'updated_by',       
    ];

}
