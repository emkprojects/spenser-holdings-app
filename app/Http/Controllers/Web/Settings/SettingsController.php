<?php

namespace App\Http\Controllers\Web\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

use DataTables;
use DB;
use Log;
use Auth;
use Str;
use Carbon\Carbon;

use App\Models\Settings\Group;
use App\Models\Settings\Category;
use App\Models\Settings\Status;
use App\Models\Settings\Currency;
use App\Models\Settings\PaymentMethod;
use App\Models\Settings\Metric;
use App\Models\Settings\SubCategory;

use App\Models\InventoryManagement\ItemCategory;
use App\Models\ProductionManagement\ProductCategory;
use App\Models\ProductionManagement\InventoryCategory;
use App\Models\Administration\CustomerType;
use App\Models\Administration\SupplierType;

use App\Http\Requests\Web\Settings\AddGroupRequest;
use App\Http\Requests\Web\Settings\EditGroupRequest;
use App\Http\Requests\Web\Settings\AddCategoryRequest;
use App\Http\Requests\Web\Settings\EditCategoryRequest;
use App\Http\Requests\Web\Settings\AddStatusRequest;
use App\Http\Requests\Web\Settings\EditStatusRequest;
use App\Http\Requests\Web\Settings\AddCurrencyRequest;
use App\Http\Requests\Web\Settings\EditCurrencyRequest;
use App\Http\Requests\Web\Settings\AddPaymentMethodRequest;
use App\Http\Requests\Web\Settings\EditPaymentMethodRequest;
use App\Http\Requests\Web\Settings\AddMetricRequest;
use App\Http\Requests\Web\Settings\EditMetricRequest;

use App\Http\Requests\Web\InventoryManagement\AddItemCategoryRequest;
use App\Http\Requests\Web\InventoryManagement\EditItemCategoryRequest;
use App\Http\Requests\Web\ProductionManagement\AddInventoryCategoryRequest;
use App\Http\Requests\Web\ProductionManagement\EditInventoryCategoryRequest;
use App\Http\Requests\Web\ProductionManagement\AddProductCategoryRequest;
use App\Http\Requests\Web\ProductionManagement\EditProductCategoryRequest;
use App\Http\Requests\Web\Administration\AddSupplierTypeRequest;
use App\Http\Requests\Web\Administration\EditSupplierTypeRequest;
use App\Http\Requests\Web\Administration\AddCustomerTypeRequest;
use App\Http\Requests\Web\Administration\EditCustomerTypeRequest;


class SettingsController extends Controller
{
    




    ////////////////////////////////////// Customer Types ///////////////////////////////////////////////////////

    public function getCustomerTypes(Request $request){

        if( !Auth::user()->can('view-customer-types')){

            return abort(403); 
        }

        if ($request->ajax()) {

            $customer_types = CustomerType::leftJoin('users', 'customer_types.created_by', '=', 'users.id')
             //->where('customer_types.is_active', 1)
            ->select('customer_types.id', 'customer_types.customer_type_reference', 'customer_types.customer_type', 'customer_types.description', 
            'customer_types.is_active', 'customer_types.created_at','users.name')
            ->orderBy('customer_types.customer_type', 'asc');

            return Datatables::of($customer_types)
            ->addIndexColumn()
                       
            ->editColumn('customer_type', function($customer_types){
                return ucwords($customer_types->customer_type);
            })

            ->editColumn('is_active', function($customer_types){
                if($customer_types->is_active == 1){
                    $is_active = "Enabled";
                }
                else{
                    $is_active = "Disabled";
                }
                return ucwords($is_active);
            })

            ->editColumn('description', function($customer_types){
                return ucwords($customer_types->description);
            })
             
            ->editColumn('created_at', function($customer_types){
                return date("d-m-Y @ H:i:s a", strtotime($customer_types->created_at));
            })  

            ->editColumn('name', function($customer_types){
                return ucwords($customer_types->name);
            })

            ->addColumn('actions', function($row){

                $actions = '<div class="d-flex gap-1">';

                if( Auth::user()->can('view-customer-types')){

                    $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#viewRecordModal" data-id ="'.$row->customer_type_reference.'" id ="'.$row->customer_type_reference.'" class="text-info btn-xl record-view-btn" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                                     
                }

                if( Auth::user()->can('edit-customer-types')){
                    
                    $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editRecordModal" data-id ="'.$row->customer_type_reference.'" id ="'.$row->customer_type_reference.'" class="text-success btn-xl record-edit-btn" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                                  
                }

                if( Auth::user()->can('delete-customer-types')){
                    
                   
                $actions .= '<a href="javascript:void(0);" data-id ="'.$row->customer_type_reference.'" id ="'.$row->customer_type_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';

                                  
                }
                
                
                
                $actions .= '</div>';
                return $actions;

            })
            ->rawColumns(['actions'])
            ->make(true);

        }

        $categories = DB::table('categories')->select('id', 'category_reference', 'category')->orderBy('category', 'asc')->get();
        
        $groups = Group::select('id','group_reference', 'group')->orderBy('group', 'asc')->get();

        return view('web.settings-management.view-customer-types', compact('categories', 'groups') );

    }




    public function addCustomerType(AddCustomerTypeRequest $request){

        $user = Auth::user();

        if( !$user->can('add-customer-types')){

            return abort(403); 
        }
       
        $validated =  $request->validated();

        //info($validated);

        try{

            \DB::beginTransaction();

            $customer_type = CustomerType::create($validated);

            \DB::commit();

            return response()->json(['message' => 'Customer Type created successfully']);

        }
        catch(\Exception $e){
       
            \DB::rollBack();

            Log::Error($e);

            return response()->json(['message' => 'Error creating Customer Type'], 500);
        }
    
    }




    public function getViewCustomerType($id){

        if( !Auth::user()->can('view-customer-types')){

            return abort(403); 
        }

        try{

            $customer_type = CustomerType::leftJoin('users', 'customer_types.created_by', '=', 'users.id')
             //->where('customer_types.is_active', 1)
            ->where('customer_types.customer_type_reference', $id)
            ->select('customer_types.customer_type_reference', 'customer_types.customer_type', 'customer_types.description', 
            'customer_types.is_active', 'customer_types.created_at', 'users.name')->first();

            return response()->json(['message' => 'success', 'data'=>$customer_type]);

        }

        catch (ModelNotFoundException $e){

            Log::Error($e);

            return response()->json([
                'message' => 'Customer Type not found'
            ], 404);

        }
        
    }



    public function getUpdateCustomerType($id){

        if( !Auth::user()->can('edit-customer-types')){

            return abort(403); 
        }

        try{

            $customer_type = CustomerType::leftJoin('users', 'customer_types.created_by', '=', 'users.id')
             //->where('customer_types.is_active', 1)
            ->where('customer_types.customer_type_reference', $id)
            ->select('customer_types.id', 'customer_types.customer_type_reference', 
            'customer_types.customer_type', 'customer_types.description', 
            'customer_types.is_active', 'customer_types.created_at', 'users.name')->first();

            return response()->json(['message' => 'success', 'data'=>$customer_type]);

        }

        catch (ModelNotFoundException $e){

            Log::Error($e);

            return response()->json([
                'message' => 'Customer Type not found'
            ], 404);

        }
        
    }



