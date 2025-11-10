<?php

namespace App\Http\Controllers\Web\InventoryManagement;

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

class PurchaseController extends Controller
{
    



    /////////////////// ALL PURCHASES ///////////////////////////////////////////////////////////////////

    public function getPurchases(Request $request){

        if( !Auth::user()->can('view-purchases')){

            return abort('403', 'Unauthorized Access');
        }

        if ($request->ajax()) {

            $purchases = Purchase::leftJoin('user_details', 'user_details.user_id', '=', 'purchases.user_id')
            ->leftJoin('users', 'users.id', '=', 'purchases.user_id')
            ->leftJoin('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
            ->leftJoin('statuses', 'purchases.status_id', '=', 'statuses.id')
            ->leftJoin('items', 'purchases.item_id', '=', 'items.id')
            ->select('purchases.id', 'purchases.user_id', 'purchases.item_id', 'purchases.purchase_reference', 
            'purchases.manufacture_date', 'purchases.expiry_date', 'purchases.date_of_purchase', 'purchases.quantity', 
            'purchases.unit_cost', 'purchases.is_active', 'purchases.created_at',
            'items.item', 'suppliers.supplier', 'statuses.status',
            'users.name', 'user_details.first_name', 'user_details.last_name',
            )->orderBy('purchases.created_at', 'asc');

            return Datatables::of($purchases)
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

            ->editColumn('purchase', function ($record) {
                $purchase = strtoupper($record->purchase);
                return $purchase;
            })

           ->editColumn('item', function ($record) {
                $item = strtoupper($record->item);
                return $item;
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
            
            ->editColumn('created_at', function($record){
                return date("d-m-Y @ H:i:s a", strtotime($record->created_at));
            }) 

            ->editColumn('date_of_purchase', function($record){
                return date("l F d, Y", strtotime($record->date_of_purchase));
            }) 

            ->editColumn('quantity', function ($record) {
                $quantity = number_format($record->quantity, 0);
                return $quantity;
            })

            ->editColumn('unit_cost', function ($record) {
                $unit_cost = number_format($record->unit_cost, 2);
                return $unit_cost;
            })

            ->addColumn('total_amount', function ($record) {
                $total_amount = number_format(($record->unit_cost * $record->quantity), 2);
                return $total_amount;
            })

            ->addColumn('actions', function ($row) {

                $actions = '<div class="d-flex gap-1">';
                
                if( Auth::user()->can('view-purchases')){

                    $actions .= '<a href="/specific-purchase/'.$row->purchase_reference.'" data-id ="'.$row->purchase_reference.'" id ="'.$row->id.'" class="text-info btn-xl" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                                     
                }

                if( Auth::user()->can('edit-purchases')){
                    
                    $actions .= '<a href="/edit-purchase/'.$row->purchase_reference.'" data-id ="'.$row->purchase_reference.'" id ="'.$row->id.'" class="text-success btn-xl" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                                  
                }

                if( Auth::user()->can('delete-purchases')){
                    
                   $actions .= '<a href="javascript:void(0);" data-id ="'.$row->purchase_reference.'" id ="'.$row->purchase_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';
                                  
                } 
                            
                 

                $actions .= '</div>';
                return $actions;

            })
            
            ->rawColumns(['actions'])
            ->make(true);

        }

        return view('web.inventory-management.view-purchases');
      
    }






    /////////////////// NEW PURCHASE //////////////////////////////////////////////////////////////////////

    public function getAddPurchase(){

        $user = Auth::user();

        if( !$user->can('add-purchases')){

            return abort(403, "Unauthorised Access"); 
        }

        $customer_types = ItemCategory::select('id','item_category_reference', 'item_category')->orderBy('item_category', 'asc')->get();

        $items = Item::select('id','item_reference', 'item')->orderBy('item', 'asc')->get();

        return view('web.inventory-management.add-purchase', compact('item_categories', 'items'));

    }




}
