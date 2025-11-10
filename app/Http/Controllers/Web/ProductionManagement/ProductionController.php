<?php

namespace App\Http\Controllers\Web\ProductionManagement;

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

use App\Models\Administration\Supplier;
use App\Models\Administration\Customer;

use App\Models\InventoryManagement\ItemCategory;
use App\Models\InventoryManagement\Item;
use App\Models\InventoryManagement\Purchase;
use App\Models\InventoryManagement\Expense;

use App\Models\ProductionManagement\InventoryCategory;
use App\Models\ProductionManagement\Inventory;
use App\Models\ProductionManagement\RawMaterial;
use App\Models\ProductionManagement\Production;

class ProductionController extends Controller
{
    


     /////////////////// ALL PRODUCTIONS ///////////////////////////////////////////////////////////////////

    public function getProductions(Request $request){

        if( !Auth::user()->can('view-productions')){

            return abort('403', 'Unauthorized Access');
        }

        if ($request->ajax()) {

            $productions = Production::leftJoin('user_details', 'user_details.user_id', '=', 'productions.user_id')
            ->leftJoin('users', 'users.id', '=', 'productions.user_id')
           ->leftJoin('statuses', 'productions.status_id', '=', 'statuses.id')
          
            ->select('productions.id', 'productions.user_id', 'productions.production_reference', 
            'productions.production_reference_no', 'productions.production', 'productions.description', 
            'productions.created_at', 'productions.is_active', 'productions.supervisor', 'productions.date_of_production',
            'statuses.status', 'users.name', 'user_details.first_name', 'user_details.last_name',
            )->orderBy('productions.created_at', 'asc');

            return Datatables::of($productions)
            ->addIndexColumn()

            ->setRowClass(function ($record) {
                return $record->is_active == 0 ? 'table-warning' : '';
            })

            ->editColumn('is_active', function($record){
                if($record->is_active == 1){
                    $is_active = "Enabled";
                }
                else{
                    $is_active = "Disabled";
                }
                return ucwords($is_active);
            })

            ->editColumn('status', function ($record) {
                $status = strtoupper($record->status);
                return $status;
            })

            ->editColumn('production', function ($record) {
                $production = strtoupper($record->production);
                return $production;
            })

           ->editColumn('production_reference_no', function ($record) {
                $production_reference_no = strtoupper($record->production_reference_no);
                return $production_reference_no;
            })

            ->editColumn('name', function ($record) {
                $name = ucwords($record->name);
                return $name;
            })

            ->editColumn('first_name', function ($record) {
                $first_name = ucwords($record->first_name);
                return $first_name;
            })

            ->editColumn('last_name', function ($record) {
                $last_name = ucwords($record->last_name);
                return $last_name;
            })

            ->editColumn('date_of_production', function($record){
                return date("l F d, Y", strtotime($record->date_of_production));
            }) 

            ->editColumn('created_at', function($record){
                return date("d-m-Y @ H:i:s a", strtotime($record->created_at));
            }) 

            ->addColumn('actions', function ($row) {

                $actions = '<div class="d-flex gap-1">';

                if( Auth::user()->can('add-productions')){

                    $actions .= '<a href="/production-raw-materials/'.$row->production_reference.'" data-id ="'.$row->production_reference.'" id ="'.$row->id.'" class="text-warning btn-xl" title="Add Raw Materials"><i class="icon-base ti tabler-list"></i></a>';
                                     
                }

                if( Auth::user()->can('add-productions')){

                    $actions .= '<a href="/production-ingredients/'.$row->production_reference.'" data-id ="'.$row->production_reference.'" id ="'.$row->id.'" class="text-gray btn-xl" title="Add Ingredients"><i class="icon-base ti tabler-list"></i></a>';
                                     
                }

                if( Auth::user()->can('add-productions')){

                    $actions .= '<a href="/production-products/'.$row->production_reference.'" data-id ="'.$row->production_reference.'" id ="'.$row->id.'" class="text-dark btn-xl" title="Add Products"><i class="icon-base ti tabler-list"></i></a>';
                                     
                }
                
                if( Auth::user()->can('view-productions')){

                    $actions .= '<a href="/specific-production/'.$row->production_reference.'" data-id ="'.$row->production_reference.'" id ="'.$row->id.'" class="text-info btn-xl" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                                     
                }

                if( Auth::user()->can('edit-productions')){
                    
                    $actions .= '<a href="/edit-production/'.$row->production_reference.'" data-id ="'.$row->production_reference.'" id ="'.$row->id.'" class="text-success btn-xl" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                                  
                }

                if( Auth::user()->can('delete-productions')){
                    
                   $actions .= '<a href="javascript:void(0);" data-id ="'.$row->production_reference.'" id ="'.$row->production_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';
                                  
                } 
                            
                 

                $actions .= '</div>';
                return $actions;

            })
            
            ->rawColumns(['actions'])
            ->make(true);

        }

        return view('web.production-management.view-productions');
      
    }


}