    public function updateCustomerType(EditCustomerTypeRequest $request){

        $user = Auth::user();

        if( !$user->can('edit-customer-types')){

            return abort(403); 
        }
       
        $validated =  $request->validated();

        //info($validated);

        try{

            \DB::beginTransaction();

            $customer_type = CustomerType::where('customer_type_reference', $validated['customer_type_reference'])->first();  
            
            if($customer_type === null ){

                $error_message = array('customer_type_reference' => array('Customer Type does not exist'));

                return response()->json([
                    'message' => 'The given data was invalid',
                    'errors' => $error_message
                ], 422);
            }

            $customer_type->where('customer_type_reference', $validated['customer_type_reference'])->update($validated);

            \DB::commit();

            return response()->json(['message' => 'Customer Type updated successfully']);

        }
        catch(\Exception $e){
       
            \DB::rollBack();

            Log::Error($e);

            return response()->json(['message' => 'Error updating Customer Type'], 500);
        }
    
    }



    public function deleteCustomerType($id){

        if( !Auth::user()->can('delete-customer-types')){

            return abort(403); 
        }

        try{

            $customer_type = CustomerType::where('customer_type_reference', $id)->first();
            $customer_type->delete();

            return response()->json(['message' => 'Customer Type deleted successfully.']);

        }

        catch (ModelNotFoundException $e){

            Log::Error($e);

            return response()->json([
                'message' => 'Customer Type not found'
            ], 404);

        }


    }








    ////////////////////////////////////// Supplier Types ///////////////////////////////////////////////////////

    public function getSupplierTypes(Request $request){

        if( !Auth::user()->can('view-supplier-types')){

            return abort(403); 
        }

        if ($request->ajax()) {

            $supplier_types = SupplierType::leftJoin('users', 'supplier_types.created_by', '=', 'users.id')
             //->where('supplier_types.is_active', 1)
            ->select('supplier_types.id', 'supplier_types.supplier_type_reference', 'supplier_types.supplier_type', 'supplier_types.description', 
            'supplier_types.is_active', 'supplier_types.created_at','users.name')
            ->orderBy('supplier_types.supplier_type', 'asc');

            return Datatables::of($supplier_types)
            ->addIndexColumn()
                       
            ->editColumn('supplier_type', function($supplier_types){
                return ucwords($supplier_types->supplier_type);
            })

            ->editColumn('is_active', function($supplier_types){
                if($supplier_types->is_active == 1){
                    $is_active = "Enabled";
                }
                else{
                    $is_active = "Disabled";
                }
                return ucwords($is_active);
            })

            ->editColumn('description', function($supplier_types){
                return ucwords($supplier_types->description);
            })
             
            ->editColumn('created_at', function($supplier_types){
                return date("d-m-Y @ H:i:s a", strtotime($supplier_types->created_at));
            })  

            ->editColumn('name', function($supplier_types){
                return ucwords($supplier_types->name);
            })

            ->addColumn('actions', function($row){

                $actions = '<div class="d-flex gap-1">';

                if( Auth::user()->can('view-supplier-types')){

                    $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#viewRecordModal" data-id ="'.$row->supplier_type_reference.'" id ="'.$row->supplier_type_reference.'" class="text-info btn-xl record-view-btn" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                                     
                }

                if( Auth::user()->can('edit-supplier-types')){
                    
                    $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editRecordModal" data-id ="'.$row->supplier_type_reference.'" id ="'.$row->supplier_type_reference.'" class="text-success btn-xl record-edit-btn" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                                  
                }

                if( Auth::user()->can('delete-supplier-types')){
                    
                   $actions .= '<a href="javascript:void(0);" data-id ="'.$row->supplier_type_reference.'" id ="'.$row->supplier_type_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';
                                  
                }                
                
                
                $actions .= '</div>';
                return $actions;

            })
            ->rawColumns(['actions'])
            ->make(true);

        }

        $categories = DB::table('categories')->select('id', 'category_reference', 'category')->orderBy('category', 'asc')->get();
        
        $groups = Group::select('id','group_reference', 'group')->orderBy('group', 'asc')->get();

        return view('web.settings-management.view-supplier-types', compact('categories', 'groups') );

    }




    public function addSupplierType(AddSupplierTypeRequest $request){

        $user = Auth::user();

        if( !$user->can('add-supplier-types')){

            return abort(403); 
        }
       
        $validated =  $request->validated();

        //info($validated);

        try{

            \DB::beginTransaction();

            $supplier_type = SupplierType::create($validated);

            \DB::commit();

            return response()->json(['message' => 'Supplier Type created successfully']);

        }
        catch(\Exception $e){
       
            \DB::rollBack();

            Log::Error($e);

            return response()->json(['message' => 'Error creating Supplier Type'], 500);
        }
    
    }




    public function getViewSupplierType($id){

        if( !Auth::user()->can('view-supplier-types')){

            return abort(403); 
        }

        try{

            $supplier_type = SupplierType::leftJoin('users', 'supplier_types.created_by', '=', 'users.id')
             //->where('supplier_types.is_active', 1)
            ->where('supplier_types.supplier_type_reference', $id)
            ->select('supplier_types.supplier_type_reference', 'supplier_types.supplier_type', 'supplier_types.description', 
            'supplier_types.is_active', 'supplier_types.created_at', 'users.name')->first();

            return response()->json(['message' => 'success', 'data'=>$supplier_type]);

        }

        catch (ModelNotFoundException $e){

            Log::Error($e);

            return response()->json([
                'message' => 'Supplier Type not found'
            ], 404);

        }
        
    }



    public function getUpdateSupplierType($id){

        if( !Auth::user()->can('edit-supplier-types')){

            return abort(403); 
        }

        try{

            $supplier_type = SupplierType::leftJoin('users', 'supplier_types.created_by', '=', 'users.id')
             //->where('supplier_types.is_active', 1)
            ->where('supplier_types.supplier_type_reference', $id)
            ->select('supplier_types.id', 'supplier_types.supplier_type_reference', 
            'supplier_types.supplier_type', 'supplier_types.description', 
            'supplier_types.is_active', 'supplier_types.created_at', 'users.name')->first();

            return response()->json(['message' => 'success', 'data'=>$supplier_type]);

        }

        catch (ModelNotFoundException $e){

            Log::Error($e);

            return response()->json([
                'message' => 'Supplier Type not found'
            ], 404);

        }
        
    }



