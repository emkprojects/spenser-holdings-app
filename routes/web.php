<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Web\LearningMaterials\ProgramController;

use App\Http\Controllers\Web\Settings\SettingsController;

use App\Http\Controllers\Web\Administration\RoleController;
use App\Http\Controllers\Web\Administration\EmployeeController;
use App\Http\Controllers\Web\Administration\AdministrationController;
use App\Http\Controllers\Web\Administration\CustomerController;
use App\Http\Controllers\Web\Administration\SupplierController;

use App\Http\Controllers\Web\InventoryManagement\InventoryController;
use App\Http\Controllers\Web\InventoryManagement\ExpenseController;
use App\Http\Controllers\Web\InventoryManagement\PurchaseController;

use App\Http\Controllers\Web\ProductionManagement\ProductionController;

use App\Http\Controllers\Web\OrderManagement\OrderController;

use App\Http\Controllers\Web\SalesManagement\SaleController;

Route::group(['middleware' => 'auth'], function () {

    /////////// HUMAN RESOURCE ROUTES  /////////////////////////////////////////////////////////////////////////////////////

    ///////// Role Routes //////////////////////////////////////////////////////////////////////////////////////////
    Route::get('/roles', [RoleController::class, 'getRoles']);
    Route::get('/specific-role/{record_reference}', [RoleController::class, 'getRoleDetails']);
    Route::post('/add-role', [RoleController::class, 'addRole']);
    Route::get('/edit-role/{record_reference}', [RoleController::class, 'getEditRole']);
    Route::post('/edit-role', [RoleController::class, 'editRole']);
    Route::post('/delete-role/{record_reference}', [RoleController::class, 'deleteRole']);

    ///////// Permission Routes /////////////////////////////////////////////////////////////////////////////////
    Route::get('/permissions', [RoleController::class, 'getPermissions']);
    Route::get('/specific-permission/{record_reference}', [RoleController::class, 'getPermissionDetails']);
    Route::post('/add-permission', [RoleController::class, 'addPermission']);
    Route::get('/edit-permission/{record_reference}', [RoleController::class, 'getEditPermission']);
    Route::post('/edit-permission', [RoleController::class, 'editPermission']);
    Route::post('/delete-permission/{record_reference}', [RoleController::class, 'deletePermission']);

    //Route::get('/assign-role-permissions', [RoleController::class, 'getRolesForAssignment']);    
    Route::get('/permissions-by-role/{role}', [RoleController::class, 'getPermissionsByRole']);
    Route::post('/add-permissions-to-role/{role}', [RoleController::class, 'addPermissionToRole']);
   
    ///////// Employees ////////////////////////////////////////////////////////////////////////////////////////    
    Route::get('/employees', [EmployeeController::class, 'getEmployees']);
    Route::get('/new-employee', [EmployeeController::class, 'getAddEmployee']);
    Route::post('/add-employee', [EmployeeController::class, 'addEmployee']);
    Route::get('/specific-employee/{record_reference}', [EmployeeController::class, 'viewEmployee']);
    Route::get('/edit-employee/{record_reference}', [EmployeeController::class, 'getEditEmployee']);
    Route::post('/edit-employee', [EmployeeController::class, 'editEmployee']);
    Route::post('/delete-employee/{record_reference}', [EmployeeController::class, 'deleteEmployee']);
    

    ////////////// ADMINISTRATION ROUTES ///////////////////////////////////////////////////////////////////////////////
    
    Route::get('/dashboard', [AdministrationController::class, 'getDashboard'])->name('dashboard');

    ////////////// Customer Type Routes ///////////////////////////////////////////////////////////////////////////////
    Route::get('/customer-types', [SettingsController::class, 'getCustomerTypes'])->name('view.customer.types');
    Route::get('/add-customer-type', [SettingsController::class, 'getAddCustomerType'])->name('new.customer.type');
    Route::post('/add-customer-type', [SettingsController::class, 'addCustomerType'])->name('add.customer.type');
    Route::get('/specific-customer-type/{record_reference}', [SettingsController::class, 'getViewCustomerType'])->name('specific.customer.type');
    Route::get('/edit-customer-type/{record_reference}', [SettingsController::class, 'getUpdateCustomerType'])->name('edit.customer.type');
    Route::post('/edit-customer-type', [SettingsController::class, 'updateCustomerType'])->name('update.customer.type');
    Route::post('/delete-customer-type/{record_reference}', [SettingsController::class, 'deleteCustomerType'])->name('remove.customer.type');

    ////////////// Customer Routes ///////////////////////////////////////////////////////////////////////////////////
    Route::get('/customers', [CustomerController::class, 'getCustomers'])->name('view.customers');
    Route::get('/new-customer', [CustomerController::class, 'getAddCustomer'])->name('new.customer');
    Route::post('/add-customer', [CustomerController::class, 'addCustomer'])->name('add.customer');
    Route::get('/specific-customer/{record_reference}', [CustomerController::class, 'viewCustomer'])->name('specific.customer');
    Route::get('/edit-customer/{record_reference}', [CustomerController::class, 'getUpdateCustomer'])->name('edit.customer');
    Route::post('/edit-customer', [CustomerController::class, 'updateCustomer'])->name('update.customer');
    Route::post('/delete-customer/{record_reference}', [CustomerController::class, 'deleteCustomer'])->name('remove.customer');

    ////////////// Supplier Type Routes ///////////////////////////////////////////////////////////////////////////////
    Route::get('/supplier-types', [SettingsController::class, 'getSupplierTypes'])->name('view.supplier.types');
    Route::get('/add-supplier-type', [SettingsController::class, 'getAddSupplierType'])->name('new.supplier.type');
    Route::post('/add-supplier-type', [SettingsController::class, 'addSupplierType'])->name('add.supplier.type');
    Route::get('/specific-supplier-type/{record_reference}', [SettingsController::class, 'getViewSupplierType'])->name('specific.supplier.type');
    Route::get('/edit-supplier-type/{record_reference}', [SettingsController::class, 'getUpdateSupplierType'])->name('edit.supplier.type');
    Route::post('/edit-supplier-type', [SettingsController::class, 'updateSupplierType'])->name('update.supplier.type');
    Route::post('/delete-supplier-type/{record_reference}', [SettingsController::class, 'deleteSupplierType'])->name('remove.supplier.type');

    ////////////// Supplier Routes ////////////////////////////////////////////////////////////////////////////////
    Route::get('/suppliers', [SupplierController::class, 'getSuppliers'])->name('view.suppliers');
    Route::get('/new-supplier', [SupplierController::class, 'getAddSupplier'])->name('new.supplier');
    Route::post('/add-supplier', [SupplierController::class, 'addSupplier'])->name('add.supplier');
    Route::get('/specific-supplier/{record_reference}', [SupplierController::class, 'viewSupplier'])->name('specific.supplier');
    Route::get('/edit-supplier/{record_reference}', [SupplierController::class, 'getUpdateSupplier'])->name('edit.supplier');
    Route::post('/edit-supplier', [SupplierController::class, 'updateSupplier'])->name('update.supplier');
    Route::post('/delete-supplier/{record_reference}', [SupplierController::class, 'deleteSupplier'])->name('remove.supplier');
    

    //////////////////////////// IVENTORY ROUTES /////////////////////////////////////////////////////////////////////

    //////////////// Item Categories /////////////////////////////////////////////////////////////////////////
    Route::get('/item-categories', [SettingsController::class, 'getItemCategory'])->name('view.item.categories');
    Route::post('/add-item-category', [SettingsController::class, 'addItemCategory'])->name('add.item.category');
    Route::get('/specific-item-category/{record_reference}', [SettingsController::class, 'getViewItemCategory'])->name('specific.item.category');
    Route::get('/edit-item-category/{record_reference}', [SettingsController::class, 'getUpdateItemCategory'])->name('edit.item.category');
    Route::post('/edit-item-category', [SettingsController::class, 'updateItemCategory'])->name('update.item.category');
    Route::post('/delete-item-category/{record_reference}', [SettingsController::class, 'deleteItemCategory'])->name('remove.item.category');

    ////////////// Item Routes /////////////////////////////////////////////////////////////////////////////
    Route::get('/items', [InventoryController::class, 'getItems'])->name('view.items');
    Route::get('/add-item', [InventoryController::class, 'getAddItem'])->name('new.item');
    Route::post('/new-item', [InventoryController::class, 'addItem'])->name('add.item');
    Route::get('/specific-item/{record_reference}', [InventoryController::class, 'viewItem'])->name('specific.item');
    Route::get('/edit-item/{record_reference}', [InventoryController::class, 'getUpdateItem'])->name('edit.item');
    Route::post('/edit-item', [InventoryController::class, 'updateItem'])->name('update.item');
    Route::post('/delete-item/{record_reference}', [InventoryController::class, 'deleteItem'])->name('remove.item');

    ////////////// Purchase Routes /////////////////////////////////////////////////////////////////////////////
    Route::get('/purchases', [PurchaseController::class, 'getPurchases'])->name('view.purchases');
    Route::get('/add-purchase', [PurchaseController::class, 'getAddPurchase'])->name('new.purchase');
    Route::post('/new-purchase', [PurchaseController::class, 'addPurchase'])->name('add.purchase');
    Route::get('/specific-purchase/{record_reference}', [PurchaseController::class, 'viewPurchase'])->name('specific.purchase');
    Route::get('/edit-purchase/{record_reference}', [PurchaseController::class, 'getUpdatePurchase'])->name('edit.purchase');
    Route::post('/edit-purchase', [PurchaseController::class, 'updatePurchase'])->name('update.purchase');
    Route::post('/delete-purchase/{record_reference}', [PurchaseController::class, 'deletePurchase'])->name('remove.purchase');



    //////////////////////////// PRODUCTION ROUTES /////////////////////////////////////////////////////////////////////

    //////////////// Inventory Category Routes ///////////////////////////////////////////////////////////////////////
    Route::get('/inventory-categories', [SettingsController::class, 'getInventoryCategory'])->name('view.inventory.categories');
    Route::post('/add-inventory-category', [SettingsController::class, 'addInventoryCategory'])->name('add.inventory.category');
    Route::get('/specific-inventory-category/{record_reference}', [SettingsController::class, 'getViewInventoryCategory'])->name('specific.inventory.category');
    Route::get('/edit-inventory-category/{record_reference}', [SettingsController::class, 'getUpdateInventoryCategory'])->name('edit.inventory.category');
    Route::post('/edit-inventory-category', [SettingsController::class, 'updateInventoryCategory'])->name('update.inventory.category');
    Route::post('/delete-inventory-category/{record_reference}', [SettingsController::class, 'deleteInventoryCategory'])->name('remove.inventory.category');
    
    //////////////// Inventory Routes ////////////////////////////////////////////////////////////////////////////////////
    Route::get('/inventories', [InventoryController::class, 'getInventories'])->name('view.inventories');
    Route::post('/add-inventory', [InventoryController::class, 'addInventory'])->name('add.inventory');
    Route::get('/specific-inventory/{record_reference}', [InventoryController::class, 'getViewInventory'])->name('specific.inventory');
    Route::get('/edit-inventory/{record_reference}', [InventoryController::class, 'getUpdateInventory'])->name('edit.inventory');
    Route::post('/edit-inventory', [InventoryController::class, 'updateInventory'])->name('update.inventory');
    Route::post('/delete-inventory/{record_reference}', [InventoryController::class, 'deleteInventory'])->name('remove.inventory');
        
    //////////////// Raw Material Routes ////////////////////////////////////////////////////////////////////////////////////
    Route::get('/raw-materials', [InventoryController::class, 'getRawMaterials'])->name('view.raw.materials');
    Route::post('/add-raw-material', [InventoryController::class, 'addRawMaterial'])->name('add.raw.material');
    Route::get('/specific-raw-material/{record_reference}', [InventoryController::class, 'getViewRawMaterial'])->name('specific.raw.material');
    Route::get('/edit-raw-material/{record_reference}', [InventoryController::class, 'getUpdateRawMaterial'])->name('edit.raw.material');
    Route::post('/edit-raw-material', [InventoryController::class, 'updateRawMaterial'])->name('update.raw.material');
    Route::post('/delete-raw-material/{record_reference}', [InventoryController::class, 'deleteRawMaterial'])->name('remove.raw.material');
    
    ////////////// Production Routes //////////////////////////////////////////////////////////////////////////////////
    Route::get('/productions', [ProductionController::class, 'getProductions'])->name('view.productions');
    Route::get('/add-production', [ProductionController::class, 'getAddProduction'])->name('new.production');
    Route::post('/add-production', [ProductionController::class, 'addProduction'])->name('add.production');
    Route::get('/specific-production/{record_reference}', [ProductionController::class, 'getViewProduction'])->name('specific.production');
    Route::get('/edit-production/{record_reference}', [ProductionController::class, 'getUpdateProduction'])->name('edit.production');
    Route::post('/edit-production', [ProductionController::class, 'updateProduction'])->name('update.production');
    Route::post('/delete-production/{record_reference}', [ProductionController::class, 'deleteProduction'])->name('remove.production');

    //////////////// Product Categories ///////////////////////////////////////////////////////////////////////////////
    Route::get('/product-categories', [SettingsController::class, 'getProductCategory'])->name('view.product.categories');
    Route::post('/add-product-category', [SettingsController::class, 'addProductCategory'])->name('add.product.category');
    Route::get('/specific-product-category/{record_reference}', [SettingsController::class, 'getViewProductCategory'])->name('specific.product.category');
    Route::get('/edit-product-category/{record_reference}', [SettingsController::class, 'getUpdateProductCategory'])->name('edit.product.category');
    Route::post('/edit-product-category', [SettingsController::class, 'updateProductCategory'])->name('update.product.category');
    Route::post('/delete-product-category/{record_reference}', [SettingsController::class, 'deleteProductCategory'])->name('remove.product.category');

    ////////////// Product Routes /////////////////////////////////////////////////////////////////////////////////////
    Route::get('/products', [ProductController::class, 'getProducts'])->name('view.items');
    Route::get('/add-product', [ProductController::class, 'getAddProduct'])->name('new.product');
    Route::post('/add-product', [ProductController::class, 'addProduct'])->name('add.product');
    Route::get('/specific-product/{record_reference}', [ProductController::class, 'getViewProduct'])->name('specific.product');
    Route::get('/edit-product/{record_reference}', [ProductController::class, 'getUpdateProduct'])->name('edit.product');
    Route::post('/edit-product', [ProductController::class, 'updateProduct'])->name('update.product');
    Route::post('/delete-product/{record_reference}', [ProductController::class, 'deleteProduct'])->name('remove.product');


    //////////////////////////// SALES ROUTES /////////////////////////////////////////////////////////////////////


    ////////////// Settings Routes /////////////////////////////////////////////////////////////////////////////
   
    //////////////// Groups /////////////////////////////////
    Route::get('/groups', [SettingsController::class, 'getGroups'])->name('view.groups');
    Route::post('/add-group', [SettingsController::class, 'addGroup'])->name('add.group');
    Route::get('/specific-group/{group_reference}', [SettingsController::class, 'getViewGroup'])->name('specific.proup');
    Route::get('/edit-group/{group_reference}', [SettingsController::class, 'getUpdateGroup'])->name('edit.group');
    Route::post('/edit-group', [SettingsController::class, 'updateGroup'])->name('update.group');
    Route::post('/delete-group/{group_reference}', [SettingsController::class, 'deleteGroup'])->name('remove.group');
    
    //////////////// Categories //////////////////////////////
    Route::get('/categories', [SettingsController::class, 'getCategory'])->name('view.categories');

    //////////////// Currencies /////////////////////////////
    Route::get('/currencies', [SettingsController::class, 'getCurrency'])->name('view.currencies');

    //////////////// Metrics //////////////////////////
    Route::get('/metrics', [SettingsController::class, 'getMetrics'])->name('view.metrics');

    //////////////// Payment Method //////////////////////////
    Route::get('/payment-methods', [SettingsController::class, 'getPaymentMethod'])->name('view.payment.mehtods');
    
    //////////////// Statuses //////////////////////////////
    Route::get('/statuses', [SettingsController::class, 'getStatus'])->name('view.statuses');

    //////////////// Sub Categories //////////////////////////
    // Route::get('/view-sub-categories', [SettingsController::class, 'getSubCategory'])->name('view.sub.categories');
    // Route::post('/add-sub-category', [SettingsController::class, 'addSubCategory'])->name('add.sub.category');
    // Route::get('/specific-sub-category/{record_reference}', [SettingsController::class, 'getViewSubCategory'])->name('specific.sub.category');
    // Route::get('/edit-sub-category/{record_reference}', [SettingsController::class, 'getUpdateSubCategory'])->name('edit.sub.category');
    // Route::post('/edit-sub-category', [SettingsController::class, 'updateSubCategory'])->name('update.sub.category');
    // Route::post('/delete-sub-category/{record_reference}', [SettingsController::class, 'deleteSubCategory'])->name('remove.sub.category');
    
    ////////////// Program Routes /////////////////////////////////////////////////////////////////////////////
    // Route::get('/view-programs', [ProgramController::class, 'getPrograms'])->name('view.programs');
    // Route::get('/add-program', [ProgramController::class, 'getAddProgram'])->name('new.program');
    // Route::post('/add-program', [ProgramController::class, 'addProgram'])->name('add.program');
    // Route::get('/specific-program/{program_reference}', [ProgramController::class, 'getViewProgram'])->name('specific.program');
    // Route::get('/edit-program/{program_reference}', [ProgramController::class, 'getUpdateProgram'])->name('edit.program');
    // Route::post('/edit-program', [ProgramController::class, 'updateProgram'])->name('update.program');
    // Route::post('/delete-program/{program_reference}', [ProgramController::class, 'deleteProgram'])->name('remove.program');


});

//////////////AUTH ROUTES ///////////////////////////////////////////////////////////////////////

Route::get('/',  [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/unauthorized',  [AdministrationController::class, 'getUnauthorized'])->name('unauthorized');
Auth::routes(['register' => false]);
