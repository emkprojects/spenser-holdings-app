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

use App\Models\ProductionManagement\InventoryCategory;
use App\Models\ProductionManagement\Inventory;
use App\Models\ProductionManagement\RawMaterial;

class InventoryController extends Controller
{
    


    /////////////////// ALL ITEMS ///////////////////////////////////////////////////////////////////

    public function getItems(Request $request){

        if( !Auth::user()->can('view-items')){

            return abort('403', 'Unauthorized Access');
        }

        if ($request->ajax()) {

            $items = Item::leftJoin('user_details', 'user_details.user_id', '=', 'items.user_id')
            ->leftJoin('users', 'users.id', '=', 'items.user_id')
            ->leftJoin('suppliers', 'items.supplier_id', '=', 'suppliers.id')
            ->leftJoin('statuses', 'items.status_id', '=', 'statuses.id')
            ->leftJoin('item_categories', 'items.item_category_id', '=', 'item_categories.id')

            ->select('items.id', 'items.user_id', 'items.item_category_id', 'items.item_reference', 
            'items.item', 'items.description', 'items.physical_stock', 'items.current_stock', 'items.minimum_stock', 
            'items.amount', 'items.is_active',
            'item_categories.item_category', 'suppliers.supplier', 'statuses.status',
            'users.name', 'user_details.first_name', 'user_details.last_name',
            )->orderBy('items.created_at', 'asc');

            return Datatables::of($items)
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

            ->editColumn('item', function ($record) {
                $item = strtoupper($record->item);
                return $item;
            })

           ->editColumn('supplier', function ($record) {
                $supplier = strtoupper($record->supplier);
                return $supplier;
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

            ->editColumn('item_category', function ($record) {
                $item_category = ucwords($record->item_category);
                return $item_category;
            })

            ->editColumn('created_at', function($record){
                return date("d-m-Y @ H:i:s a", strtotime($record->created_at));
            }) 

            ->editColumn('current_stock', function ($record) {
                $current_stock = number_format($record->current_stock, 0);
                return $current_stock;
            })

            ->editColumn('minimum_stock', function ($record) {
                $minimum_stock = number_format($record->minimum_stock, 0);
                return $minimum_stock;
            })


            ->editColumn('amount', function ($record) {
                $amount = number_format($record->amount, 2);
                return $amount;
            })

            ->addColumn('total_amount', function ($record) {
                $total_amount = number_format(($record->amount * $record->current_stock), 2);
                return $total_amount;
            })

            ->addColumn('actions', function ($row) {

                $actions = '<div class="d-flex gap-1">';
                
                if( Auth::user()->can('view-items')){

                    $actions .= '<a href="/specific-item/'.$row->item_reference.'" data-id ="'.$row->item_reference.'" id ="'.$row->id.'" class="text-info btn-xl" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                                     
                }

                if( Auth::user()->can('edit-items')){
                    
                    $actions .= '<a href="/edit-item/'.$row->item_reference.'" data-id ="'.$row->item_reference.'" id ="'.$row->id.'" class="text-success btn-xl" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                                  
                }

                if( Auth::user()->can('delete-items')){
                    
                   $actions .= '<a href="javascript:void(0);" data-id ="'.$row->item_reference.'" id ="'.$row->item_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';
                                  
                } 
                            
                 

                $actions .= '</div>';
                return $actions;

            })
            
            ->rawColumns(['actions'])
            ->make(true);

        }

        return view('web.inventory-management.view-items');
      
    }












    /////////////////// ALL INVENTORIES ///////////////////////////////////////////////////////////////////

    public function getInventories(Request $request){

        if( !Auth::user()->can('view-inventories')){

            return abort('403', 'Unauthorized Access');
        }

        if ($request->ajax()) {

            $inventories = Inventory::leftJoin('user_details', 'user_details.user_id', '=', 'inventories.user_id')
            ->leftJoin('users', 'users.id', '=', 'inventories.user_id')
            ->leftJoin('purchases', 'inventories.purchase_id', '=', 'purchases.id')
            ->leftJoin('statuses', 'inventories.status_id', '=', 'statuses.id')
            ->leftJoin('items', 'purchases.item_id', '=', 'items.id')
            ->leftJoin('raw_materials', 'inventories.raw_material_id', '=', 'raw_materials.id')
            ->leftJoin('inventory_categories', 'raw_materials.inventory_category_id', '=', 'inventory_categories.id')

            ->select('inventories.id', 'inventories.user_id', 'inventories.raw_material_id', 'inventories.inventory_reference', 
            'inventories.inventory', 'inventories.description', 'inventories.physical_stock', 
            'inventories.current_stock', 'inventories.is_active', 'inventories.date_of_inventory',
            'purchases.purchase', 'items.item', 'raw_materials.raw_material', 'inventory_categories.inventory_category', 'statuses.status',
            'users.name', 'user_details.first_name', 'user_details.last_name',
            )->orderBy('inventories.created_at', 'asc');

            return Datatables::of($inventories)
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

            ->editColumn('item', function ($record) {
                $item = strtoupper($record->item);
                return $item;
            })

           ->editColumn('raw_material', function ($record) {
                $raw_material = strtoupper($record->raw_material);
                return $raw_material;
            })

            ->editColumn('inventory_category', function ($record) {
                $inventory_category = ucwords($record->inventory_category);
                return $inventory_category;
            })
            
            ->editColumn('purchase', function ($record) {
                $purchase = ucwords($record->purchase);
                return $purchase;
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

            ->editColumn('date_of_inventory', function($record){
                return date("l F d, Y", strtotime($record->date_of_inventory));
            })

            ->editColumn('current_stock', function ($record) {
                $current_stock = number_format($record->current_stock, 0);
                return $current_stock;
            })

            ->editColumn('physical_stock', function ($record) {
                $physical_stock = number_format($record->physical_stock, 0);
                return $physical_stock;
            })

            ->addColumn('actions', function ($row) {

                $actions = '<div class="d-flex gap-1">';
                
                if( Auth::user()->can('view-inventories')){

                    $actions .= '<a href="/specific-inventory/'.$row->inventory_reference.'" data-id ="'.$row->inventory_reference.'" id ="'.$row->id.'" class="text-info btn-xl" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                                     
                }

                if( Auth::user()->can('edit-inventories')){
                    
                    $actions .= '<a href="/edit-inventory/'.$row->inventory_reference.'" data-id ="'.$row->inventory_reference.'" id ="'.$row->id.'" class="text-success btn-xl" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                                  
                }

                if( Auth::user()->can('delete-inventories')){
                    
                   $actions .= '<a href="javascript:void(0);" data-id ="'.$row->inventory_reference.'" id ="'.$row->inventory_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';
                                  
                } 
                            
                 

                $actions .= '</div>';
                return $actions;

            })
            
            ->rawColumns(['actions'])
            ->make(true);

        }

        return view('web.production-management.view-inventories');
      
    }






    
    /////////////////// ALL RAW MATERIALS ///////////////////////////////////////////////////////////////////

    public function getRawMaterials(Request $request){

        if( !Auth::user()->can('view-raw-materials')){

            return abort('403', 'Unauthorized Access');
        }

        if ($request->ajax()) {

            $raw_materials = RawMaterial::leftJoin('user_details', 'user_details.user_id', '=', 'raw_materials.user_id')
            ->leftJoin('users', 'users.id', '=', 'raw_materials.user_id')
            ->leftJoin('statuses', 'raw_materials.status_id', '=', 'statuses.id')
            ->leftJoin('inventory_categories', 'inventory_categories.id', '=', 'raw_materials.inventory_category_id')

            ->select('raw_materials.id', 'raw_materials.user_id', 'raw_materials.inventory_category_id', 'raw_materials.raw_material_reference', 
            'raw_materials.raw_material', 'raw_materials.description', 'raw_materials.physical_stock', 
            'raw_materials.current_stock', 'raw_materials.minimum_stock', 'raw_materials.is_active',
            'inventory_categories.inventory_category', 'raw_materials.created_at',
             'statuses.status', 'users.name', 'user_details.first_name', 'user_details.last_name',
            )->orderBy('raw_materials.created_at', 'asc');

            return Datatables::of($raw_materials)
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

            ->editColumn('item', function ($record) {
                $item = strtoupper($record->item);
                return $item;
            })

           ->editColumn('raw_material', function ($record) {
                $raw_material = strtoupper($record->raw_material);
                return $raw_material;
            })
            
            ->editColumn('inventory_category', function ($record) {
                $inventory_category = ucwords($record->inventory_category);
                return $inventory_category;
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

            ->editColumn('current_stock', function ($record) {
                $current_stock = number_format($record->current_stock, 0);
                return $current_stock;
            })

            ->editColumn('physical_stock', function ($record) {
                $physical_stock = number_format($record->physical_stock, 0);
                return $physical_stock;
            })

            ->editColumn('minimum_stock', function ($record) {
                $minimum_stock = number_format($record->minimum_stock, 0);
                return $minimum_stock;
            })

            ->addColumn('actions', function ($row) {

                $actions = '<div class="d-flex gap-1">';
                
                if( Auth::user()->can('view-raw-materials')){

                    $actions .= '<a href="/specific-raw-material/'.$row->raw_material_reference.'" data-id ="'.$row->raw_material_reference.'" id ="'.$row->id.'" class="text-info btn-xl" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                                     
                }

                if( Auth::user()->can('edit-raw-materials')){
                    
                    $actions .= '<a href="/edit-raw-material/'.$row->raw_material_reference.'" data-id ="'.$row->raw_material_reference.'" id ="'.$row->id.'" class="text-success btn-xl" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                                  
                }

                if( Auth::user()->can('delete-raw-materials')){
                    
                   $actions .= '<a href="javascript:void(0);" data-id ="'.$row->raw_material_reference.'" id ="'.$row->raw_material_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';
                                  
                } 
                            
                 

                $actions .= '</div>';
                return $actions;

            })
            
            ->rawColumns(['actions'])
            ->make(true);

        }

        return view('web.production-management.view-raw-materials');
      
    }






}
