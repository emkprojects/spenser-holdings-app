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
use App\Models\SalesManagement\Sale;

class Product extends Model implements Auditable
{
    use HasFactory, AuditableTrait, SoftDeletes;

    protected $fillable =  [
         
        'product_reference',
        'product', 
        'description', 
        'sub_category_id', 
        'physical_stock', 
        'current_stock', 
        'minimum_stock', 
        'product_amount',
        'is_active',
        'last_updated',
        'created_by',
        'updated_by',  
        'production_id',

    ];


    public function productions()
    {
        return $this->belongsToMany(Production::class)->using(Productproduction::class);
    }


    public function sales()
    {
        return $this->belongsToMany(Sale::class)->using(ProductSale::class);
    }
    
}

