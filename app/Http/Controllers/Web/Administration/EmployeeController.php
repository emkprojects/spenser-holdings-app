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

use App\Models\Settings\Position;

use App\Http\Requests\Web\HumanResource\AddUserRequest;
use App\Http\Requests\Web\HumanResource\EditUserRequest;

class EmployeeController extends Controller
{
    
  

    

    /////////////////// ALL EMPLOYEES ///////////////////////////////////////////////////////////////////

    public function getEmployees(Request $request){

        if( !Auth::user()->can('view-users')){

            return abort('403', 'Unauthorized access');
        }

        if ($request->ajax()) {

            $users = User::leftJoin('user_details', 'user_details.user_id', '=', 'users.id')
            ->leftJoin('user_statuses', 'user_statuses.id', '=', 'users.user_status_id')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->leftJoin('positions', 'users.position_id', '=', 'positions.id')
            ->select('users.id', 'users.user_status_id', 'users.user_reference', 'users.email', 'users.phone',
            'users.created_at', 'users.is_active', 'user_details.first_name', 'user_details.last_name', 'user_details.other_name',
            'user_details.gender', 'user_details.date_of_birth', 'user_details.physical_address',
            'user_details.national_identification_number', 'user_statuses.user_status', 'roles.name', 'positions.position',
            )
            ->where('roles.name', '!=', 'super-admin')
            ->orderBy('users.created_at', 'asc');

            return Datatables::of($users)
            ->addIndexColumn()

            ->setRowClass(function ($user) {
                return $user->is_active == 0 ? 'table-warning' : '';
            })

            ->editColumn('is_active', function($user){
                if($user->is_active == 1){
                    $is_active = "Enabled";
                }
                else{
                    $is_active = "Disabled";
                }
                return ucwords($is_active);
            })

           ->addColumn('full_name', function ($user) {
                $full_name = $user->first_name. " ". $user->last_name;
                return $full_name;
            })

            ->editColumn('gender', function ($user) {
                $gender = isset($user->gender) ? ucwords($user->gender) : "N/A";
                return $gender;
            })

            ->editColumn('current_position', function ($user) {
                $current_position = isset($user->current_position) ? ucwords($user->current_position) : "N/A";
                return $current_position;
            })

            ->editColumn('name', function ($user) {
                $name = ucwords($user->name);
                return $name;
            })
            
            ->editColumn('date_of_birth', function ($user) {
                $date_of_birth = isset($user->date_of_birth) ? date("l F d, Y", strtotime($user->date_of_birth)) : "N/A";
                return $date_of_birth;
            })

            ->editColumn('phone', function ($user) {
                $phone = isset($user->phone) ? "+".$user->phone : "N/A";
                return $phone;
            })

            ->editColumn('email', function ($user) {
                $email = isset($user->email) ? $user->email : "N/A";
                return $email;
            })

            ->editColumn('user_status', function ($user) {

                if($user->user_status == "Active"){

                    #return '<span class="badge bg-info">Active</span>';
                    return "Active";
                }
                else if($user->user_status == "Suspended"){

                    #return '<span class="badge bg-warning">Suspended</span>';
                    return "Suspended";

                }
                else if($user->user_status == "Deactivated"){

                    #return '<span class="badge bg-danger">Deactivated</span>';
                    return "Deactivated";

                }
                else {

                #return '<span class="badge bg-dark">Contact Support</span>';
                return "N/A";

                }

            })
             
            ->editColumn('created_at', function($user){
                return date("d-m-Y @ H:i:s a", strtotime($user->created_at));
            }) 

            ->addColumn('actions', function ($row) {

                $actions = '<div class="d-flex gap-1">';
                
                if( Auth::user()->can('view-users')){

                    $actions .= '<a href="/specific-employee/'.$row->user_reference.'" data-id ="'.$row->user_reference.'" id ="'.$row->id.'" class="text-info btn-xl" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                                     
                }

                if( Auth::user()->can('edit-users')){
                    
                    $actions .= '<a href="/edit-employee/'.$row->user_reference.'" data-id ="'.$row->user_reference.'" id ="'.$row->id.'" class="text-success btn-xl" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                                  
                }

                if( Auth::user()->can('delete-users')){
                    
                   $actions .= '<a href="javascript:void(0);" data-id ="'.$row->user_reference.'" id ="'.$row->user_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';
                                  
                } 
                
                
                // if( Auth::user()->can('ban-users')){
                    
                //    $actions .= '<a href="/permissions-by-role/'.$row->user_reference.'" class="text-secondary btn-xl assign-btn" id="'.$row->id.'" title="Assign Permissions">
                //             <i class="icon-base ti tabler-eye"></i></a>';
                                  
                // } 
                
                 

                $actions .= '</div>';
                return $actions;

            })
            
            ->rawColumns(['actions'])
            ->make(true);

        }

        return view('web.human-resource.view-users');
      
    }






