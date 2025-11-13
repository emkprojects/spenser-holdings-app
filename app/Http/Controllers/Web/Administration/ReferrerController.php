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

use App\Http\Requests\Web\Administration\AddReferrerRequest;
use App\Http\Requests\Web\Administration\EditReferrerRequest;

class ReferrerController extends Controller
{
    

    /////////////////// ALL REFERRER ///////////////////////////////////////////////////////////////////

    public function getReferrers(Request $request){

        if( !Auth::user()->can('view-referrers')){

            return abort('403', 'Unauthorized Access');
        }

        if ($request->ajax()) {

            $referrers = Referrer::leftJoin('user_details', 'user_details.user_id', '=', 'referrers.created_by')
            ->leftJoin('users', 'users.id', '=', 'referrers.created_by')
            ->leftJoin('referrer_types', 'referrers.referrer_type_id', '=', 'referrer_types.id')
            ->select('referrers.id', 'referrers.referrer_type_id', 'referrers.referrer_reference',
            'referrers.first_name', 'referrers.last_name','referrers.phone_number', 'referrers.email_address', 
            'referrers.physical_address', 'referrers.is_active', 'referrers.gender', 'referrers.created_at',
            'referrer_types.referrer_type',
            'users.name'
            )->orderBy('referrers.created_at', 'asc');

            return Datatables::of($referrers)
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

            ->editColumn('referrer_type', function ($user) {
                $referrer_type = ucwords($user->referrer_type);
                return $referrer_type;
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
                
                if( Auth::user()->can('view-referrers')){

                    $actions .= '<a href="/specific-referrer/'.$row->referrer_reference.'" data-id ="'.$row->referrer_reference.'" id ="'.$row->id.'" class="text-info btn-xl" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                                     
                }

                if( Auth::user()->can('edit-referrers')){
                    
                    $actions .= '<a href="/edit-referrer/'.$row->referrer_reference.'" data-id ="'.$row->referrer_reference.'" id ="'.$row->id.'" class="text-success btn-xl" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                                  
                }

                if( Auth::user()->can('delete-referrers')){
                    
                   $actions .= '<a href="javascript:void(0);" data-id ="'.$row->referrer_reference.'" id ="'.$row->referrer_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';
                                  
                } 
                            
                 

                $actions .= '</div>';
                return $actions;

            })
            
            ->rawColumns(['actions'])
            ->make(true);

        }

        return view('web.administration.view-referrers');
      
    }






    /////////////////// NEW REFERRER //////////////////////////////////////////////////////////////////////

    public function getAddReferrer(){

        $user = Auth::user();

        if( !$user->can('add-referrers')){

            return abort(403, "Unauthorised Access"); 
        }

        $referrer_types = ReferrerType::where('referrer_type', 'Others')->select('id','referrer_type_reference', 'referrer_type')->orderBy('referrer_type', 'asc')->get();

        return view('web.administration.add-referrer', compact('referrer_types'));

    }





    /////////////////////////////////// ADD REFERRER //////////////////////////////////////////////

