<?php

namespace App\Http\Controllers\Web\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use DB;
use Log;
use Auth;
use Str;
use Carbon\Carbon;

use App\Models\Role;
use App\Models\Permission;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserStatus;

use App\Http\Requests\Web\HumanResource\AddRoleRequest;
use App\Http\Requests\Web\HumanResource\EditRoleRequest;
use App\Http\Requests\Web\HumanResource\AddPermissionRequest;
use App\Http\Requests\Web\HumanResource\EditPermissionRequest;
use App\Http\Requests\Web\HumanResource\AssignRolePermissionRequest;

use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

use Spatie\Permission\Traits\RefreshesPermissionCache;

class RoleController extends Controller
{
    


    /////////////////// SHOW ALL ROLES //////////////////////////////////////////////////////////////////////
    public function getRoles(Request $request){

        if( !Auth::user()->can('view-roles')){

            return abort('403'); 
        }

        if ($request->ajax()) {

            $roles = Role::select('id', 'name', 'guard_name', 'role_reference', 'description', 'created_at', 'is_active')
            ->where('name', '!=', 'super-admin')
            ->orderBy('name', 'asc');

            return Datatables::of($roles)
            ->addIndexColumn()

            ->setRowClass(function ($roles) {
                return $roles->is_active == 0 ? 'table-warning' : '';
            })

            ->editColumn('is_active', function($roles){
                if($roles->is_active == 1){
                    $is_active = "Enabled";
                }
                else{
                    $is_active = "Disabled";
                }
                return ucwords($is_active);
            })

            ->editColumn('name', function ($roles){
                $name = ucwords( str_replace("-", " ", $roles->name));
                return $name;
            })

            ->editColumn('description', function($roles){
                return ucwords($roles->description);
            })
             
            ->editColumn('created_at', function($roles){
                return date("d-m-Y @ H:i:s a", strtotime($roles->created_at));
            }) 

            ->addColumn('actions', function ($row) {

                $actions = '<div class="d-flex gap-1">';
                
                if( Auth::user()->can('view-roles')){

                    $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#viewRecordModal" data-id ="'.$row->role_reference.'" id ="'.$row->id.'" class="text-info btn-xl record-view-btn" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                                     
                }

                if( Auth::user()->can('edit-roles')){
                    
                    $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editRecordModal" data-id ="'.$row->role_reference.'" id ="'.$row->id.'" class="text-success btn-xl record-edit-btn" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                                  
                }

                if( Auth::user()->can('delete-roles')){
                    
                   $actions .= '<a href="javascript:void(0);" data-id ="'.$row->role_reference.'" id ="'.$row->id.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';
                                  
                } 
                
                
                if( Auth::user()->can('assign-role-permissions')){
                    
                   $actions .= '<a href="/permissions-by-role/'.$row->role_reference.'" class="text-secondary btn-xl assign-btn" id="'.$row->id.'" title="Assign Permissions">
                            <i class="icon-base ti tabler-eye"></i></a>';
                                  
                } 
                
                 

                $actions .= '</div>';
                return $actions;

            })
            
            ->rawColumns(['actions'])
            ->make(true);

        }

        return view('web.human-resource.view-roles');
      
    }



    /////////////////// ADD ROLE RCORD //////////////////////////////////////////////////////////////////////
    public function addRole(AddRoleRequest $request){

        if( !Auth::user()->can('add-roles')){

            return abort('403'); 
        }
       
        $validated = $request->validated();

        #info($validated);

        try{

            \DB::beginTransaction();

            $validated['name'] = strtolower($validated['role']);
            //$validated['name'] = str_replace(' ', '-', strtolower($validated['role']));

            $role =  Role::create($validated);
            \DB::commit();

            return response()->json(['message' => 'Role created successfully']);

        }
        catch(\Exception $e){
        
            \DB::rollBack();

            info($e->getMessage());

            $error_message = array('server_error' => array( 'Unexpected error occurred' ));
            return response()->json([
                'message' => 'The given data was invalid',
                'errors' => $error_message
            ], 422);
            
        }
       
    }



    /////////////////// GET SPECIFIC ROLE RECORD //////////////////////////////////////////////////////////////////
    public function getRoleDetails($role){

        if( !Auth::user()->can('view-roles')){

            return abort('403'); 
        }


        try{

            $role = Role::findorFail($role);

            return response()->json(['message' => 'success', 'data'=>$role]);

        }

        catch (ModelNotFoundException $e){

            return response()->json(['message' => 'Role not found'], 404);

        }

        

    }


     

    /////////////////// GET ROLE RECORD FOR UPDATE ////////////////////////////////////////////////////////////////    
    public function getEditRole($role){

        if( !Auth::user()->can('edit-roles')){

            return abort('403'); 
        }

        
        try{

            $role = Role::findorFail($role);

            return response()->json(['message' => 'success', 'data'=>$role]);

        }

        catch (ModelNotFoundException $e){

            return response()->json(['message' => 'Role not found'], 404);

        }

       

    }




