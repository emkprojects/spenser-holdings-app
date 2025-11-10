<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\User;
use App\Models\Permission;

class Role extends SpatieRole implements Auditable
{
   use HasFactory, AuditableTrait, SoftDeletes;

   protected $primaryKey = 'id';


   protected $fillable = ['role_reference', 'name', 'guard_name', 'description', 'is_active'];

   // public function permissions() {

   //    return $this->belongsToMany(Permission::class);
            
   // }
     
   // public function users() {
     
   //    return $this->belongsToMany(User::class);
            
   // }

}