    public function updateSupplierType(EditSupplierTypeRequest $request){

        $user = Auth::user();

        if( !$user->can('edit-supplier-types')){

            return abort(403); 
        }
       
        $validated =  $request->validated();

        //info($validated);

        try{

            \DB::beginTransaction();

            $supplier_type = SupplierType::where('supplier_type_reference', $validated['supplier_type_reference'])->first();  
            
            if($supplier_type === null ){

                $error_message = array('supplier_type_reference' => array('Supplier Type does not exist'));

                return response()->json([
                    'message' => 'The given data was invalid',
                    'errors' => $error_message
                ], 422);
            }

            $supplier_type->where('supplier_type_reference', $validated['supplier_type_reference'])->update($validated);

            \DB::commit();

            return response()->json(['message' => 'Supplier Type updated successfully']);

        }
        catch(\Exception $e){
       
            \DB::rollBack();

            Log::Error($e);

            return response()->json(['message' => 'Error updating Supplier Type'], 500);
        }
    
    }



    public function deleteSupplierType($id){

        if( !Auth::user()->can('delete-supplier-types')){

            return abort(403); 
        }

        try{

            $supplier_type = SupplierType::where('supplier_type_reference', $id)->first();
            $supplier_type->delete();

            return response()->json(['message' => 'Supplier Type deleted successfully.']);

        }

        catch (ModelNotFoundException $e){

            Log::Error($e);

            return response()->json([
                'message' => 'Supplier Type not found'
            ], 404);

        }


    }








    ////////////////////////////////////// Inventory Categories ///////////////////////////////////////////////////////

    public function getInventoryCategory(Request $request){

        if( !Auth::user()->can('view-inventory-categories')){

            return abort(403); 
        }

        if ($request->ajax()) {

            $inventory_categories = InventoryCategory::leftJoin('users', 'inventory_categories.created_by', '=', 'users.id')
             //->where('inventory_categories.is_active', 1)
            ->select('inventory_categories.id', 'inventory_categories.inventory_category_reference', 'inventory_categories.inventory_category', 'inventory_categories.description', 
            'inventory_categories.is_active', 'inventory_categories.created_at','users.name')
            ->orderBy('inventory_categories.inventory_category', 'asc');

            return Datatables::of($inventory_categories)
            ->addIndexColumn()
                       
            ->editColumn('inventory_category', function($inventory_categories){
                return ucwords($inventory_categories->inventory_category);
            })

            ->editColumn('is_active', function($inventory_categories){
                if($inventory_categories->is_active == 1){
                    $is_active = "Enabled";
                }
                else{
                    $is_active = "Disabled";
                }
                return ucwords($is_active);
            })

            ->editColumn('description', function($inventory_categories){
                return ucwords($inventory_categories->description);
            })
             
            ->editColumn('created_at', function($inventory_categories){
                return date("d-m-Y @ H:i:s a", strtotime($inventory_categories->created_at));
            })  

            ->editColumn('name', function($inventory_categories){
                return ucwords($inventory_categories->name);
            })

            ->addColumn('actions', function($row){

                $actions = '<div class="d-flex gap-1">';

                if( Auth::user()->can('view-inventory-categories')){

                    $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#viewRecordModal" data-id ="'.$row->inventory_category_reference.'" id ="'.$row->inventory_category_reference.'" class="text-info btn-xl record-view-btn" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                                     
                }

                if( Auth::user()->can('edit-inventory-categories')){
                    
                    $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editRecordModal" data-id ="'.$row->inventory_category_reference.'" id ="'.$row->inventory_category_reference.'" class="text-success btn-xl record-edit-btn" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                                  
                }

                if( Auth::user()->can('delete-inventory-categories')){
                    
                   
                $actions .= '<a href="javascript:void(0);" data-id ="'.$row->inventory_category_reference.'" id ="'.$row->inventory_category_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';

                                  
                }
                
                
                
                $actions .= '</div>';
                return $actions;

            })
            ->rawColumns(['actions'])
            ->make(true);

        }

        $categories = DB::table('categories')->select('id', 'category_reference', 'category')->orderBy('category', 'asc')->get();
        
        $groups = Group::select('id','group_reference', 'group')->orderBy('group', 'asc')->get();

        return view('web.settings-management.view-inventory-categories', compact('categories', 'groups') );

    }




    public function addInventoryCategory(AddInventorycategoryRequest $request){

        $user = Auth::user();

        if( !$user->can('add-inventory-categories')){

            return abort(403); 
        }
       
        $validated =  $request->validated();

        //info($validated);

        try{

            \DB::beginTransaction();

            $inventory_category = InventoryCategory::create($validated);

            \DB::commit();

            return response()->json(['message' => 'Inventory Category created successfully']);

        }
        catch(\Exception $e){
       
            \DB::rollBack();

            Log::Error($e);

            return response()->json(['message' => 'Error creating Inventory Category'], 500);
        }
    
    }




    public function getViewInventoryCategory($id){

        if( !Auth::user()->can('view-inventory-categories')){

            return abort(403); 
        }

        try{

            $inventory_category = InventoryCategory::leftJoin('users', 'inventory_categories.created_by', '=', 'users.id')
             //->where('inventory_categories.is_active', 1)
            ->where('inventory_categories.inventory_category_reference', $id)
            ->select('inventory_categories.inventory_category_reference', 'inventory_categories.inventory_category', 'inventory_categories.description', 
            'inventory_categories.is_active', 'inventory_categories.created_at', 'users.name')->first();

            return response()->json(['message' => 'success', 'data'=>$inventory_category]);

        }

        catch (ModelNotFoundException $e){

            Log::Error($e);

            return response()->json([
                'message' => 'Inventory Category not found'
            ], 404);

        }
        
    }



    public function getUpdateInventoryCategory($id){

        if( !Auth::user()->can('edit-inventory-categories')){

            return abort(403); 
        }

        try{

            $inventory_category = InventoryCategory::leftJoin('users', 'inventory_categories.created_by', '=', 'users.id')
             //->where('inventory_categories.is_active', 1)
            ->where('inventory_categories.inventory_category_reference', $id)
            ->select('inventory_categories.id', 'inventory_categories.inventory_category_reference', 
            'inventory_categories.inventory_category', 'inventory_categories.description', 
            'inventory_categories.is_active', 'inventory_categories.created_at', 'users.name')->first();

            return response()->json(['message' => 'success', 'data'=>$inventory_category]);

        }

        catch (ModelNotFoundException $e){

            Log::Error($e);

            return response()->json([
                'message' => 'Inventory Category not found'
            ], 404);

        }
        
    }



    public function updateInventoryCategory(EditInventorycategoryequest $request){

        $user = Auth::user();

        if( !$user->can('edit-inventory-categories')){

            return abort(403); 
        }
       
        $validated =  $request->validated();

        //info($validated);

        try{

            \DB::beginTransaction();

            $inventory_category = InventoryCategory::where('inventory_category_reference', $validated['inventory_category_reference'])->first();  
            
            if($inventory_category === null ){

                $error_message = array('inventory_category_reference' => array('Inventory Category does not exist'));

                return response()->json([
                    'message' => 'The given data was invalid',
                    'errors' => $error_message
                ], 422);
            }

            $inventory_category->where('inventory_category_reference', $validated['inventory_category_reference'])->update($validated);

            \DB::commit();

            return response()->json(['message' => 'Inventory Category updated successfully']);

        }
        catch(\Exception $e){
       
            \DB::rollBack();

            Log::Error($e);

            return response()->json(['message' => 'Error updating Inventory Category'], 500);
        }
    
    }