    /////////////////// EDIT ROLE RECORD //////////////////////////////////////////////////////////////////////
    public function editRole(EditRoleRequest $request){

        if( !Auth::user()->can('edit-roles')){

            return abort('403'); 
        }

            $validated =  $request->validated();

            info($validated);

            try{

                $validated['name'] = strtolower($validated['role']);
                //$validated['name'] = str_replace(' ', '-', strtolower($validated['role']));

                $role = Role::findorFail($validated['role_id']);

                $role->update($validated);

                return response()->json(['message' => 'Role updated successfully']);

            }

            catch (ModelNotFoundException $e){

                Log::Error($e);

                return response()->json(['message' => 'Role not found'], 404);

            }
        
    }

   



    /////////////////// DELETE ROLE RECORD //////////////////////////////////////////////////////////////////////
    public function deleteRole($role){

        if( !Auth::user()->can('delete-roles')){

            return abort('403'); 
        }

            try{

                $role = ROle::findorFail($role);
                $role->delete();

                return response()->json(['message' => 'Role deleted successfully.']);

            }
    
            catch (ModelNotFoundException $e){
    
                return response()->json(['message' => 'Role not found'], 404);
    
            }

        
    }




    /////////////////// SHOW ALL PERMISSION //////////////////////////////////////////////////////////////////////
    public function getPermissions(Request $request){

        if( !Auth::user()->can('view-permissions')){

            return abort('403'); 
        }

        if ($request->ajax()) {

            $permissions = Permission::select('id', 'name', 'guard_name', 'permission_reference', 
            'description', 'created_at', 'is_active')
            ->orderBy('name', 'asc');

            return Datatables::of($permissions)
            ->addIndexColumn()

            ->setRowClass(function ($permissions) {
                return $permissions->is_active == 0 ? 'table-warning' : '';
            })

            ->editColumn('is_active', function($permissions){
                if($permissions->is_active == 1){
                    $is_active = "Enabled";
                }
                else{
                    $is_active = "Disabled";
                }
                return ucwords($is_active);
            })

            ->editColumn('name', function ($permissions){
                $name = ucwords( str_replace("-", " ", $permissions->name));
                return $name;
            })

            ->editColumn('description', function($permissions){
                return ucwords($permissions->description);
            })
             
            ->editColumn('created_at', function($permissions){
                return date("d-m-Y @ H:i:s a", strtotime($permissions->created_at));
            }) 

            ->addColumn('actions', function ($row) {

                $actions = '<div class="d-flex gap-1">';
                
                if( Auth::user()->can('view-permissions')){

                    $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#viewRecordModal" data-id ="'.$row->permission_reference.'" id ="'.$row->id.'" class="text-info btn-xl record-view-btn" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                                     
                }

                if( Auth::user()->can('edit-permissions')){
                    
                    $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editRecordModal" data-id ="'.$row->permission_reference.'" id ="'.$row->id.'" class="text-success btn-xl record-edit-btn" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                                  
                }

                if( Auth::user()->can('delete-permissions')){
                    
                   $actions .= '<a href="javascript:void(0);" data-id ="'.$row->permission_reference.'" id ="'.$row->id.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';
                                  
                }       

                $actions .= '</div>';
                return $actions;

            })
            
            ->rawColumns(['actions'])
            ->make(true);

        }

        return view('web.human-resource.view-permissions');
      
    }



    /////////////////// ADD PERMISSION RCORD //////////////////////////////////////////////////////////////
    public function addPermission(AddPermissionRequest $request){

        if( !Auth::user()->can('add-permissions')){

            return abort('403'); 
        }
       
        $validated = $request->validated();

        try{

            \DB::beginTransaction();

            //$validated['name'] = strtolower($validated['permission']);
            $validated['name'] = str_replace(' ', '-', strtolower($validated['permission']));

            $permission =  Permission::create($validated);
            \DB::commit();

            return response()->json(['message' => 'Permission created successfully']);

        }
        catch(\Exception $e){
        
            \DB::rollBack();

            info($e->getMessage());

            $error_message = array('server_error' => array( 'Unexpected error occurred' ));
            return response()->json([
                'message' => 'The given data was invalid',
                'errors' => $error_message
            ], 422);
            
        }
       
    }





    /////////////////// GET SPECIFIC PERMISSION RECORD /////////////////////////////////////////////
    public function getPermissionDetails($id){

        if( !Auth::user()->can('view-permissions')){

            return abort('403'); 
        }

            try{

                $permission = Permission::findorFail($id);

                return response()->json(['message' => 'success', 'data'=>$permission]);

            }
    
            catch (ModelNotFoundException $e){
    
                return response()->json(['message' => 'Permission not found'], 404);
    
            }

        

    }




     

    /////////////////// GET PERMISSION RECORD FOR UPDATE ///////////////////////////////////////////    
    public function getEditPermission($id){

        if( !Auth::user()->can('edit-permissions')){

            return abort('403'); 
        }

            try{

                $permission = Permission::findorFail($id);

                return response()->json(['message' => 'success', 'data'=>$permission]);

            }
    
            catch (ModelNotFoundException $e){
    
                return response()->json(['message' => 'Permission not found'], 404);
    
            }

       

    }







