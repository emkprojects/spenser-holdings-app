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

use App\Models\ProductionManagement\RawMaterial;
use App\Models\ProductionManagement\Product;
use App\Models\InventoryManagement\Item;

class Production extends Model implements Auditable
{
    use HasFactory, AuditableTrait, SoftDeletes;

     protected $fillable =  [
         
        'production_reference',
        'production', 
        'description', 
        'date_of_production', 
        'is_active',
        'created_by',
        'updated_by',  

    ];



    public function rawMaterials()
    {
        return $this->belongsToMany(RawMaterial::class)->using(RawMaterialProduction::class);
    }
    

    public function items()
    {
        return $this->belongsToMany(Item::class)->using(ItemProduction::class);
    }


    public function products()
    {
        return $this->belongsToMany(Product::class)->using(ProductProduction::class);
    }

    
}