    public function deleteInventoryCategory($id){

        if( !Auth::user()->can('delete-inventory-categories')){

            return abort(403); 
        }

        try{

            $inventory_category = InventoryCategory::where('inventory_category_reference', $id)->first();
            $inventory_category->delete();

            return response()->json(['message' => 'Inventory Category deleted successfully.']);

        }

        catch (ModelNotFoundException $e){

            Log::Error($e);

            return response()->json([
                'message' => 'Inventory Category not found'
            ], 404);

        }


    }







    ////////////////////////////////////// Product Categories ///////////////////////////////////////////////////////

    public function getProductCategory(Request $request){

        if( !Auth::user()->can('view-product-categories')){

            return abort(403); 
        }

        if ($request->ajax()) {

            $product_categories = ProductCategory::leftJoin('users', 'product_categories.created_by', '=', 'users.id')
             //->where('product_categories.is_active', 1)
            ->select('product_categories.id', 'product_categories.product_category_reference', 'product_categories.product_category', 'product_categories.description', 
            'product_categories.is_active', 'product_categories.created_at','users.name')
            ->orderBy('product_categories.product_category', 'asc');

            return Datatables::of($product_categories)
            ->addIndexColumn()
                       
            ->editColumn('product_category', function($product_categories){
                return ucwords($product_categories->product_category);
            })

            ->editColumn('is_active', function($product_categories){
                if($product_categories->is_active == 1){
                    $is_active = "Enabled";
                }
                else{
                    $is_active = "Disabled";
                }
                return ucwords($is_active);
            })

            ->editColumn('description', function($product_categories){
                return ucwords($product_categories->description);
            })
             
            ->editColumn('created_at', function($product_categories){
                return date("d-m-Y @ H:i:s a", strtotime($product_categories->created_at));
            })  

            ->editColumn('name', function($product_categories){
                return ucwords($product_categories->name);
            })

            ->addColumn('actions', function($row){

                $actions = '<div class="d-flex gap-1">';

                if( Auth::user()->can('view-product-categories')){

                    $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#viewRecordModal" data-id ="'.$row->product_category_reference.'" id ="'.$row->product_category_reference.'" class="text-info btn-xl record-view-btn" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                                     
                }

                if( Auth::user()->can('edit-product-categories')){
                    
                    $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editRecordModal" data-id ="'.$row->product_category_reference.'" id ="'.$row->product_category_reference.'" class="text-success btn-xl record-edit-btn" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                                  
                }

                if( Auth::user()->can('delete-product-categories')){
                    
                   
                $actions .= '<a href="javascript:void(0);" data-id ="'.$row->product_category_reference.'" id ="'.$row->product_category_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';

                                  
                }
                
                
                
                $actions .= '</div>';
                return $actions;

            })
            ->rawColumns(['actions'])
            ->make(true);

        }

        $categories = DB::table('categories')->select('id', 'category_reference', 'category')->orderBy('category', 'asc')->get();
        
        $groups = Group::select('id','group_reference', 'group')->orderBy('group', 'asc')->get();

        return view('web.settings-management.view-product-categories', compact('categories', 'groups') );

    }




    public function addProductCategory(AddProductCategoryRequest $request){

        $user = Auth::user();

        if( !$user->can('add-product-categories')){

            return abort(403); 
        }
       
        $validated =  $request->validated();

        //info($validated);

        try{

            \DB::beginTransaction();

            $product_category = ProductCategory::create($validated);

            \DB::commit();

            return response()->json(['message' => 'Product Category created successfully']);

        }
        catch(\Exception $e){
       
            \DB::rollBack();

            Log::Error($e);

            return response()->json(['message' => 'Error creating Product Category'], 500);
        }
    
    }




    public function getViewProductCategory($id){

        if( !Auth::user()->can('view-product-categories')){

            return abort(403); 
        }

        try{

            $product_category = ProductCategory::leftJoin('users', 'product_categories.created_by', '=', 'users.id')
             //->where('product_categories.is_active', 1)
            ->where('product_categories.product_category_reference', $id)
            ->select('product_categories.product_category_reference', 'product_categories.product_category', 'product_categories.description', 
            'product_categories.is_active', 'product_categories.created_at', 'users.name')->first();

            return response()->json(['message' => 'success', 'data'=>$product_category]);

        }

        catch (ModelNotFoundException $e){

            Log::Error($e);

            return response()->json([
                'message' => 'Product Category not found'
            ], 404);

        }
        
    }



    public function getUpdateProductCategory($id){

        if( !Auth::user()->can('edit-product-categories')){

            return abort(403); 
        }

        try{

            $product_category = ProductCategory::leftJoin('users', 'product_categories.created_by', '=', 'users.id')
             //->where('product_categories.is_active', 1)
            ->where('product_categories.product_category_reference', $id)
            ->select('product_categories.id', 'product_categories.product_category_reference', 
            'product_categories.product_category', 'product_categories.description', 
            'product_categories.is_active', 'product_categories.created_at', 'users.name')->first();

            return response()->json(['message' => 'success', 'data'=>$product_category]);

        }

        catch (ModelNotFoundException $e){

            Log::Error($e);

            return response()->json([
                'message' => 'Product Category not found'
            ], 404);

        }
        
    }



    public function updateProductCategory(EditProductCategoryRequest $request){

        $user = Auth::user();

        if( !$user->can('edit-product-categories')){

            return abort(403); 
        }
       
        $validated =  $request->validated();

        //info($validated);

        try{

            \DB::beginTransaction();

            $product_category = ProductCategory::where('product_category_reference', $validated['product_category_reference'])->first();  
            
            if($product_category === null ){

                $error_message = array('product_category_reference' => array('Product Category does not exist'));

                return response()->json([
                    'message' => 'The given data was invalid',
                    'errors' => $error_message
                ], 422);
            }

            $product_category->where('product_category_reference', $validated['product_category_reference'])->update($validated);

            \DB::commit();

            return response()->json(['message' => 'Product Category updated successfully']);

        }
        catch(\Exception $e){
       
            \DB::rollBack();

            Log::Error($e);

            return response()->json(['message' => 'Error updating Product Category'], 500);
        }
    
    }



    public function deleteProductCategory($id){

        if( !Auth::user()->can('delete-product-categories')){

            return abort(403); 
        }

        try{

            $product_category = ProductCategory::where('product_category_reference', $id)->first();
            $product_category->delete();

            return response()->json(['message' => 'Product Category deleted successfully.']);

        }

        catch (ModelNotFoundException $e){

            Log::Error($e);

            return response()->json([
                'message' => 'Product Category not found'
            ], 404);

        }


    }


    



    ////////////////////////////////////// Item Categories ///////////////////////////////////////////////////////