    /////////////////// NEW EMPLOYEE //////////////////////////////////////////////////////////////////////

    public function getAddEmployee(){

        $user = Auth::user();

        if( !$user->can('add-users')){

            return abort(403, "Unauthorised Access"); 
        }

         
        $roles = Role::select('id','role_reference', 'name')->orderBy('name', 'asc')->get();

        $positions = Position::select('id','position_reference', 'position')->orderBy('position', 'asc')->get();

        $user_statuses = UserStatus::select('id','user_status_reference', 'user_status')->orderBy('user_status', 'asc')->get();

        return view('web.human-resource.add-user', compact('roles', 'positions', 'user_statuses'));

    }





    /////////////////////////////////// ADD EMPLOYEE //////////////////////////////////////////////

    public function addEmployee(AddUserRequest $request){
       
        $user = Auth::user();

        if( !$user->can('add-users')){

            return abort(403, "Unauthorised Access"); 
        }

        $validated =  $request->validated();

        $password =  Str::password(8, true, true, false, false);

        $validated['password'] = $password;
       
        // Generate Username 
        $validated['name'] = strtolower(substr($validated['first_name'], 0, 1).''.$validated['last_name']);

        $status =  UserStatus::where('user_status', 'Active')->first();

        info($validated);

        try{

            \DB::beginTransaction();

            $validated['user_status_id'] = $status->id;

            $employee = User::create($validated);

            $validated['user_id'] = $employee->id;
           
            $employee_details = UserDetail::create($validated);

            $employee_role =  $employee->roles()->attach($validated['role_id']);

            #SendUserWelcomeEmailJob::dispatch($employee, $employee_details, $validated['password']);

            \DB::commit();

            return response()->json(['message' => 'Employee created successfully']);

        }
        catch(\Exception $e){
        
            \DB::rollBack();

            Log::Error($e->getMessage());

            $error_message = array('server_error' => array( $e->getMessage() ));
            return response()->json([
                'message' => 'The given data was invalid',
                'errors' => $error_message
            ], 422);
            
        }

    
    }







    /////////////////////////////////// VIEW EMPLOYEE //////////////////////////////////////////////
    
    public function viewEmployee($id){

        #$user = Auth::user();

        if( !Auth::user()->can('view-users')){

            return abort(403, "Unauthorised Access"); 
        } 
       
        $user = User::leftJoin('user_details', 'user_details.user_id', '=', 'users.id')
        ->leftJoin('user_statuses', 'user_statuses.id', '=', 'users.user_status_id')
        ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
        ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->leftJoin('positions', 'users.position_id', '=', 'positions.id')
        ->select('users.id', 'users.user_status_id', 'users.user_reference', 'users.name', 'users.email', 'users.phone',
        'users.created_at', 'users.is_active', 'user_details.first_name', 'user_details.last_name', 'user_details.other_name',
        'user_details.alternative_phone', 'user_details.alternative_email',
        'user_details.gender', 'user_details.date_of_birth', 'user_details.physical_address',
        'user_details.national_identification_number', 'user_statuses.user_status', 'roles.name AS role', 'positions.position',
        )
        ->where('roles.name', '!=', 'super-admin')
        ->where('users.user_reference', $id)->first();   
        

        return view('web.human-resource.specific-user', compact('user'));
    

    }




