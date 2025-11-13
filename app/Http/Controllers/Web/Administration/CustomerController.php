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

use App\Models\Administration\CustomerType;
use App\Models\Administration\ReferrerType;
use App\Models\Administration\Referrer;
use App\Models\Administration\Customer;
use App\Models\Administration\Supplier;

use App\Models\Settings\Position;

use App\Http\Requests\Web\Administration\AddCustomerRequest;
use App\Http\Requests\Web\Administration\EditCustomerRequest;

class CustomerController extends Controller
{    


    /////////////////// ALL CUSTOMERS ///////////////////////////////////////////////////////////////////

    public function getCustomers(Request $request){

        if( !Auth::user()->can('view-customers')){

            return abort('403', 'Unauthorized Access');
        }

        if ($request->ajax()) {

            $customers = Customer::leftJoin('user_details', 'user_details.user_id', '=', 'customers.created_by')
            ->leftJoin('users', 'users.id', '=', 'customers.created_by')
            ->leftJoin('customer_types', 'customers.customer_type_id', '=', 'customer_types.id')
            ->leftJoin('positions', 'customers.position_id', '=', 'positions.id')
            ->select('customers.id', 'customers.customer_type_id', 'customers.customer_reference', 
            'customers.customer', 'customers.phone_number', 'customers.email_address', 'customers.physical_address',
            'customers.contact_first_name', 'customers.contact_last_name','customers.contact_phone_number', 'customers.contact_email_address', 
            'customers.contact_physical_address', 'positions.position', 'customers.is_active', 'customers.created_at',
            'customer_types.customer_type',
            'users.name', 'user_details.first_name', 'user_details.last_name',
            )->orderBy('customers.created_at', 'asc');

            return Datatables::of($customers)
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

           ->editColumn('customer', function ($user) {
                $customer = strtoupper($user->customer);
                return $customer;
            })

            ->editColumn('first_name', function ($user) {
                $first_name = ucwords($user->first_name);
                return $first_name;
            })

            ->editColumn('last_name', function ($user) {
                $last_name = ucwords($user->last_name);
                return $last_name;
            })

            ->editColumn('position', function ($user) {
                $position = ucwords($user->position);
                return $position;
            })

            ->editColumn('customer_type', function ($user) {
                $customer_type = ucwords($user->customer_type);
                return $customer_type;
            })

            ->editColumn('phone_number', function ($user) {
                $phone_number = isset($user->phone_number) ? "+".$user->phone_number : "N/A";
                return $phone_number;
            })

            ->editColumn('email_address', function ($user) {
                $email_address = isset($user->email_address) ? $user->email_address : "N/A";
                return $email_address;
            })

            ->editColumn('physical_address', function ($user) {
                $physical_address = isset($user->physical_address) ? $user->physical_address : "N/A";
                return $physical_address;
            })
             
            ->editColumn('created_at', function($user){
                return date("d-m-Y @ H:i:s a", strtotime($user->created_at));
            }) 

            ->addColumn('actions', function ($row) {

                $actions = '<div class="d-flex gap-1">';
                
                if( Auth::user()->can('view-customers')){

                    $actions .= '<a href="/specific-customer/'.$row->customer_reference.'" data-id ="'.$row->customer_reference.'" id ="'.$row->id.'" class="text-info btn-xl" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                                     
                }

                if( Auth::user()->can('edit-customers')){
                    
                    $actions .= '<a href="/edit-customer/'.$row->customer_reference.'" data-id ="'.$row->customer_reference.'" id ="'.$row->id.'" class="text-success btn-xl" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                                  
                }

                if( Auth::user()->can('delete-customers')){
                    
                   $actions .= '<a href="javascript:void(0);" data-id ="'.$row->customer_reference.'" id ="'.$row->customer_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';
                                  
                } 
                            
                 

                $actions .= '</div>';
                return $actions;

            })
            
            ->rawColumns(['actions'])
            ->make(true);

        }

        return view('web.administration.view-customers');
      
    }






    /////////////////// NEW CUSTOMER //////////////////////////////////////////////////////////////////////

    public function getAddCustomer(){

        $user = Auth::user();

        if( !$user->can('add-customers')){

            return abort(403, "Unauthorised Access"); 
        }

        $customer_types = CustomerType::select('id','customer_type_reference', 'customer_type')->orderBy('customer_type', 'asc')->get();

        $positions = Position::select('id','position_reference', 'position')->orderBy('position', 'asc')->get();

        $referrer_types = ReferrerType::select('id','referrer_type_reference', 'referrer_type')->orderBy('referrer_type', 'asc')->get();

        $referrers = Referrer::select('id', 'referrer_reference', 'first_name', 'last_name', 'phone_number')->orderBy('first_name', 'asc')->get();

        $customers = Customer::select('id', 'customer_reference', 'customer', 'phone_number')->orderBy('customer', 'asc')->get();

        $suppliers = Supplier::select('id', 'supplier_reference', 'supplier', 'phone_number')->orderBy('supplier', 'asc')->get();

        $users = User::leftJoin('user_details', 'user_details.user_id', '=', 'users.id')
        ->select('users.id', 'users.user_reference', 'users.phone', 'user_details.first_name', 'user_details.last_name')->orderBy('user_details.first_name', 'asc')->get();

        return view('web.administration.add-customer', compact('customer_types', 'positions', 'referrer_types', 'referrers', 'customers', 'suppliers', 'users'));

    }





    /////////////////////////////////// ADD CUSTOMER //////////////////////////////////////////////