    public function getItemcategory(Request $request){

        if( !Auth::user()->can('view-item-categories')){

            return abort(403); 
        }

        if ($request->ajax()) {

            $item_categories = Itemcategory::leftJoin('users', 'item_categories.created_by', '=', 'users.id')
            ->leftJoin('groups', 'item_categories.group_id', '=', 'groups.id')
             //->where('item_categories.is_active', 1)
            ->select('item_categories.id', 'item_categories.item_category_reference', 'item_categories.item_category', 'item_categories.description', 
            'item_categories.is_active', 'item_categories.created_at', 'groups.group', 'users.name')
            ->orderBy('groups.group', 'asc');

            return Datatables::of($item_categories)
            ->addIndexColumn()

            ->setRowClass(function ($item_categories) {
                return $item_categories->is_active == 0 ? 'table-warning' : '';
            })
                       
            ->editColumn('item_category', function($item_categories){
                return ucwords($item_categories->item_category);
            })

            ->editColumn('is_active', function($item_categories){
                if($item_categories->is_active == 1){
                    $is_active = "Enabled";
                }
                else{
                    $is_active = "Disabled";
                }
                return ucwords($is_active);
            })

            ->editColumn('description', function($item_categories){
                return ucwords($item_categories->description);
            })
             
            ->editColumn('created_at', function($item_categories){
                return date("d-m-Y @ H:i:s a", strtotime($item_categories->created_at));
            })  

            ->editColumn('name', function($item_categories){
                return ucwords($item_categories->name);
            })

            ->editColumn('group', function($item_categories){
                return ucwords($item_categories->group);
            })

            ->addColumn('actions', function($row){

                $actions = '<div class="d-flex gap-1">';

                if( Auth::user()->can('view-item-categories')){

                    $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#viewRecordModal" data-id ="'.$row->item_category_reference.'" id ="'.$row->item_category_reference.'" class="text-info btn-xl record-view-btn" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                                     
                }

                if( Auth::user()->can('edit-item-categories')){
                    
                    $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editRecordModal" data-id ="'.$row->item_category_reference.'" id ="'.$row->item_category_reference.'" class="text-success btn-xl record-edit-btn" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                                  
                }

                if( Auth::user()->can('delete-item-categories')){
                    
                   
                $actions .= '<a href="javascript:void(0);" data-id ="'.$row->item_category_reference.'" id ="'.$row->item_category_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';

                                  
                }
                
                
                
                $actions .= '</div>';
                return $actions;

            })
            ->rawColumns(['actions'])
            ->make(true);

        }

        $categories = DB::table('categories')->select('id', 'category_reference', 'category')->orderBy('category', 'asc')->get();
        
        $groups = Group::select('id','group_reference', 'group')->orderBy('group', 'asc')->get();

        return view('web.settings-management.view-item-categories', compact('categories', 'groups') );

    }




    public function addItemcategory(AddItemCategoryRequest $request){

        $user = Auth::user();

        if( !$user->can('add-item-categories')){

            return abort(403); 
        }
       
        $validated =  $request->validated();

        //info($validated);

        try{

            \DB::beginTransaction();

            $item_category = Itemcategory::create($validated);

            \DB::commit();

            return response()->json(['message' => 'Item Category created successfully']);

        }
        catch(\Exception $e){
       
            \DB::rollBack();

            Log::Error($e);

            return response()->json(['message' => 'Error creating Item Category'], 500);
        }
    
    }




    public function getViewItemcategory($id){

        if( !Auth::user()->can('view-item-categories')){

            return abort(403); 
        }

        try{

            $item_category = Itemcategory::leftJoin('users', 'item_categories.created_by', '=', 'users.id')
            ->leftJoin('groups', 'item_categories.group_id', '=', 'groups.id')
             //->where('item_categories.is_active', 1)
            ->where('item_categories.item_category_reference', $id)
            ->select('item_categories.item_category_reference', 'item_categories.item_category', 'item_categories.description', 
            'item_categories.is_active', 'item_categories.created_at', 'groups.group', 'users.name')->first();

            return response()->json(['message' => 'success', 'data'=>$item_category]);

        }

        catch (ModelNotFoundException $e){

            Log::Error($e);

            return response()->json([
                'message' => 'Item Category not found'
            ], 404);

        }
        
    }



    public function getUpdateItemcategory($id){

        if( !Auth::user()->can('edit-item-categories')){

            return abort(403); 
        }

        try{

            $item_category = Itemcategory::leftJoin('users', 'item_categories.created_by', '=', 'users.id')
            ->leftJoin('groups', 'item_categories.group_id', '=', 'groups.id')
             //->where('item_categories.is_active', 1)
            ->where('item_categories.item_category_reference', $id)
            ->select('item_categories.id', 'item_categories.item_category_reference', 'item_categories.group_id', 
            'item_categories.item_category', 'item_categories.description', 
            'item_categories.is_active', 'item_categories.created_at',
            'groups.group_reference', 'groups.group', 'users.name')->first();

            return response()->json(['message' => 'success', 'data'=>$item_category]);

        }

        catch (ModelNotFoundException $e){

            Log::Error($e);

            return response()->json([
                'message' => 'Item Category not found'
            ], 404);

        }
        
    }



    public function updateItemcategory(EditItemCategoryRequest $request){

        $user = Auth::user();

        if( !$user->can('edit-item-categories')){

            return abort(403); 
        }
       
        $validated =  $request->validated();

        //info($validated);

        try{

            \DB::beginTransaction();

            $item_category = Itemcategory::where('item_category_reference', $validated['item_category_reference'])->first();  
            
            if($item_category === null ){

                $error_message = array('item_category_reference' => array('Item Category does not exist'));

                return response()->json([
                    'message' => 'The given data was invalid',
                    'errors' => $error_message
                ], 422);
            }

            $item_category->where('item_category_reference', $validated['item_category_reference'])->update($validated);

            \DB::commit();

            return response()->json(['message' => 'Item Category updated successfully']);

        }
        catch(\Exception $e){
       
            \DB::rollBack();

            Log::Error($e);

            return response()->json(['message' => 'Error updating Item Category'], 500);
        }
    
    }



    public function deleteItemcategory($id){

        if( !Auth::user()->can('delete-item-categories')){

            return abort(403); 
        }

        try{

            $item_category = Itemcategory::where('item_category_reference', $id)->first();
            $item_category->delete();

            return response()->json(['message' => 'Item Category deleted successfully.']);

        }

        catch (ModelNotFoundException $e){

            Log::Error($e);

            return response()->json([
                'message' => 'Item Category not found'
            ], 404);

        }


    }








    ////////////////////////////////////// Groups ///////////////////////////////////////////////////////

