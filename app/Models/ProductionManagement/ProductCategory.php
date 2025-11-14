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

class ProductCategory extends Model implements Auditable
{
    use HasFactory, AuditableTrait, SoftDeletes;

     protected $fillable =  [
         
        'product_category_reference',
        'product_category', 
        'description', 
        'category_id', 
        'is_active',
        'created_by',
        'updated_by',  

    ];

    
}