    public function addReferrer(AddReferrerRequest $request){
       
        $user = Auth::user();

        if( !$user->can('add-referrers')){

            return abort(403, "Unauthorised Access"); 
        }

        $validated =  $request->validated();

        #info($validated);

        try{

            \DB::beginTransaction();

            $referrer = Referrer::create($validated);
           
            \DB::commit();

            return response()->json(['message' => 'Referrer created successfully']);

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







    /////////////////////////////////// VIEW REFERRER //////////////////////////////////////////////
    
    public function viewReferrer($id){

        #$user = Auth::user();

        if( !Auth::user()->can('view-referrers')){

            return abort(403, "Unauthorised Access"); 
        } 
       
        $referrer = Referrer::leftJoin('user_details', 'user_details.user_id', '=', 'referrers.created_by')
        ->leftJoin('users', 'users.id', '=', 'referrers.created_by')
        ->leftJoin('referrer_types', 'referrers.referrer_type_id', '=', 'referrer_types.id')
        ->select('referrers.id', 'referrers.referrer_type_id', 'referrers.referrer_reference', 
        'referrers.national_identification_number', 'referrers.tax_identification_number', 
        'referrers.first_name', 'referrers.last_name',  'referrers.other_name', 
        'referrers.phone_number', 'referrers.alternative_phone', 'referrers.alternative_email',
        'referrers.email_address', 'referrers.gender', 'referrers.date_of_birth',
        'referrers.physical_address', 'referrers.is_active', 'referrers.created_at',
        'referrer_types.referrer_type', 'users.name',
        ) ->where('referrers.referrer_reference', $id)->first();  
        
        
        if( date('Y-m-d', strtotime($referrer->date_of_birth)) != "1970-01-01"){

            $target_days = mktime(0, 0, 0, date('m',strtotime($referrer->date_of_birth)), 
            date('d',strtotime($referrer->date_of_birth)), );
            $today = time();
            $diff_days = ($target_days - $today);

            if($diff_days < 0)
            {
                $target_days = mktime(0, 0, 0, date('m',strtotime($referrer->date_of_birth)), 
                date('d',strtotime($referrer->date_of_birth)), date('Y', strtotime('+1 year')) );
                $diff_days = ($target_days - $today);
                $next_referrer_dob = (int)($diff_days/86400). " Days";
            }
            else{

                $next_referrer_dob = (int)($diff_days/86400). " Days";
            
            }

            $birth_date = date("Y-m-d", strtotime($referrer->date_of_birth));    
            $current_date = date('Y-m-d');
            $birth_timestamp = strtotime($birth_date);
            $current_timestamp = strtotime($current_date);
            $diff_seconds = $current_timestamp - $birth_timestamp;
            $age_years = $diff_seconds / (60 * 60 * 24 * 365.25);
            $age_years = round($age_years);
            $referrer_age = $age_years . " Years old";

        }
        else{

            $next_referrer_dob = "---";
            $referrer_age = "---";
        }
        
        return view('web.administration.specific-referrer', compact('referrer', 'next_referrer_dob', 'referrer_age'));
    

    }




    //////////////////////////////// EDIT REFERRER ////////////////////////////////////////

    public function getUpdateReferrer($id){

        #$user = Auth::user();

        if( !Auth::user()->can('edit-referrers')){

            return abort(403, "Unauthorised Access"); 
        }  
       
         $referrer = Referrer::leftJoin('user_details', 'user_details.user_id', '=', 'referrers.created_by')
        ->leftJoin('users', 'users.id', '=', 'referrers.created_by')
        ->leftJoin('referrer_types', 'referrers.referrer_type_id', '=', 'referrer_types.id')
        ->select('referrers.id', 'referrers.referrer_type_id', 'referrers.referrer_reference', 
        'referrers.national_identification_number', 'referrers.tax_identification_number', 
        'referrers.first_name', 'referrers.last_name',  'referrers.other_name', 
        'referrers.phone_number', 'referrers.alternative_phone', 'referrers.alternative_email',
        'referrers.email_address', 'referrers.gender', 'referrers.date_of_birth',
        'referrers.physical_address', 'referrers.is_active', 'referrers.created_at',
        'referrer_types.referrer_type', 'users.name',
        ) ->where('referrers.referrer_reference', $id)->first();  
        
        $referrer_types = ReferrerType::where('referrer_type', 'Others')->select('id','referrer_type_reference', 'referrer_type')->orderBy('referrer_type', 'asc')->get();

        return view('web.administration.edit-referrer', compact('referrer_types', 'referrer'));

    
    }





    ////////////////////// EDIT REFERRER ///////////////////////////////////////////////////

    public function updateReferrer(EditReferrerRequest $request){

        if( !Auth::user()->can('edit-referrers')){

            return abort(403, "Unauthorised Access"); 
        }  

        $validated =  $request->validated();

        try{

            \DB::beginTransaction();

            $referrer = Referrer::findorfail($validated['referrer_id']);

            $referrer->update($validated);

            \DB::commit();

            return response()->json(['message' => 'Referrer updated successfully']);

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






    /////////////////////////////////// DELETE REFERRER /////////////////////////////////////////////////////
    public function deleteReferrer($id){

        // if(!(Auth::user()->can('delete-referrers'))){

        //     return redirect("/dashboard");        

        // } 

        if( !Auth::user()->can('delete-referrers')){

            return abort(403, "Unauthorised Access"); 
        }  

        try{
           
            $referrer = Referrer::where('referrer_reference', $id)->first();
            $referrer = Referrer::findorFail($referrer->id);
            $referrer->delete();

            return response()->json(['message' => 'Referrer deleted successfully.']);

        }

        catch (ModelNotFoundException $e){

            return response()->json(['message' => 'Referrer not found'], 404);

        }
       

    }




}