    public function getGroups(Request $request){

        if( !Auth::user()->can('view-groups')){

            return abort('403'); 
        }

        if ($request->ajax()) {

            $groups = Group::leftJoin('users', 'groups.created_by', '=', 'users.id')
            ->where('is_active', 1)
            ->select('groups.group_reference', 'groups.group', 
            'groups.description', 'groups.created_at', 'users.name')
            ->orderBy('groups.group', 'asc');

            return Datatables::of($groups)
            ->addIndexColumn()
                       
            ->editColumn('group', function($groups){
                return ucwords($groups->group);
            })

            ->editColumn('description', function($groups){
                return ucwords($groups->description);
            })
             
            ->editColumn('created_at', function($groups){
                return date("d-m-Y @ H:i:s a", strtotime($groups->created_at));
            })  

            ->editColumn('name', function($groups){
                return ucwords($groups->name);
            }) 

            ->addColumn('actions', function($row){

                $actions = '<div class="d-flex gap-1">';
                
                $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#viewRecordModal" data-id ="'.$row->group_reference.'" id ="'.$row->group_reference.'" class="text-info btn-xl record-view-btn" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editRecordModal" data-id ="'.$row->group_reference.'" id ="'.$row->group_reference.'" class="text-success btn-xl record-edit-btn" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                $actions .= '<a href="javascript:void(0);" data-id ="'.$row->group_reference.'" id ="'.$row->group_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';

                $actions .= '</div>';
                return $actions;

            })
            ->rawColumns(['actions'])
            ->make(true);

        }

        return view('web.settings-management.view-groups' );

    }





    public function addGroup(AddGroupRequest $request){

        $user = Auth::user();

        if( !$user->can('create-groups')){

            return abort('403'); 
        }
       
        $validated =  $request->validated();

        //info($validated);

        try{

            \DB::beginTransaction();

            $group = Group::create($validated);

            \DB::commit();

            return response()->json(['message' => 'Group created successfully']);

        }
        catch(\Exception $e){
       
            \DB::rollBack();

            Log::Error($e);

            return response()->json(['message' => 'Error creating Group'], 500);
        }
    
    }




    public function getViewGroup($id){

        if( !Auth::user()->can('view-groups')){

            return abort('403'); 
        }

        try{

            $group = Group::where('group_reference', $id)
            ->select('group_reference', 'group', 'description', 'created_at')->first();  
            //$group = Group::where('group_reference', $request->group_reference)->first();  
            
            //info($group);
            
            // if($group === null ){
            //     $error_message = array('group_reference' => array('Group does not exist'));
            //     return response()->json([
            //         'message' => 'The given data was invalid',
            //         'errors' => $error_message
            //     ], 422);
            // }

            return response()->json(['message' => 'success', 'data'=>$group]);

        }

        catch (ModelNotFoundException $e){

            Log::Error($e);

            return response()->json([
                'message' => 'Group not found'
            ], 404);

        }
        
    }



    public function getUpdateGroup($id){

        if( !Auth::user()->can('edit-groups')){

            return abort('403'); 
        }

        try{

            $group = Group::where('group_reference', $id)->first();  
            //$group = Group::where('program_reference', $request->program_reference)->first();  
            
            //info($group);
            
            // if($group === null ){
            //     $error_message = array('group_reference' => array('Group does not exist'));
            //     return response()->json([
            //         'message' => 'The given data was invalid',
            //         'errors' => $error_message
            //     ], 422);
            // }

            return response()->json(['message' => 'success', 'record'=>$group]);

            //return view('web.settings-management.edit-group', compact('group'));

        }

        catch (ModelNotFoundException $e){

            Log::Error($e);

            return response()->json([
                'message' => 'Group not found'
            ], 404);

        }
        
    }



    public function updateGroup(EditGroupRequest $request){

        $user = Auth::user();

        if( !$user->can('edit-groups')){

            return abort('403'); 
        }
       
        $validated =  $request->validated();

        //info($validated);

        try{

            \DB::beginTransaction();

            $group = Group::where('group_reference', $validated['group_reference'])->first();  
            
            if($group === null ){
                $error_message = array('group_reference' => array('Group does not exist'));
                return response()->json([
                    'message' => 'The given data was invalid',
                    'errors' => $error_message
                ], 422);
            }

            $group->where('group_reference', $validated['group_reference'])->update($validated);

            \DB::commit();

            return response()->json(['message' => 'Group updated successfully']);

        }
        catch(\Exception $e){
       
            \DB::rollBack();

            Log::Error($e);

            return response()->json(['message' => 'Error updating Group'], 500);
        }
    
    }



    public function deleteGroup($id){

        if( !Auth::user()->can('delete-groups')){

            return abort('403'); 
        }

        try{

            $group = Group::where('group_reference', $id)->first();
            $group->delete();

            return response()->json(['message' => 'Group deleted successfully.']);

        }

        catch (ModelNotFoundException $e){

            Log::Error($e);

            return response()->json([
                'message' => 'Group not found'
            ], 404);

        }


    }





    

    ////////////////////////////////////// Currencies ///////////////////////////////////////////////////////

    public function getCurrency(Request $request){

        if( !Auth::user()->can('view-currencies')){

            return abort('403'); 
        }

        if ($request->ajax()) {

            $currency = Currency::leftJoin('users', 'currencies.created_by', '=', 'users.id')
            ->where('currencies.is_active', 1)
            ->select('currencies.currency_reference', 'currencies.currency', 'currencies.currency_code', 
            'currencies.description', 'currencies.created_at', 'users.name')
            ->orderBy('currencies.currency', 'asc');

            return Datatables::of($currency)
            ->addIndexColumn()
                       
            ->editColumn('currency', function($currency){
                return ucwords($currency->currency);
            })

            ->editColumn('currency_code', function($currency){
                return strtoupper($currency->currency_code);
            })

            ->editColumn('description', function($currency){
                return ucwords($currency->description);
            })
             
            ->editColumn('created_at', function($currency){
                return date("d-m-Y @ H:i:s a", strtotime($currency->created_at));
            })  

            ->editColumn('name', function($currency){
                return ucwords($currency->name);
            }) 

            ->addColumn('actions', function($row){

                $actions = '<div class="d-flex gap-1">';
                
                $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#viewRecordModal" data-id ="'.$row->currency_reference.'" id ="'.$row->currency_reference.'" class="text-info btn-xl record-view-btn" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editRecordModal" data-id ="'.$row->currency_reference.'" id ="'.$row->currency_reference.'" class="text-success btn-xl record-edit-btn" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                $actions .= '<a href="javascript:void(0);" data-id ="'.$row->currency_reference.'" id ="'.$row->currency_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';

                $actions .= '</div>';
                return $actions;

            })
            ->rawColumns(['actions'])
            ->make(true);

        }

        return view('web.settings-management.view-currencies' );

    }





    ////////////////////////////////////// Statuses ///////////////////////////////////////////////////////