    //////////////////////////////// EDIT EMPLOYEE ////////////////////////////////////////

    public function getEditEmployee($id){

        #$user = Auth::user();

        if( !Auth::user()->can('edit-users')){

            return abort(403, "Unauthorised Access"); 
        }  
       
        $user = User::leftJoin('user_details', 'user_details.user_id', '=', 'users.id')
        ->leftJoin('user_statuses', 'user_statuses.id', '=', 'users.user_status_id')
        ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
        ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->leftJoin('positions', 'users.position_id', '=', 'positions.id')
        ->select('users.id', 'users.user_status_id', 'users.position_id', 'model_has_roles.role_id',  'users.user_reference', 'users.email', 'users.phone',
        'users.created_at', 'users.is_active', 'user_details.first_name', 'user_details.last_name', 'user_details.other_name',
        'user_details.gender', 'user_details.date_of_birth', 'user_details.physical_address',
        'user_details.national_identification_number', 'user_statuses.user_status', 'roles.name', 'positions.position',
        )
        ->where('roles.name', '!=', 'super-admin')
        ->where('users.user_reference', $id)->first();   
        
        $roles = Role::select('id','role_reference', 'name')->orderBy('name', 'asc')->get();

        $positions = Position::select('id','position_reference', 'position')->orderBy('position', 'asc')->get();

        $user_statuses = UserStatus::select('id','user_status_reference', 'user_status')->orderBy('user_status', 'asc')->get();

        return view('web.human-resource.edit-user', compact('user', 'roles', 'positions', 'user_statuses'));

    
    }





    ////////////////////// EDIT EMPLOYEE ///////////////////////////////////////////////////

    public function editEmployee(EditUserRequest $request, $id){

        if( !Auth::user()->can('edit-users')){

            return abort(403, "Unauthorised Access"); 
        }  

        $validated =  $request->validated();

        $validated['name'] = strtolower(substr($validated['first_name'], 0, 1).''.$validated['last_name']);

        try{

            \DB::beginTransaction();

            $employee = User::findorfail($id);

            $employee->update($validated);

            $employee_role =  $employee->roles()->sync($validated['role_id']);                   
            
            $employee_details = UserDetail::where('user_id', $validated['user_id'])->first();
            $employee_details = UserDetail::findorFail($employee_details->id);
            $employee_details->update($validated);        
                    
            \DB::commit();

            return response()->json(['message' => 'Employee updated successfully']);

        }
        catch(\Exception $e){
        
            \DB::rollBack();

            Log::Error($e->getMessage());

            $error_message = array('server_error' => array( $e->getMessage() ));
            return response()->json([
                'message' => 'The given data was invalid',
                'errors' => $error_message
            ], 422);
            
        }
        
           
    }






    /////////////////////////////////// DELETE EMPLOYEE RECORD /////////////////////////////////////////////////////
    public function deleteEmployee($id){

        // if(!(Auth::user()->can('delete-users'))){

        //     return redirect("/dashboard");        

        // } 

        if( !Auth::user()->can('delete-users')){

            return abort(403, "Unauthorised Access"); 
        }  

        try{

            $user = User::where('user_reference', $id)->first();

            info($user);
            
            // $employee_detail = UserDetail::where('id', 3)->first();
            // info($employee_detail);
            // // $employee_details = UserDetail::findorFail($employee_detail->id);
            // // $employee_details->delete();

            $employee = User::where('id', $user->id)->first();
            $employees = User::findorFail($user->id);
            $employees->delete();

            return response()->json(['message' => 'Employee deleted successfully.']);

        }

        catch (ModelNotFoundException $e){

            return response()->json(['message' => 'Employee not found'], 404);

        }
       

    }




}
