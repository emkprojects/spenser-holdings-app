<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as SpatiePermission;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\User;
use App\Models\Role;

class Permission extends SpatiePermission implements Auditable
{
   use HasFactory, AuditableTrait, SoftDeletes;

   protected $primaryKey = 'id';


   protected $fillable = ['permission_reference', 'name', 'guard_name', 'description', 'is_active'];


   // public function roles() {

   //    return $this->belongsToMany(Role::class, 'role_has_permission');
            
   // }

     
   // public function users() {
     
   //    return $this->belongsToMany(User::class, 'model_has_roles');
            
   // }

}