    /////////////////// EDIT PERMISSION RECORD /////////////////////////////////////////////////////
    public function editPermission(EditPermissionRequest $request){

        if( !Auth::user()->can('edit-permissions')){

            return abort('403'); 
        }

            $validated =  $request->validated();

            try{

                //$validated['name'] = strtolower($validated['permission']);
                $validated['name'] = str_replace(' ', '-', strtolower($validated['permission']));

                $permission = Permission::findorFail($validated['permission_id']);

                $permission->update($validated);

                return response()->json(['message' => 'Permission updated successfully']);

            }

            catch (ModelNotFoundException $e){

                return response()->json(['message' => 'Permission not found'], 404);

            }
        
    }

   




    /////////////////// DELETE PERMISSION RECORD //////////////////////////////////////////////////////
    public function deletePermission($id){

        if( !Auth::user()->can('delete-permissions')){

            return abort('403'); 
        }

            try{

                $permission = Permission::findorFail($id);
                $permission->delete();

                return response()->json(['message' => 'Permission deleted successfully.']);

            }
    
            catch (ModelNotFoundException $e){
    
                return response()->json(['message' => 'Permission not found'], 404);
    
            }

        
    }






    /////////////////// SHOW ALL ROLES ////////////////////////////////////////////////////////////////////
    public function getRolesForAssignment(Request $request){


        if( !Auth::user()->can('view-roles')){

            return abort('403'); 
        }   

            if ($request->ajax()) {

               $roles = Role::select('id', 'name', 'guard_name', 'role_reference', 'description', 'created_at', 'is_active')
            ->where('name', '!=', 'super-admin')
            ->orderBy('name', 'asc');

            return Datatables::of($roles)
            ->addIndexColumn()

            ->setRowClass(function ($roles) {
                return $roles->is_active == 0 ? 'table-warning' : '';
            })

            ->editColumn('is_active', function($roles){
                if($roles->is_active == 1){
                    $is_active = "Enabled";
                }
                else{
                    $is_active = "Disabled";
                }
                return ucwords($is_active);
            })

            ->editColumn('name', function ($roles){
                $name = ucwords( str_replace("-", " ", $roles->name));
                return $name;
            })

            ->editColumn('description', function($roles){
                return ucwords($roles->description);
            })
             
            ->editColumn('created_at', function($roles){
                return date("d-m-Y @ H:i:s a", strtotime($roles->created_at));
            }) 

            ->addColumn('actions', function ($row) {

                    $actions = '<div class="d-flex gap-1">';
                    $actions .= 
                        '
                        <a href="/permissions-by-role/'.$row->id.'" class="permission-update-btn" id="'.$row->id.'" title="Assign Tasks">
                            <i class="ri-eye-fill ri-lg"></i>
                        </a>
                        '
                        ;
                    $actions .= '</div>';

                    return $actions;
    
                })
                ->rawColumns(['actions'])
                ->make(true);
    
            }
    
            return view('web.human-resource.assign-role-permissions');
       

    }




    /////////////////// GET ALL ROLE PERMISSIONS ///////////////////////////////////////////////////////////
    public function getPermissionsByRole(Request $request, $role_id){
       
        if( !Auth::user()->can('view-roles') && Auth::user()->can('view-permissions')){

            return abort('403'); 
        }




            $role = Role::select('id', 'role_reference', 'name', 'guard_name')->where('role_reference', $role_id)->first();

            //$id = $role->id;

            //info($role);

            if($role === null){

                return redirect('/roles');
            }

            if ($request->ajax()) {

                $permissions = Permission::select('id', 'name', 'guard_name')->get();

                $permissions = $permissions->diff($role->permissions);

                return Datatables::of($permissions)
                ->addIndexColumn()

                ->editColumn('name', function ($permissions){
                    $name = ucwords( str_replace("-", " ", $permissions->name) );
                    return $name;    
                })

                ->addColumn('checkbox', function($row){
                    return ' <div class="form-check">
                                <input class="form-check-input permission-checkbox" type="checkbox" " id="'.$row->id.'">
                            </div>';
                })

                ->rawColumns(['checkbox'])
                ->make(true);
    
            }
    
            return view('web.human-resource.all-permissions', compact('role'));
       

    }





    /////////////////// ADD PERMISSION RECORD ////////////////////////////////////////////////////////////////////

    public function addPermissionToRole(AssignRolePermissionRequest $request, $role_id){

        $validated = $request->validated();

        if( !Auth::user()->can('assign-role-permissions')){

            return abort(403, "Unauthorized Access"); 
        }

        $role =  Role::where('id', $role_id)->first();

        $permission_list = [];

        foreach($validated['permissions'] as $permission){

            $permission = Permission::select('id', 'name', 'guard_name')->where('id', $permission)->first();

            $role->givePermissionTo($permission->name);
        }

        return response()->json(['message' =>'Permissions assigned successfully']);
    

    }


    
}