    public function getStatus(Request $request){

        if( !Auth::user()->can('view-statuses')){

            return abort('403'); 
        }

        if ($request->ajax()) {

            $statuses = Status::leftJoin('users', 'statuses.created_by', '=', 'users.id')
            ->leftJoin('status_group', 'statuses.id', '=', 'status_group.status_id')
            ->leftJoin('groups', 'groups.id', '=', 'status_group.group_id')
            ->where('statuses.is_active', 1)
            ->select('statuses.status_reference', 'statuses.status',
            'statuses.description', 'statuses.created_at', 'users.name', 'groups.group')
            ->orderBy('groups.group', 'asc');

            return Datatables::of($statuses)
            ->addIndexColumn()
                       
            ->editColumn('status', function($statuses){
                return ucwords($statuses->status);
            })           

            ->editColumn('description', function($statuses){
                return ucwords($statuses->description);
            })
             
            ->editColumn('created_at', function($statuses){
                return date("d-m-Y @ H:i:s a", strtotime($statuses->created_at));
            })  

            ->editColumn('name', function($statuses){
                return ucwords($statuses->name);
            })
            
            ->editColumn('group', function($statuses){
                return ucwords($statuses->group);
            })

            ->addColumn('actions', function($row){

                $actions = '<div class="d-flex gap-1">';
                
                $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#viewRecordModal" data-id ="'.$row->status_reference.'" id ="'.$row->status_reference.'" class="text-info btn-xl record-view-btn" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editRecordModal" data-id ="'.$row->status_reference.'" id ="'.$row->status_reference.'" class="text-success btn-xl record-edit-btn" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                $actions .= '<a href="javascript:void(0);" data-id ="'.$row->status_reference.'" id ="'.$row->status_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';

                $actions .= '</div>';
                return $actions;

            })
            ->rawColumns(['actions'])
            ->make(true);

        }

        return view('web.settings-management.view-statuses' );

    }





    ////////////////////////////////////// Metrics ///////////////////////////////////////////////////////

    public function getMetrics(Request $request){

        if( !Auth::user()->can('view-metrics')){

            return abort('403'); 
        }

        if ($request->ajax()) {

            $metrics = Metric::leftJoin('users', 'metrics.created_by', '=', 'users.id')
            //->leftJoin('groups', 'metric_group.group_id', '=', 'groups.id')
            //->leftJoin('metric_group', 'metric_group.metric_id', '=', 'metrics.id')
            ->where('metrics.is_active', 1)
            ->select('metrics.metric_reference', 'metrics.metric', 'metrics.metric_code', 
            'metrics.description', 'metrics.created_at', 'users.name', )
            ->orderBy('metrics.metric', 'asc');

            return Datatables::of($metrics)
            ->addIndexColumn()
                       
            ->editColumn('metric', function($metrics){
                return ucwords($metrics->metric);
            })

            ->editColumn('metric_code', function($metrics){
                return ucwords($metrics->metric_code);
            })

            ->editColumn('description', function($metrics){
                return ucwords($metrics->description);
            })
             
            ->editColumn('created_at', function($metrics){
                return date("d-m-Y @ H:i:s a", strtotime($metrics->created_at));
            })  

            ->editColumn('name', function($metrics){
                return ucwords($metrics->name);
            })
            
            // ->editColumn('group', function($metrics){
            //     return ucwords($metrics->group);
            // })

            ->addColumn('actions', function($row){

                $actions = '<div class="d-flex gap-1">';
                
                $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#viewRecordModal" data-id ="'.$row->metric_reference.'" id ="'.$row->metric_reference.'" class="text-info btn-xl record-view-btn" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editRecordModal" data-id ="'.$row->metric_reference.'" id ="'.$row->metric_reference.'" class="text-success btn-xl record-edit-btn" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                $actions .= '<a href="javascript:void(0);" data-id ="'.$row->metric_reference.'" id ="'.$row->metric_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';

                $actions .= '</div>';
                return $actions;

            })
            ->rawColumns(['actions'])
            ->make(true);

        }

        return view('web.settings-management.view-metrics' );

    }





    ////////////////////////////////////// Payment Method ///////////////////////////////////////////////////////

    public function getPaymentMethod(Request $request){

        if( !Auth::user()->can('view-payment-methods')){

            return abort('403'); 
        }

        if ($request->ajax()) {

            $payment_methods = PaymentMethod::leftJoin('users', 'payment_methods.created_by', '=', 'users.id')
            ->where('payment_methods.is_active', 1)
            ->select('payment_methods.payment_method_reference', 'payment_methods.payment_method', 'payment_methods.payment_method_code', 
            'payment_methods.description', 'payment_methods.created_at', 'users.name')
            ->orderBy('payment_methods.payment_method', 'asc');

            return Datatables::of($payment_methods)
            ->addIndexColumn()
                       
            ->editColumn('payment_method', function($payment_methods){
                return ucwords($payment_methods->payment_method);
            })

            ->editColumn('payment_method_code', function($payment_methods){
                return ucwords($payment_methods->payment_method_code);
            })

            ->editColumn('description', function($payment_methods){
                return ucwords($payment_methods->description);
            })
             
            ->editColumn('created_at', function($payment_methods){
                return date("d-m-Y @ H:i:s a", strtotime($payment_methods->created_at));
            })  

            ->editColumn('name', function($payment_methods){
                return ucwords($payment_methods->name);
            })
            
            ->addColumn('actions', function($row){

                $actions = '<div class="d-flex gap-1">';
                
                $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#viewRecordModal" data-id ="'.$row->payment_method_reference.'" id ="'.$row->payment_method_reference.'" class="text-info btn-xl record-view-btn" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editRecordModal" data-id ="'.$row->payment_method_reference.'" id ="'.$row->payment_method_reference.'" class="text-success btn-xl record-edit-btn" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                $actions .= '<a href="javascript:void(0);" data-id ="'.$row->payment_method_reference.'" id ="'.$row->payment_method_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';

                $actions .= '</div>';
                return $actions;

            })
            ->rawColumns(['actions'])
            ->make(true);

        }

        return view('web.settings-management.view-payment-methods' );

    }






    ////////////////////////////////////// Categories ///////////////////////////////////////////////////////

    public function getCategory(Request $request){

        if( !Auth::user()->can('view-categories')){

            return abort('403'); 
        }

        if ($request->ajax()) {

            $sub_categories = Category::leftJoin('users', 'categories.created_by', '=', 'users.id')
            //->leftJoin('groups', 'categories.group_id', '=', 'groups.id')
            ->where('categories.is_active', 1)
            ->select('categories.category_reference', 'categories.category', 
            'categories.description', 'categories.created_at', 'users.name',)
            ->orderBy('categories.category', 'asc');

            return Datatables::of($sub_categories)
            ->addIndexColumn()
                       
            ->editColumn('category', function($sub_categories){
                return ucwords($sub_categories->category);
            })

            ->editColumn('description', function($sub_categories){
                return ucwords($sub_categories->description);
            })
             
            ->editColumn('created_at', function($sub_categories){
                return date("d-m-Y @ H:i:s a", strtotime($sub_categories->created_at));
            })  

            ->editColumn('name', function($sub_categories){
                return ucwords($sub_categories->name);
            })
            
            // ->editColumn('group', function($sub_categories){
            //     return ucwords($sub_categories->group);
            // })

            ->addColumn('actions', function($row){

                $actions = '<div class="d-flex gap-1">';
                
                $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#viewRecordModal" data-id ="'.$row->category_reference.'" id ="'.$row->category_reference.'" class="text-info btn-xl record-view-btn" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editRecordModal" data-id ="'.$row->category_reference.'" id ="'.$row->category_reference.'" class="text-success btn-xl record-edit-btn" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                $actions .= '<a href="javascript:void(0);" data-id ="'.$row->category_reference.'" id ="'.$row->category_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';

                $actions .= '</div>';
                return $actions;

            })
            ->rawColumns(['actions'])
            ->make(true);

        }

        return view('web.settings-management.view-categories' );

    }








