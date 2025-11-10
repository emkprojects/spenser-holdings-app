<?php

namespace App\Livewire;

use Livewire\Component;
use Auth;
use DB;
use App\Models\Permission;
use App\Models\Role;
use Spatie\Permission\Traits\RefreshesPermissionCache;

class SelectedPermission extends Component
{

    public $role_id;


    protected $listeners = ['refreshComponent' => 'loadNewPermissions'];


    public function render()
    {

        $role_id = $this->role_id;

        $role = Role::findOrFail($role_id);
        
        return view('livewire.selected-permission', [
            
            'permissions' => $role->permissions,
            'role_id' => $role_id,
            
        ]);
    }





    /////////////////// SHOW ALL ROLE PERMISSIONS ////////////////////////////////////////////////////////////////
    public function loadNewPermissions($role_id){

        $this->role_id = $role_id;
    }





    /////////////////// DELETE PERMISSION RECORD //////////////////////////////////////////////////////////////////
    public function removePermissionFromRole($permission_id, $role_id){

        //if(Auth::user()->can('view-role')){

            $role = Role::findorFail($role_id);

            $permission = Permission::findOrFail($permission_id);

            $remove_permission = $role->revokePermissionTo($permission->name);
            
         

            $this->dispatch('reloadTable');
    


        //}
    }
}