    public function addCustomer(AddCustomerRequest $request){
       
        $user = Auth::user();

        if( !$user->can('add-customers')){

            return abort(403, "Unauthorised Access"); 
        }

        $validated =  $request->validated();

        info($validated);

        try{

            \DB::beginTransaction();

            $customer = Customer::create($validated);
           
            \DB::commit();

            return response()->json(['message' => 'Customer created successfully']);

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







    /////////////////////////////////// VIEW CUSTOMER //////////////////////////////////////////////
    
    public function viewCustomer($id){

        #$user = Auth::user();

        if( !Auth::user()->can('view-customers')){

            return abort(403, "Unauthorised Access"); 
        } 
       
        $customer = Customer::leftJoin('user_details', 'user_details.user_id', '=', 'customers.created_by')
        ->leftJoin('users', 'users.id', '=', 'customers.created_by')
        ->leftJoin('customer_types', 'customers.customer_type_id', '=', 'customer_types.id')
        ->leftJoin('positions', 'customers.position_id', '=', 'positions.id')
        ->select('customers.id', 'customers.customer_type_id', 'customers.customer_reference', 
        'customers.national_identification_number', 'customers.tax_identification_number', 
        'customers.customer', 'customers.phone_number', 'customers.email_address',
        'customers.alternative_phone', 'customers.alternative_email',
        'customers.physical_address',
        'customers.contact_first_name', 'customers.contact_last_name', 'customers.contact_phone_number',
        'customers.contact_email_address', 'customers.contact_gender', 'customers.contact_date_of_birth', 
        'customers.contact_alternative_phone', 'customers.contact_alternative_email',
        'customers.contact_physical_address', 'positions.position', 'customers.is_active', 'customers.created_at',
        'customer_types.customer_type',
        'users.name',
        ) ->where('customers.customer_reference', $id)->first();  
        
        if( date('Y-m-d', strtotime($customer->contact_date_of_birth)) != "1970-01-01"){

            $target_days = mktime(0, 0, 0, date('m',strtotime($customer->contact_date_of_birth)), 
            date('d',strtotime($customer->contact_date_of_birth)), date('Y', strtotime('+1 year')) );
            $today = time();
            $diff_days = ($target_days - $today);
            $next_customer_dob = (int)($diff_days/86400). " Days";
            
            $birth_date = date("Y-m-d", strtotime($customer->contact_date_of_birth));    
            $current_date = date('Y-m-d');
            $birth_timestamp = strtotime($birth_date);
            $current_timestamp = strtotime($current_date);
            $diff_seconds = $current_timestamp - $birth_timestamp;
            $age_years = $diff_seconds / (60 * 60 * 24 * 365.25);
            $age_years = round($age_years);
            $customer_age = $age_years . " Years old";

        }
        else{

            $next_customer_dob = "---";
            $customer_age = "---";
        }
                
        return view('web.administration.specific-customer', compact('customer', 'next_customer_dob', 'customer_age'));
    

    }




    //////////////////////////////// EDIT CUSTOMER ////////////////////////////////////////

    public function getEditCustomer($id){

        #$user = Auth::user();

        if( !Auth::user()->can('edit-customers')){

            return abort(403, "Unauthorised Access"); 
        }  
       
         $customer = Customer::leftJoin('user_details', 'user_details.user_id', '=', 'customers.created_by')
        ->leftJoin('users', 'users.id', '=', 'customers.created_by')
        ->leftJoin('customer_types', 'customers.customer_type_id', '=', 'customer_types.id')
        ->select('customers.id', 'customers.customer_type_id', 'customers.customer_reference', 
        'customers.customer', 'customers.phone_number', 'customers.email_address', 'customers.physical_address',
        'customers.contact_full_name', 'customers.contact_phone_number', 'customers.contact_email_address', 
        'customers.contact_physical_address', 'customers.contact_position', 'customers.is_active', 'customers.created_at',
        'users.name', 'user_details.first_name', 'user_details.last_name',
        ) ->where('customers.customer_reference', $id)->first();  
        
        $customer_types = CustomerType::select('id','customer_type_reference', 'customer_type')->orderBy('customer_type', 'asc')->get();

        $positions = Position::select('id','position_reference', 'position')->orderBy('position', 'asc')->get();

        return view('web.administration.edit-customer', compact('customer_types', 'positions', 'customer'));

    
    }





    ////////////////////// EDIT CUSTOMER ///////////////////////////////////////////////////

    public function editCustomer(EditCustomerRequest $request, $id){

        if( !Auth::user()->can('edit-customers')){

            return abort(403, "Unauthorised Access"); 
        }  

        $validated =  $request->validated();

        try{

            \DB::beginTransaction();

            $customer = Customer::findorfail($id);

            $customer->update($validated);

            \DB::commit();

            return response()->json(['message' => 'Customer updated successfully']);

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






    /////////////////////////////////// DELETE CUSTOMER /////////////////////////////////////////////////////
    public function deleteCustomer($id){

        // if(!(Auth::user()->can('delete-customers'))){

        //     return redirect("/dashboard");        

        // } 

        if( !Auth::user()->can('delete-customers')){

            return abort(403, "Unauthorised Access"); 
        }  

        try{
           
            $customer = Customer::where('customer_reference', $id)->first();
            $customer = Customer::findorFail($customer->id);
            $customer->delete();

            return response()->json(['message' => 'Customer deleted successfully.']);

        }

        catch (ModelNotFoundException $e){

            return response()->json(['message' => 'Customer not found'], 404);

        }
       

    }




}