    ////////////////////////////////////// Sub Categories ///////////////////////////////////////////////////////

    public function getSubCategory(Request $request){

        // if( Auth::user()->can('view-sub-categories')){

        //     return abort('403'); 
        // }

        if ($request->ajax()) {

            $sub_categories = SubCategory::leftJoin('users', 'sub_categories.created_by', '=', 'users.id')
            // ->leftJoin('groups', 'sub_categories.group_id', '=', 'groups.id')
            // ->leftJoin('categories', 'sub_categories.category_id', '=', 'categories.id')
            //->where('sub_categories.is_active', 1)
            ->select('sub_categories.sub_category_reference', 'sub_categories.sub_category', 'sub_categories.description', 
            'sub_categories.created_at', 'users.name',)
            ->orderBy('sub_categories.sub_category', 'asc');

            return Datatables::of($sub_categories)
            ->addIndexColumn()
                       
            ->editColumn('sub_category', function($sub_categories){
                return ucwords($sub_categories->sub_category);
            })

            ->editColumn('description', function($sub_categories){
                return ucwords($sub_categories->description);
            })
             
            ->editColumn('created_at', function($sub_categories){
                return date("d-m-Y @ H:i:s a", strtotime($sub_categories->created_at));
            })  

            ->editColumn('name', function($sub_categories){
                return ucwords($sub_categories->name);
            })

            // ->editColumn('category', function($sub_categories){
            //     return ucwords($sub_categories->category);
            // })
            
            // ->editColumn('group', function($sub_categories){
            //     return ucwords($sub_categories->group);
            // })

            ->addColumn('actions', function($row){

                $actions = '<div class="d-flex gap-1">';
                
                $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#viewRecordModal" data-id ="'.$row->sub_category_reference.'" id ="'.$row->sub_category_reference.'" class="text-info btn-xl record-view-btn" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editRecordModal" data-id ="'.$row->sub_category_reference.'" id ="'.$row->sub_category_reference.'" class="text-success btn-xl record-edit-btn" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                $actions .= '<a href="javascript:void(0);" data-id ="'.$row->sub_category_reference.'" id ="'.$row->sub_category_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';

                $actions .= '</div>';
                return $actions;

            })
            ->rawColumns(['actions'])
            ->make(true);

        }

        $categories = DB::table('categories')->select('category_reference', 'category')->orderBy('category', 'asc')->get();
        
        $groups = Group::select('group_reference', 'group')->orderBy('group', 'asc')->get();

        return view('web.settings-management.view-sub-categories', compact('categories', 'groups') );

    }




    public function addSubCategory(AddSubGroupRequest $request){

        // $user = Auth::user();

        // if( $user->can('create-sub-category')){

        //     return abort('403'); 
        // }
       
        $validated =  $request->validated();

        //info($validated);

        try{

            \DB::beginTransaction();

            $sub_category = SubCategory::create($validated);

            \DB::commit();

            return response()->json(['message' => 'Sub Category created successfully']);

        }
        catch(\Exception $e){
       
            \DB::rollBack();

            Log::Error($e);

            return response()->json(['message' => 'Error creating Sub Category'], 500);
        }
    
    }




    public function getViewSubCategory($id){

        // if( !Auth::user()->can('view-sub-category')){

        //     return abort('403'); 
        // }

        try{

            $sub_category = SubCategory::leftJoin('users', 'sub_categories.created_by', '=', 'users.id')
            // ->leftJoin('groups', 'sub_categories.group_id', '=', 'groups.id')
            // ->leftJoin('categories', 'sub_categories.category_id', '=', 'categories.id')
            ->where('sub_categories.is_active', 1)
            ->where('sub_categories.sub_category_reference', $id)
            ->select('sub_categories.sub_category_reference', 'sub_categories.sub_category', 'sub_categories.description', 
            'sub_categories.created_at', 'users.name',)->first();

            return response()->json(['message' => 'success', 'data'=>$sub_category]);

        }

        catch (ModelNotFoundException $e){

            Log::Error($e);

            return response()->json([
                'message' => 'Sub Category not found'
            ], 404);

        }
        
    }



    public function getUpdateSubCategory($id){

        // if( !Auth::user()->can('edit-sub-category')){

        //     return abort('403'); 
        // }

        try{

            $sub_category = SubCategory::leftJoin('users', 'sub_categories.created_by', '=', 'users.id')
            ->leftJoin('sub_category_group', 'sub_category_group.sub_category_id', '=', 'sub_categories.id')
            ->leftJoin('sub_category_category', 'sub_category_category.sub_category_id', '=', 'sub_categories.id')
            //->where('sub_categories.is_active', 1)
            ->where('sub_categories.sub_category_reference', $id)
            ->select('sub_categories.sub_category_reference', 'sub_categories.sub_category', 'sub_categories.description', 
            'sub_categories.is_active',
            'sub_categories.created_at', 'users.name', 'sub_category_group.group_id', 'sub_category_category.category_id')->first();

            return response()->json(['message' => 'success', 'record'=>$sub_category]);

        }

        catch (ModelNotFoundException $e){

            Log::Error($e);

            return response()->json([
                'message' => 'Sub Category not found'
            ], 404);

        }
        
    }



    public function updateSubCategory(EditSubCategoryRequest $request){

        // $user = Auth::user();

        // if( $user->can('edit-sub-category')){

        //     return abort('403'); 
        // }
       
        $validated =  $request->validated();

        //info($validated);

        try{

            \DB::beginTransaction();

            $sub_category = SubCategory::where('sub_category_reference', $validated['sub_category_reference'])->first();  
            
            if($group === null ){
                $error_message = array('group_reference' => array('Sub Category does not exist'));
                return response()->json([
                    'message' => 'The given data was invalid',
                    'errors' => $error_message
                ], 422);
            }

            $sub_category->where('sub_category_reference', $validated['sub_category_reference'])->update($validated);

            \DB::commit();

            return response()->json(['message' => 'Sub Category updated successfully']);

        }
        catch(\Exception $e){
       
            \DB::rollBack();

            Log::Error($e);

            return response()->json(['message' => 'Error updating Sub Category'], 500);
        }
    
    }



    public function deleteSubCategory($id){

        // if( !Auth::user()->can('delete-sub-category')){

        //     return abort('403'); 
        // }

        try{

            $sub_category = SubCategory::where('sub_category_reference', $id)->first();
            $sub_category->delete();

            return response()->json(['message' => 'Sub Category deleted successfully.']);

        }

        catch (ModelNotFoundException $e){

            Log::Error($e);

            return response()->json([
                'message' => 'Sub Category not found'
            ], 404);

        }


    }




}
