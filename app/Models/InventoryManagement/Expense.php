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

class Expense extends Model implements Auditable
{
    use HasFactory, AuditableTrait, SoftDeletes;

    protected $fillable =  [
        
        'expense_reference', 
        'item_id', 
        'description', 
        'quantity', 
        'amount',         
        'date_of_expense', 
        'is_active',
        'created_by',
        'updated_by',  
        'approved_by',
        'production_id',
    ];

    
}

