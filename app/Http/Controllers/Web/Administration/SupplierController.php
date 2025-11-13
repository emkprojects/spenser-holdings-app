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
use App\Models\Administration\SupplierType;
use App\Models\Administration\Referrer;
use App\Models\Administration\Customer;
use App\Models\Administration\Supplier;

use App\Models\Settings\Position;

use App\Http\Requests\Web\Administration\AddSupplierRequest;
use App\Http\Requests\Web\Administration\EditSupplierRequest;


class SupplierController extends Controller
{
    


    /////////////////// ALL SUPPLIERS ///////////////////////////////////////////////////////////////////

    public function getSuppliers(Request $request){

        if( !Auth::user()->can('view-suppliers')){

            return abort('403', 'Unauthorized Access');
        }

        if ($request->ajax()) {

            $suppliers = Supplier::leftJoin('user_details', 'user_details.user_id', '=', 'suppliers.created_by')
            ->leftJoin('users', 'users.id', '=', 'suppliers.created_by')
            ->leftJoin('supplier_types', 'suppliers.supplier_type_id', '=', 'supplier_types.id')
            ->leftJoin('positions', 'suppliers.position_id', '=', 'positions.id')
            ->select('suppliers.id', 'suppliers.supplier_type_id', 'suppliers.supplier_reference', 
            'suppliers.supplier', 'suppliers.phone_number', 'suppliers.email_address', 'suppliers.physical_address',
            'suppliers.contact_first_name', 'suppliers.contact_last_name', 'suppliers.contact_phone_number', 'suppliers.contact_email_address', 
            'suppliers.contact_physical_address', 'positions.position', 'suppliers.is_active', 'suppliers.created_at',
            'supplier_types.supplier_type',
            'users.name', 'user_details.first_name', 'user_details.last_name',
            )->orderBy('suppliers.created_at', 'asc');

            return Datatables::of($suppliers)
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

           ->editColumn('supplier', function ($user) {
                $supplier = strtoupper($user->supplier);
                return $supplier;
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

            ->editColumn('supplier_type', function ($user) {
                $supplier_type = ucwords($user->supplier_type);
                return $supplier_type;
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
                
                if( Auth::user()->can('view-suppliers')){

                    $actions .= '<a href="/specific-supplier/'.$row->supplier_reference.'" data-id ="'.$row->supplier_reference.'" id ="'.$row->id.'" class="text-info btn-xl" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                                     
                }

                if( Auth::user()->can('edit-suppliers')){
                    
                    $actions .= '<a href="/edit-supplier/'.$row->supplier_reference.'" data-id ="'.$row->supplier_reference.'" id ="'.$row->id.'" class="text-success btn-xl" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                                  
                }

                if( Auth::user()->can('delete-suppliers')){
                    
                   $actions .= '<a href="javascript:void(0);" data-id ="'.$row->supplier_reference.'" id ="'.$row->supplier_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';
                                  
                } 
                            
                 

                $actions .= '</div>';
                return $actions;

            })
            
            ->rawColumns(['actions'])
            ->make(true);

        }

        return view('web.administration.view-suppliers');
      
    }






    /////////////////// NEW SUPPLIER //////////////////////////////////////////////////////////////////////

    public function getAddSupplier(){

        $user = Auth::user();

        if( !$user->can('add-suppliers')){

            return abort(403, "Unauthorised Access"); 
        }

        $supplier_types = SupplierType::select('id','supplier_type_reference', 'supplier_type')->orderBy('supplier_type', 'asc')->get();

        $positions = Position::select('id','position_reference', 'position')->orderBy('position', 'asc')->get();

        return view('web.administration.add-supplier', compact('supplier_types', 'positions'));

    }





    /////////////////////////////////// ADD SUPPLIER //////////////////////////////////////////////

    public function addsupplier(AddSupplierRequest $request){
       
        $user = Auth::user();

        if( !$user->can('add-suppliers')){

            return abort(403, "Unauthorised Access"); 
        }

        $validated =  $request->validated();

        #info($validated);

        try{

            \DB::beginTransaction();

            $supplier = Supplier::create($validated);
           
            \DB::commit();

            return response()->json(['message' => 'Supplier created successfully']);

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







    /////////////////////////////////// VIEW SUPPLIER //////////////////////////////////////////////
    
    public function viewSupplier($id){

        #$user = Auth::user();

        if( !Auth::user()->can('view-suppliers')){

            return abort(403, "Unauthorised Access"); 
        } 
       
        $supplier = Supplier::leftJoin('user_details', 'user_details.user_id', '=', 'suppliers.created_by')
        ->leftJoin('users', 'users.id', '=', 'suppliers.created_by')
        ->leftJoin('supplier_types', 'suppliers.supplier_type_id', '=', 'supplier_types.id')
        ->leftJoin('positions', 'suppliers.position_id', '=', 'positions.id')
        ->select('suppliers.id', 'suppliers.supplier_type_id', 'suppliers.supplier_reference', 
        'suppliers.national_identification_number', 'suppliers.tax_identification_number', 
        'suppliers.supplier', 'suppliers.phone_number', 'suppliers.email_address', 
        'suppliers.alternative_phone', 'suppliers.alternative_email',
        'suppliers.physical_address',
        'suppliers.contact_first_name', 'suppliers.contact_last_name', 'suppliers.contact_phone_number',
        'suppliers.contact_email_address', 'suppliers.contact_gender', 'suppliers.contact_date_of_birth', 
        'suppliers.contact_alternative_phone', 'suppliers.contact_alternative_email',
        'suppliers.contact_physical_address', 'positions.position', 'suppliers.is_active', 'suppliers.created_at',
        'supplier_types.supplier_type', 'users.name',
        ) ->where('suppliers.supplier_reference', $id)->first();   

        if( date('Y-m-d', strtotime($supplier->contact_date_of_birth)) != "1970-01-01"){

            $target_days = mktime(0, 0, 0, date('m',strtotime($supplier->contact_date_of_birth)), 
            date('d',strtotime($supplier->contact_date_of_birth)), );
            $today = time();
            $diff_days = ($target_days - $today);

            if($diff_days < 0)
            {
                $target_days = mktime(0, 0, 0, date('m',strtotime($supplier->contact_date_of_birth)), 
                date('d',strtotime($supplier->contact_date_of_birth)), date('Y', strtotime('+1 year')) );
                $diff_days = ($target_days - $today);
                $next_supplier_dob = (int)($diff_days/86400). " Days";
            }
            else{

                $next_supplier_dob = (int)($diff_days/86400). " Days";
            
            }

            
            $birth_date = date("Y-m-d", strtotime($supplier->contact_date_of_birth));    
            $current_date = date('Y-m-d');
            $birth_timestamp = strtotime($birth_date);
            $current_timestamp = strtotime($current_date);
            $diff_seconds = $current_timestamp - $birth_timestamp;
            $age_years = $diff_seconds / (60 * 60 * 24 * 365.25);
            $age_years = round($age_years);
            $supplier_age = $age_years . " Years old";

        }
        else{

            $next_supplier_dob = "---";
            $supplier_age = "---";
        }
        
        return view('web.administration.specific-supplier', compact('supplier', 'next_supplier_dob', 'supplier_age'));
    

    }




    //////////////////////////////// EDIT SUPPLIER ////////////////////////////////////////

    public function getUpdateSupplier($id){

        #$user = Auth::user();

        if( !Auth::user()->can('edit-suppliers')){

            return abort(403, "Unauthorised Access"); 
        }  
       
        $supplier = Supplier::leftJoin('user_details', 'user_details.user_id', '=', 'suppliers.created_by')
        ->leftJoin('users', 'users.id', '=', 'suppliers.created_by')
        ->leftJoin('supplier_types', 'suppliers.supplier_type_id', '=', 'supplier_types.id')
        ->leftJoin('positions', 'suppliers.position_id', '=', 'positions.id')
        ->select('suppliers.id', 'suppliers.supplier_type_id', 'suppliers.supplier_reference', 
        'suppliers.national_identification_number', 'suppliers.tax_identification_number', 
        'suppliers.supplier', 'suppliers.phone_number', 'suppliers.email_address', 
        'suppliers.alternative_phone', 'suppliers.alternative_email',
        'suppliers.physical_address',
        'suppliers.contact_first_name', 'suppliers.contact_last_name', 'suppliers.contact_phone_number',
        'suppliers.contact_email_address', 'suppliers.contact_gender', 'suppliers.contact_date_of_birth', 
        'suppliers.contact_alternative_phone', 'suppliers.contact_alternative_email',
        'suppliers.contact_physical_address', 'positions.position', 'suppliers.is_active', 'suppliers.created_at',
        'supplier_types.supplier_type', 'users.name',
        ) ->where('suppliers.supplier_reference', $id)->first();  
        
        $supplier_types = SupplierType::select('id','supplier_type_reference', 'supplier_type')->orderBy('supplier_type', 'asc')->get();

        $positions = Position::select('id','position_reference', 'position')->orderBy('position', 'asc')->get();

        return view('web.administration.edit-supplier', compact('supplier_types', 'positions', 'supplier'));

    
    }





    ////////////////////// EDIT SUPPLIER ///////////////////////////////////////////////////

    public function updateSupplier(EditSupplierRequest $request){

        if( !Auth::user()->can('edit-suppliers')){

            return abort(403, "Unauthorised Access"); 
        }  

        $validated =  $request->validated();

        try{

            \DB::beginTransaction();

            $supplier = Supplier::findorfail($validated['supplier_id']);

            $supplier->update($validated);

            \DB::commit();

            return response()->json(['message' => 'Supplier updated successfully']);

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






    /////////////////////////////////// DELETE SUPPLIER /////////////////////////////////////////////////////
    public function deleteSupplier($id){

        // if(!(Auth::user()->can('delete-suppliers'))){

        //     return redirect("/dashboard");        

        // } 

        if( !Auth::user()->can('delete-suppliers')){

            return abort(403, "Unauthorised Access"); 
        }  

        try{
           
            $supplier = Supplier::where('supplier_reference', $id)->first();
            $supplier = Supplier::findorFail($supplier->id);
            $supplier->delete();

            return response()->json(['message' => 'Supplier deleted successfully.']);

        }

        catch (ModelNotFoundException $e){

            return response()->json(['message' => 'supplier not found'], 404);

        }
       

    }




}
