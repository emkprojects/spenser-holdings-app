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

class Item extends Model implements Auditable
{
    use HasFactory, AuditableTrait, SoftDeletes;

    protected $fillable = [

        'item_reference', 
        'item', 
        'description',
        'physical_stock', 
        'current_stock', 
        'minimum_stock', 
        'item_amount',
        'is_active',
        'last_updated',         
        'supplier_id',        
        'created_by',  
        'updated_by',        
    ];
    
}

