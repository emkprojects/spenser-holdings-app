<?php

namespace App\Models\ProductionManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\ProductionManagement\Production;

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
        'updated_by',        
    ];


    public function productions()
    {
        return $this->belongsToMany(Production::class)->using(RawMaterialProduction::class);
    }
}

