<!DOCTYPE html>
<html lang="en" class=" layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-skin="default" data-bs-theme="light" data-assets-path="/assets/" data-template="vertical-menu-template">
  
    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <meta name="robots" content="noindex, nofollow" />
        <title>SIMS - {{$title}}</title>    
        
        <!-- Canonical SEO -->
        <meta name="description" content="SPENSER HOLDINGS LTD SIMS" />
        <meta name="keywords" content="" />
        <meta property="og:title" content="SIMS" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="https://staging.spenserholdings.org" />
        <meta property="og:image" content="" />
        <meta property="og:description" content="SPENSER HOLDINGS LTD SIMS" />
        <meta property="og:site_name" content="SIMS" />
        <link rel="canonical" href="" />           
        
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon/favicon.ico') }}" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/iconify-icons.css') }}" rel="stylesheet" type="text/css" />

        <!-- Core CSS -->
        <!-- build:css assets/vendor/css/theme.css  -->    
        <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/node-waves/node-waves.css') }}" rel="stylesheet" type="text/css" /> 
        <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/pickr/pickr-themes.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('/assets/vendor/css/core.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- Vendors CSS -->    
        <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
        
        <!-- endbuild -->
        <!-- <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/apex-charts/apex-charts.css') }}" /> -->
        <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/swiper/swiper.css') }}" />
        <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/flag-icons.css') }}" />

        <!-- Page CSS -->
        <!-- <link rel="stylesheet" href="{{ asset('/assets/vendor/css/pages/cards-advance.css') }}" /> -->

        <!-- Helpers -->
        <script src="{{ asset('/assets/vendor/js/helpers.js') }}"></script>
        <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
        
        <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
        <script src="{{ asset('/assets/vendor/js/template-customizer.js') }}"></script>
        
        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->    
        <script src="{{ asset('/assets/js/config.js') }}"></script>

        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" /> -->

        <style>
            .swal2-container {
                z-index: 20000 !important;
            }
        </style>

        @stack('stylesheets')
    
    </head>

    <body>    
    
        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar  ">
        
            <div class="layout-container">
                
                <!-- Menu -->
                <aside id="layout-menu" class="layout-menu menu-vertical menu" >
                
                    <div class="app-brand demo ">
                    
                        <a href="/" class="app-brand-link">
                            <span class="app-brand-logo demo">
                                <span class="text-primary">
                                    <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="currentColor" />
                                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
                                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                            <span class="app-brand-text demo menu-text fw-bold ms-3">SIMS</span>
                        </a>

                        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="icon-base ti menu-toggle-icon d-none d-xl-block"></i>
                        <i class="icon-base ti tabler-x d-block d-xl-none"></i>
                        </a>
                        
                    </div>

                    <div class="menu-inner-shadow"></div>	  
                
                    <ul class="menu-inner py-1">

                        @can('manage-dashboard')
                        <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
                            <a href="/dashboard" class="menu-link">
                                <i class="menu-icon icon-base ti tabler-smart-home"></i>
                                <div data-i18n="Dashboard">Dashboard</div>
                            </a>
                        </li>
                        @endcan
                    
                        <!-- Sales Management menu start -->
                        @can('manage-sales')
                        <li class="menu-item {{ request()->is('view-programs') ? 'active open' : '' }} {{ request()->is('add-program') ? 'active open' : '' }}  {{ request()->is('edit-program/*') ? 'active open' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon icon-base ti tabler-shopping-cart"></i>
                                <div data-i18n="Sales Management">Sales Management</div>
                            </a>

                            <ul class="menu-sub">      
                                
                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                    <div data-i18n="New Sale">New Sale</div>
                                    </a>
                                </li>
                                
                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                    <div data-i18n="Sales">View Sales</div>
                                    </a>
                                </li>
                               
                                <!-- <li class="menu-item {{ request()->is('view-programs') ? 'active open' : '' }} {{ request()->is('add-program') ? 'active open' : '' }} {{ request()->is('edit-program/*') ? 'active open' : '' }}">
                                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                                        <i class="menu-icon icon-base ti tabler-layout-navbar"></i>
                                        <div data-i18n="Programs">Programs</div>
                                    </a>

                                    <ul class="menu-sub">
                                        <li class="menu-item {{ request()->is('add-program') ? 'active' : '' }}">
                                            <a href="/add-program" class="menu-link">
                                                <div data-i18n="New Program">New Program</div>
                                            </a>
                                        </li>
                                        <li class="menu-item {{ request()->is('view-programs') ? 'active' : '' }} {{ request()->is('edit-program/*') ? 'active' : '' }}">
                                            <a href="/view-programs" class="menu-link">
                                                <div data-i18n="View Programs">View Programs</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li> -->
                                

                            </ul>

                        </li>
                        @endcan
                        <!-- Sales Management menu end -->


                        <!-- Order Management menu start -->
                        @can('manage-orders')
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon icon-base ti tabler-files"></i>
                                <div data-i18n="Order Management">Order Management</div>
                            </a>
                            <ul class="menu-sub">

                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                    <div data-i18n="New Order">New Order</div>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                    <div data-i18n="View Orders">View Orders</div>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endcan
                        <!-- Order Management menu end -->


                        <!-- Product Management menu start -->
                        @can('manage-products')
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon icon-base ti tabler-list"></i>
                                <div data-i18n="Product Management">Product Management</div>
                            </a>
                            <ul class="menu-sub">

                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                    <div data-i18n="New Product">New Product</div>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                    <div data-i18n="View Products">View Products</div>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endcan
                        <!-- Product Management menu end -->


                        <!-- Production Management menu start -->
                        <!-- <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon icon-base ti tabler-building"></i>
                                <div data-i18n="Production Management">Production Management</div>
                            </a>
                            <ul class="menu-sub">

                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                    <div data-i18n="New Production">New Production</div>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                    <div data-i18n="View Productions">View Productions</div>
                                    </a>
                                </li>

                            </ul>
                        </li> -->
                        <!-- Production Management menu end -->


                        <!-- Purchase Management menu start -->
                        @can('manage-stock')
                        <li class="menu-item {{ request()->is('purchases') ? 'active open' : '' }} {{ request()->is('specific-purchase/*') ? 'active open' : '' }} {{ request()->is('new-purchase') ? 'active open' : '' }} {{ request()->is('items') ? 'active open' : '' }} {{ request()->is('specific-item/*') ? 'active open' : '' }} {{ request()->is('new-item') ? 'active open' : '' }} 
                        {{ request()->is('inventories') ? 'active open' : '' }} {{ request()->is('specific-inventory/*') ? 'active open' : '' }} {{ request()->is('new-inventory') ? 'active open' : '' }} {{ request()->is('edit-inventory/*') ? 'active open' : '' }} 
                         {{ request()->is('raw-materials') ? 'active open' : '' }} {{ request()->is('specific-raw-material/*') ? 'active open' : '' }} {{ request()->is('new-raw-material') ? 'active open' : '' }} {{ request()->is('edit-raw-material/*') ? 'active open' : '' }}
                        
                        {{ request()->is('productions') ? 'active open' : '' }} {{ request()->is('specific-production/*') ? 'active open' : '' }} {{ request()->is('new-production') ? 'active open' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon icon-base ti tabler-cash"></i>
                                <div data-i18n="Stock Management">Stock Management</div>
                            </a>
                            <ul class="menu-sub">

                                <li class="menu-item {{ request()->is('purchases') ? 'active open' : '' }} {{ request()->is('specific-purchase/*') ? 'active open' : '' }} {{ request()->is('new-purchase') ? 'active open' : '' }} {{ request()->is('edit-purchase/*') ? 'active open' : '' }}">
                                    <a href="/purchases" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-briefcase"></i>
                                    <div data-i18n="Purchases">Purchases</div>
                                    </a>
                                </li>

                                <li class="menu-item {{ request()->is('items') ? 'active open' : '' }} {{ request()->is('specific-item/*') ? 'active open' : '' }} {{ request()->is('new-item') ? 'active open' : '' }} {{ request()->is('edit-item/*') ? 'active open' : '' }}  ">
                                    <a href="/items" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-list"></i>
                                    <div data-i18n="Items">Items</div>
                                    </a>
                                </li>

                                <li class="menu-item {{ request()->is('inventories') ? 'active open' : '' }} {{ request()->is('specific-inventory/*') ? 'active open' : '' }} {{ request()->is('new-inventory') ? 'active open' : '' }} {{ request()->is('edit-inventory/*') ? 'active open' : '' }} ">
                                    <a href="/inventories" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-building-warehouse"></i>
                                    <div data-i18n="Inventory">Inventory</div>
                                    </a>
                                </li>

                                <li class="menu-item {{ request()->is('raw-materials') ? 'active open' : '' }} {{ request()->is('specific-raw-material/*') ? 'active open' : '' }} {{ request()->is('new-raw-material') ? 'active open' : '' }} {{ request()->is('edit-raw-material/*') ? 'active open' : '' }} ">
                                    <a href="/raw-materials" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-table-dashed"></i>
                                    <div data-i18n="Raw Materials">Raw Materials</div>
                                    </a>
                                </li>

                                <li class="menu-item {{ request()->is('productions') ? 'active open' : '' }} {{ request()->is('specific-production/*') ? 'active open' : '' }} {{ request()->is('new-production') ? 'active open' : '' }} {{ request()->is('edit-production/*') ? 'active open' : '' }}">
                                    <a href="/productions" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-building-factory"></i>
                                    <div data-i18n="Productions">Productions</div>
                                    </a>
                                </li>

                                <!-- <li class="menu-item">
                                    <a href="#" class="menu-link">
                                    <div data-i18n="Raw Materials">Raw Materials</div>
                                    </a>
                                </li> -->

                            </ul>
                        </li>
                        @endcan
                        <!-- Purchase Management menu end -->


                        <!-- Item Management menu start -->
                        <!-- <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon icon-base ti tabler-list"></i>
                                <div data-i18n="Item Management">Item Management</div>
                            </a>
                            <ul class="menu-sub">

                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                    <div data-i18n="New Item">New Item</div>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                    <div data-i18n="View Items">View Items</div>
                                    </a>
                                </li>

                            </ul>
                        </li> -->
                        <!-- Item Management menu end -->


                        <!-- Expense Management menu start -->
                        @can('manage-expenses')
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon icon-base ti tabler-cash"></i>
                                <div data-i18n="Expense Management">Expense Management</div>
                            </a>
                            <ul class="menu-sub">

                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                    <div data-i18n="New Expense">New Expense</div>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                    <div data-i18n="View Expenses">View Expenses</div>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endcan
                        <!-- Expense Management menu end -->

                        

                        <!-- Customer Management menu start -->
                        @can('manage-customers')
                        <li class="menu-item {{ request()->is('customers') ? 'active open' : '' }} {{ request()->is('new-customer') ? 'active open' : '' }} {{ request()->is('specific-customer/*') ? 'active open' : '' }} {{ request()->is('edit-customer/*') ? 'active open' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon icon-base ti tabler-users"></i>
                                <div data-i18n="Client Management">Client Management</div>
                            </a>
                            <ul class="menu-sub">

                                <li class="menu-item {{ request()->is('new-customer') ? 'active' : '' }}">
                                    <a href="/new-customer" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-user-plus"></i>
                                    <div data-i18n="New Customer">New Customer</div>
                                    </a>
                                </li>

                               <li class="menu-item {{ request()->is('customers') ? 'active' : '' }} {{ request()->is('specific-customer/*') ? 'active open' : '' }} {{ request()->is('edit-customer/*') ? 'active open' : '' }}">
                                    <a href="/customers" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-user-plus"></i>
                                    <div data-i18n="View Customers">View Customers</div>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endcan
                        <!-- Customer Management menu end -->


                        <!-- Referrer Management menu start -->
                        @can('manage-referrers')
                        <li class="menu-item {{ request()->is('referrers') ? 'active open' : '' }} {{ request()->is('new-referrer') ? 'active open' : '' }} {{ request()->is('specific-referrer/*') ? 'active open' : '' }} {{ request()->is('edit-referrer/*') ? 'active open' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon icon-base ti tabler-users"></i>
                                <div data-i18n="Referrer Management">Referrer Management</div>
                            </a>
                            <ul class="menu-sub">

                                <li class="menu-item {{ request()->is('new-referrer') ? 'active' : '' }}">
                                    <a href="/new-referrer" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-user-plus"></i>
                                    <div data-i18n="New Referrer">New Referrer</div>
                                    </a>
                                </li>

                               <li class="menu-item {{ request()->is('referrers') ? 'active' : '' }} {{ request()->is('specific-referrer/*') ? 'active open' : '' }} {{ request()->is('edit-referrer/*') ? 'active open' : '' }}">
                                    <a href="/referrers" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-user-plus"></i>
                                    <div data-i18n="View Referrers">View Referrers</div>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endcan
                        <!-- Referrer Management menu end -->


                        <!-- Supplier Management menu start -->
                        @can('manage-suppliers')
                        <li class="menu-item {{ request()->is('suppliers') ? 'active open' : '' }} {{ request()->is('new-supplier') ? 'active open' : '' }} {{ request()->is('specific-supplier/*') ? 'active open' : '' }} {{ request()->is('edit-supplier/*') ? 'active open' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon icon-base ti tabler-truck"></i>
                                <div data-i18n="Supplier Management">Supplier Management</div>
                            </a>
                            <ul class="menu-sub">

                                 <li class="menu-item {{ request()->is('new-supplier') ? 'active' : '' }}">
                                    <a href="/new-supplier" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-user-plus"></i>
                                    <div data-i18n="New Supplier">New Supplier</div>
                                    </a>
                                </li>

                                 <li class="menu-item {{ request()->is('suppliers') ? 'active' : '' }} {{ request()->is('specific-supplier/*') ? 'active open' : '' }} {{ request()->is('edit-supplier/*') ? 'active open' : '' }}">
                                    <a href="/suppliers" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-user-plus"></i>
                                    <div data-i18n="View Suppliers">View Suppliers</div>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endcan
                        <!-- Supplier Management menu end -->


                        <!-- User Management menu start -->
                        @can('manage-users')
                        <li class="menu-item {{ request()->is('employees') ? 'active open' : '' }} {{ request()->is('new-employee') ? 'active open' : '' }} {{ request()->is('specific-employee/*') ? 'active open' : '' }} {{ request()->is('edit-employee/*') ? 'active open' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon icon-base ti tabler-users"></i>
                                <div data-i18n="User Management">User Management</div>
                            </a>
                            <ul class="menu-sub">

                                @can('add-users')
                                 <li class="menu-item {{ request()->is('new-employee') ? 'active' : '' }}">
                                    <a href="/new-employee" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-user-plus"></i>
                                    <div data-i18n="New Employee">New Employee</div>
                                    </a>
                                </li>
                                @endcan

                                @can('view-users')
                                 <li class="menu-item {{ request()->is('employees') ? 'active' : '' }} {{ request()->is('specific-employee/*') ? 'active open' : '' }} {{ request()->is('edit-employee/*') ? 'active open' : '' }}">
                                    <a href="/employees" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-users"></i>
                                    <div data-i18n="View Employees">View Employees</div>
                                    </a>
                                </li>
                                @endcan

                                <!-- <li class="menu-item">
                                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                                        <i class="menu-icon icon-base ti tabler-users"></i>
                                        <div data-i18n="Administrators">Administrators</div>
                                    </a>

                                    <ul class="menu-sub">
                                        <li class="menu-item">
                                            <a href="/add-administrator" class="menu-link">
                                                <div data-i18n="New Administrator">New Administrator</div>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="/administrators" class="menu-link">
                                                <div data-i18n="View Administrators">View Administrators</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>


                                <li class="menu-item">
                                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                                        <i class="menu-icon icon-base ti tabler-users"></i>
                                        <div data-i18n="Cashiers">Cashiers</div>
                                    </a>

                                    <ul class="menu-sub">
                                        <li class="menu-item">
                                            <a href="/add-cashier" class="menu-link">
                                                <div data-i18n="New Cashier">New Cashier</div>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="/cashiers" class="menu-link">
                                                <div data-i18n="View Cashier">View Cashiers</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="menu-item">
                                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                                        <i class="menu-icon icon-base ti tabler-users"></i>
                                        <div data-i18n="Support">Support</div>
                                    </a>

                                    <ul class="menu-sub">
                                        <li class="menu-item">
                                            <a href="/add-support" class="menu-link">
                                                <div data-i18n="New Support">New Support</div>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="/support" class="menu-link">
                                                <div data-i18n="View Support">View Support</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li> -->

                            </ul>
                        </li>
                        @endcan
                        <!-- User Management menu end -->


                        <!-- Role Management menu start -->
                        @can('manage-roles')
                        <li class="menu-item {{ request()->is('roles') ? 'active open' : '' }} {{ request()->is('permissions') ? 'active open' : '' }} {{ request()->is('assign-role-permissions') ? 'active open' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon icon-base ti tabler-lock"></i>
                                <div data-i18n="Role Management">Role Management</div>
                            </a>
                            <ul class="menu-sub">

                                @can('view-roles')
                                 <li class="menu-item {{ request()->is('roles') ? 'active' : '' }}">
                                    <a href="/roles" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-lock"></i>
                                    <div data-i18n="Roles">Roles</div>
                                    </a>
                                </li>
                                @endcan

                                @can('view-permissions')
                                 <li class="menu-item {{ request()->is('permissions') ? 'active' : '' }}">
                                    <a href="/permissions" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-lock"></i>
                                    <div data-i18n="Permissions">Permissions</div>
                                    </a>
                                </li>
                                @endcan

                                @can('assign-role-permissions')
                                <!-- <li class="menu-item {{ request()->is('assign-role-permissions') ? 'active' : '' }}">
                                    <a href="/assign-role-permissions" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-lock"></i>
                                    <div data-i18n="Assign Permissions">Assign Permissions</div>
                                    </a>
                                </li> -->
                                @endcan

                            </ul>
                        </li>
                        @endcan
                        <!-- Role Management menu end -->


                        <!-- Settings Management menu start -->
                        @can('manage-settings')
                        <li class="menu-item {{ request()->is('product-categories') ? 'active open' : '' }} {{ request()->is('inventory-categories') ? 'active open' : '' }} {{ request()->is('referrer-types') ? 'active open' : '' }} {{ request()->is('customer-types') ? 'active open' : '' }}  {{ request()->is('supplier-types') ? 'active open' : '' }}  {{ request()->is('statuses') ? 'active open' : '' }} {{ request()->is('item-categories') ? 'active open' : '' }} {{ request()->is('categories') ? 'active open' : '' }} {{ request()->is('payment-methods') ? 'active open' : '' }} {{ request()->is('groups') ? 'active open' : '' }} {{ request()->is('currencies') ? 'active open' : '' }} {{ request()->is('metrics') ? 'active open' : '' }}">

                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon icon-base ti tabler-settings"></i>
                                <div data-i18n="Settings Management">Settings Management</div>
                            </a>

                            <ul class="menu-sub">
                              
                                @can('manage-product-categories')
                                <li class="menu-item {{ request()->is('product-categories') ? 'active' : '' }}">
                                    <a href="/product-categories" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-layout-navbar"></i>
                                    <div data-i18n="Product Categories">Product Categories</div>
                                    </a>
                                </li>
                                @endcan
                                
                                @can('manage-item-categories')
                                <li class="menu-item {{ request()->is('item-categories') ? 'active' : '' }}">
                                    <a href="/item-categories" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-layout-navbar"></i>
                                    <div data-i18n="Item Categories">Item Categories</div>
                                    </a>
                                </li>
                                @endcan


                                @can('manage-inventory-categories')
                                <li class="menu-item {{ request()->is('inventory-categories') ? 'active' : '' }}">
                                    <a href="/inventory-categories" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-layout-navbar"></i>
                                    <div data-i18n="Inventory Categories">Inventory Categories</div>
                                    </a>
                                </li>
                                @endcan


                                @can('manage-referrer-types')
                                <li class="menu-item {{ request()->is('referrer-types') ? 'active' : '' }}">
                                    <a href="/referrer-types" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-list"></i>
                                    <div data-i18n="Referrer Types">Referrer Types</div>
                                    </a>
                                </li>
                                @endcan


                                @can('manage-customer-types')
                                <li class="menu-item {{ request()->is('customer-types') ? 'active' : '' }}">
                                    <a href="/customer-types" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-list"></i>
                                    <div data-i18n="Customer Types">Customer Types</div>
                                    </a>
                                </li>
                                @endcan


                                @can('manage-supplier-types')
                                <li class="menu-item {{ request()->is('supplier-types') ? 'active' : '' }}">
                                    <a href="/supplier-types" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-list"></i>
                                    <div data-i18n="Supplier Types">Supplier Types</div>
                                    </a>
                                </li>
                                @endcan


                                @can('manage-payment-methods')
                                <li class="menu-item {{ request()->is('payment-methods') ? 'active' : '' }}">
                                    <a href="/payment-methods" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-table"></i>
                                    <div data-i18n="Payment Methods">Payment Methods</div>
                                    </a>
                                </li>
                                @endcan


                                @can('manage-metrics')
                                <li class="menu-item {{ request()->is('metrics') ? 'active' : '' }}">
                                    <a href="/metrics" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-list"></i>
                                    <div data-i18n="Metrics">Metrics</div>
                                    </a>
                                </li>
                                @endcan


                                @can('manage-currencies')
                                <li class="menu-item {{ request()->is('currencies') ? 'active' : '' }}">
                                    <a href="/currencies" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-cash"></i>
                                    <div data-i18n="Currencies">Currencies</div>
                                    </a>
                                </li>
                                @endcan


                                @can('manage-statuses')
                                <li class="menu-item {{ request()->is('statuses') ? 'active' : '' }}">
                                    <a href="/statuses" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-file"></i>
                                    <div data-i18n="Statuses">Statuses</div>
                                    </a>
                                </li>
                                @endcan
                                

                                @can('manage-categories')
                                <li class="menu-item {{ request()->is('categories') ? 'active' : '' }}">
                                    <a href="/categories" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-layout-navbar"></i>
                                    <div data-i18n="Categories">Categories</div>
                                    </a>
                                </li>
                                @endcan


                                @can('manage-groups')
                                <li class="menu-item {{ request()->is('groups') ? 'active' : '' }}">
                                    <a href="/groups" class="menu-link">
                                    <i class="menu-icon icon-base ti tabler-list"></i>
                                    <div data-i18n="Groups">Groups</div>
                                    </a>
                                </li>
                                @endcan




                                <!-- <li class="menu-item">
                                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                                        <i class="menu-icon icon-base ti tabler-currency"></i>
                                        <div data-i18n="Currency">Currency</div>
                                    </a>

                                    <ul class="menu-sub">
                                        <li class="menu-item">
                                            <a href="#" class="menu-link">
                                                <div data-i18n="New Currency">New Currency</div>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="#" class="menu-link">
                                                <div data-i18n="View Currencies">View Currencies</div>
                                            </a>
                                        </li>
                                    </ul>

                                </li> -->

                            </ul>                           

                        </li>
                        @endcan
                        <!-- System Settings menu end -->


                        

                        <!-- Report Management menu start -->
                        @can('manage-reports')
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon icon-base ti tabler-file-description"></i>
                                <div data-i18n="Report Management">Report Management</div>
                            </a>
                            <ul class="menu-sub">

                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                    <div data-i18n="Purchase Reports">Purchase Reports</div>
                                    </a>
                                </li>

                                 <li class="menu-item">
                                    <a href="#" class="menu-link">
                                    <div data-i18n="Expense Reports">Expense Reports</div>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                    <div data-i18n="Order Reports">Order Reports</div>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="#" class="menu-link">
                                    <div data-i18n="Sales Reports">Sales Reports</div>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endcan
                        <!-- Report Management menu end -->



                    </ul>

                </aside>

                <div class="menu-mobile-toggler d-xl-none rounded-1">
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
                        <i class="ti tabler-menu icon-base"></i>
                        <i class="ti tabler-chevron-right icon-base"></i>
                    </a>
                </div>
                <!-- / Menu -->        


                <!-- Layout container -->
                <div class="layout-page">         
                    

                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">


                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
                        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                        <i class="icon-base ti tabler-menu-2 icon-md"></i>
                        </a>
                    </div>


                    <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
                    
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item navbar-search-wrapper px-md-0 px-2 mb-0">
                                <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
                                <span class="d-inline-block text-body-secondary fw-normal" id="autocomplete"></span>
                                </a>
                            </div>
                        </div>
                        <!-- /Search -->
                                  

                        <ul class="navbar-nav flex-row align-items-center ms-md-auto">                

        
                            <!-- <li class="nav-item dropdown-language dropdown me-2 me-xl-0">

                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <i class="icon-base ti tabler-language icon-22px text-heading"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                    <a class="dropdown-item" href="javascript:void(0);" data-language="en" data-text-direction="ltr">
                                        <span>English</span>
                                    </a>
                                    </li>
                                    <li>
                                    <a class="dropdown-item" href="javascript:void(0);" data-language="fr" data-text-direction="ltr">
                                        <span>French</span>
                                    </a>
                                    </li>
                                    <li>
                                    <a class="dropdown-item" href="javascript:void(0);" data-language="ar" data-text-direction="rtl">
                                        <span>Arabic</span>
                                    </a>
                                    </li>
                                    <li>
                                    <a class="dropdown-item" href="javascript:void(0);" data-language="de" data-text-direction="ltr">
                                        <span>German</span>
                                    </a>
                                    </li>
                                </ul>
                            </li> -->
                            <!--/ Language -->
        

        
                            <!-- Style Switcher -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill" id="nav-theme" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <i class="icon-base ti tabler-sun icon-22px theme-icon-active text-heading"></i>
                                    <span class="d-none ms-2" id="nav-theme-text">Toggle theme</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="nav-theme-text">
                                    <li>
                                    <button type="button" class="dropdown-item align-items-center active" data-bs-theme-value="light" aria-pressed="false">
                                        <span><i class="icon-base ti tabler-sun icon-22px me-3" data-icon="sun"></i>Light</span>
                                    </button>
                                    </li>
                                    <li>
                                    <button type="button" class="dropdown-item align-items-center" data-bs-theme-value="dark" aria-pressed="true">
                                        <span><i class="icon-base ti tabler-moon-stars icon-22px me-3" data-icon="moon-stars"></i>Dark</span>
                                    </button>
                                    </li>
                                    <li>
                                    <button type="button" class="dropdown-item align-items-center" data-bs-theme-value="system" aria-pressed="false">
                                        <span><i class="icon-base ti tabler-device-desktop-analytics icon-22px me-3" data-icon="device-desktop-analytics"></i>System</span>
                                    </button>
                                    </li>
                                </ul>
                            </li>
                            <!-- / Style Switcher-->
        

                            <!-- Quick links  -->
                            <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                <i class="icon-base ti tabler-layout-grid-add icon-22px text-heading"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end p-0">
                                <div class="dropdown-menu-header border-bottom">
                                    <div class="dropdown-header d-flex align-items-center py-3">
                                    <h6 class="mb-0 me-auto">Shortcuts</h6>
                                    <a href="javascript:void(0)" class="dropdown-shortcuts-add py-2 btn btn-text-secondary rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Add shortcuts"><i class="icon-base ti tabler-plus icon-20px text-heading"></i></a>
                                    </div>
                                </div>
                                <div class="dropdown-shortcuts-list scrollable-container">
                                    <div class="row row-bordered overflow-visible g-0">
                                    <div class="dropdown-shortcuts-item col">
                                        <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                        <i class="icon-base ti tabler-calendar icon-26px text-heading"></i>
                                        </span>
                                        <a href="app-calendar.html" class="stretched-link">Calendar</a>
                                        <small>Appointments</small>
                                    </div>
                                    <div class="dropdown-shortcuts-item col">
                                        <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                        <i class="icon-base ti tabler-file-dollar icon-26px text-heading"></i>
                                        </span>
                                        <a href="app-invoice-list.html" class="stretched-link">Invoice App</a>
                                        <small>Manage Accounts</small>
                                    </div>
                                    </div>
                                    <div class="row row-bordered overflow-visible g-0">
                                    <div class="dropdown-shortcuts-item col">
                                        <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                        <i class="icon-base ti tabler-user icon-26px text-heading"></i>
                                        </span>
                                        <a href="app-user-list.html" class="stretched-link">User App</a>
                                        <small>Manage Users</small>
                                    </div>
                                    <div class="dropdown-shortcuts-item col">
                                        <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                        <i class="icon-base ti tabler-users icon-26px text-heading"></i>
                                        </span>
                                        <a href="app-access-roles.html" class="stretched-link">Role Management</a>
                                        <small>Permission</small>
                                    </div>
                                    </div>
                                    <div class="row row-bordered overflow-visible g-0">
                                    <div class="dropdown-shortcuts-item col">
                                        <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                        <i class="icon-base ti tabler-device-desktop-analytics icon-26px text-heading"></i>
                                        </span>
                                        <a href="index.html" class="stretched-link">Dashboard</a>
                                        <small>User Dashboard</small>
                                    </div>
                                    <div class="dropdown-shortcuts-item col">
                                        <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                        <i class="icon-base ti tabler-settings icon-26px text-heading"></i>
                                        </span>
                                        <a href="pages-account-settings-account.html" class="stretched-link">Setting</a>
                                        <small>Account Settings</small>
                                    </div>
                                    </div>
                                    <div class="row row-bordered overflow-visible g-0">
                                    <div class="dropdown-shortcuts-item col">
                                        <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                        <i class="icon-base ti tabler-help-circle icon-26px text-heading"></i>
                                        </span>
                                        <a href="pages-faq.html" class="stretched-link">FAQs</a>
                                        <small>FAQs & Articles</small>
                                    </div>
                                    <div class="dropdown-shortcuts-item col">
                                        <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                        <i class="icon-base ti tabler-square icon-26px text-heading"></i>
                                        </span>
                                        <a href="modal-examples.html" class="stretched-link">Modals</a>
                                        <small>Useful Popups</small>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </li>
                            <!-- Quick links -->

                            <!-- Notification -->
                            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
                                <a class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                <span class="position-relative">
                                    <i class="icon-base ti tabler-bell icon-22px text-heading"></i>
                                    <span class="badge rounded-pill bg-danger badge-dot badge-notifications border"></span>
                                </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end p-0">
                                
                                <li class="dropdown-menu-header border-bottom">
                                    <div class="dropdown-header d-flex align-items-center py-3">
                                    <h6 class="mb-0 me-auto">Notification</h6>
                                    <div class="d-flex align-items-center h6 mb-0">
                                        <span class="badge bg-label-primary me-2">8 New</span>
                                        <a href="javascript:void(0)" class="dropdown-notifications-all p-2 btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i class="icon-base ti tabler-mail-opened text-heading"></i></a>
                                    </div>
                                    </div>
                                </li>
                                <li class="dropdown-notifications-list scrollable-container">
                                    <ul class="list-group list-group-flush">
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                        <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar">
                                            <img src="{{ asset('/assets/img/avatars/1.png') }}" alt class="rounded-circle" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="small mb-1">Congratulation Lettie 🎉</h6>
                                            <small class="mb-1 d-block text-body">Won the monthly best seller gold badge</small>
                                            <small class="text-body-secondary">1h ago</small>
                                        </div>
                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="icon-base ti tabler-x"></span></a>
                                        </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                        <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar">
                                            <span class="avatar-initial rounded-circle bg-label-danger">CF</span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 small">Charles Franklin</h6>
                                            <small class="mb-1 d-block text-body">Accepted your connection</small>
                                            <small class="text-body-secondary">12hr ago</small>
                                        </div>
                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="icon-base ti tabler-x"></span></a>
                                        </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                        <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar">
                                            <img src="{{ asset('/assets/img/avatars/2.png') }}" alt class="rounded-circle" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 small">New Message ✉️</h6>
                                            <small class="mb-1 d-block text-body">You have new message from Natalie</small>
                                            <small class="text-body-secondary">1h ago</small>
                                        </div>
                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="icon-base ti tabler-x"></span></a>
                                        </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                        <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar">
                                            <span class="avatar-initial rounded-circle bg-label-success"><i class="icon-base ti tabler-shopping-cart"></i></span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 small">Whoo! You have new order 🛒</h6>
                                            <small class="mb-1 d-block text-body">ACME Inc. made new order $1,154</small>
                                            <small class="text-body-secondary">1 day ago</small>
                                        </div>
                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="icon-base ti tabler-x"></span></a>
                                        </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                        <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar">
                                            <img src="{{ asset('/assets/img/avatars/9.png') }}" alt class="rounded-circle" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 small">Application has been approved 🚀</h6>
                                            <small class="mb-1 d-block text-body">Your ABC project application has been approved.</small>
                                            <small class="text-body-secondary">2 days ago</small>
                                        </div>
                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="icon-base ti tabler-x"></span></a>
                                        </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                        <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar">
                                            <span class="avatar-initial rounded-circle bg-label-success"><i class="icon-base ti tabler-chart-pie"></i></span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 small">Monthly report is generated</h6>
                                            <small class="mb-1 d-block text-body">July monthly financial report is generated </small>
                                            <small class="text-body-secondary">3 days ago</small>
                                        </div>
                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="icon-base ti tabler-x"></span></a>
                                        </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                        <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar">
                                            <img src="{{ asset('/assets/img/avatars/5.png') }}" alt class="rounded-circle" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 small">Send connection request</h6>
                                            <small class="mb-1 d-block text-body">Peter sent you connection request</small>
                                            <small class="text-body-secondary">4 days ago</small>
                                        </div>
                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="icon-base ti tabler-x"></span></a>
                                        </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                        <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar">
                                            <img src="{{ asset('/assets/img/avatars/6.png') }}" alt class="rounded-circle" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 small">New message from Jane</h6>
                                            <small class="mb-1 d-block text-body">Your have new message from Jane</small>
                                            <small class="text-body-secondary">5 days ago</small>
                                        </div>
                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="icon-base ti tabler-x"></span></a>
                                        </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                        <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar">
                                            <span class="avatar-initial rounded-circle bg-label-warning"><i class="icon-base ti tabler-alert-triangle"></i></span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 small">CPU is running high</h6>
                                            <small class="mb-1 d-block text-body">CPU Utilization Percent is currently at 88.63%,</small>
                                            <small class="text-body-secondary">5 days ago</small>
                                        </div>
                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="icon-base ti tabler-x"></span></a>
                                        </div>
                                        </div>
                                    </li>
                                    </ul>
                                </li>
                                <li class="border-top">
                                    <div class="d-grid p-4">
                                    <a class="btn btn-primary btn-sm d-flex" href="javascript:void(0);">
                                        <small class="align-middle">View all notifications</small>
                                    </a>
                                    </div>
                                </li>
                                </ul>
                            </li>
                            <!--/ Notification -->

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="{{ asset('/assets/img/avatars/placeholder.png') }}" alt class="rounded-circle" />
                                </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item mt-0" href="pages-account-settings-account.html">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-2">
                                        <div class="avatar avatar-online">
                                            <img src="{{ asset('/assets/img/avatars/placeholder.png') }}" alt class="rounded-circle" />
                                        </div>
                                        </div>
                                        <div class="flex-grow-1">
                                        <h6 class="mb-0">{{ ucwords(Auth::user()->name) }}</h6>
                                        <small class="text-body-secondary">{{ ucwords(Auth::user()->email) }}</small>
                                        </div>
                                    </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider my-1 mx-n2"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/specific-employee/{{Auth::user()->user_reference}}"> <i class="icon-base ti tabler-user me-3 icon-md"></i><span class="align-middle">My Profile</span> </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/specific-employee/{{Auth::user()->user_reference}}"> <i class="icon-base ti tabler-settings me-3 icon-md"></i><span class="align-middle">Settings</span> </a>
                                </li>
                                <!-- <li>
                                    <a class="dropdown-item" href="pages-account-settings-billing.html">
                                    <span class="d-flex align-items-center align-middle">
                                        <i class="flex-shrink-0 icon-base ti tabler-file-dollar me-3 icon-md"></i><span class="flex-grow-1 align-middle">Billing</span>
                                        <span class="flex-shrink-0 badge bg-danger d-flex align-items-center justify-content-center">4</span>
                                    </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider my-1 mx-n2"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="pages-pricing.html"> <i class="icon-base ti tabler-currency-dollar me-3 icon-md"></i><span class="align-middle">Pricing</span> </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="pages-faq.html"> <i class="icon-base ti tabler-question-mark me-3 icon-md"></i><span class="align-middle">FAQ</span> </a>
                                </li> -->
                                <li>
                                    <div class="d-grid px-2 pt-2 pb-1">

                                        <!-- <a class="btn btn-sm btn-danger d-flex" href="{{ route('logout') }}" target="" 
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >
                                            <small class="align-middle">Logout</small>
                                            <i class="icon-base ti tabler-logout ms-2 icon-14px"></i>
                                        </a>
                                        
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form> -->

                                        <a class="btn btn-sm btn-danger d-flex" href="#" data-bs-toggle="modal"  data-bs-target="#logout">
                                            <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> 
                                            <span class="align-middle" data-key="t-logout">Logout</span>
                                        </a>

                                    </div>
                                </li>

                                </ul>
                            </li>
                            <!--/ User -->
        
                        </ul>
                    </div>
                </nav>
                <!-- / Navbar -->
            

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">

                    <!-- ============================================================== -->
                    <!-- Start Page Content here -->
                    <!-- ============================================================== -->

                        @yield('content')

                    <!-- ============================================================== -->
                    <!-- End Page Content here -->
                    <!-- ============================================================== -->
                
                </div>   
            </div>
            <!-- / Content -->   
             
            
        <!-- Logout Modal -->
        <div id="logout" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body text-center p-5">
                        <div class="text-end">
                            <button type="button" class="btn-close text-end" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="mt-2">

                            <h4 class="mb-3 mt-3">Are you sure you want to logout?</h4>
                            
                            <div class="hstack gap-2 justify-content-center mb-5">
                                <form method = "POST" action="{{ route('logout') }}" id="logout-form">
                                    @csrf
                                    <button type="submit" id="btn-logout" class="btn btn-danger">YES</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">NO</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
            
    
    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl">
        <div class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
        <div class="text-body">
            Copyright &#169;
            <script>
            document.write(new Date().getFullYear());
            </script>
            , made with ❤️ by <a href="https://staging.reclaimingspace.org/" target="new" class="footer-link">Andiagroup</a>
        </div>
        <div class="d-none d-lg-inline-block">
            
            Sponsored by <a href="https://spenserholdings.org/" target="new" class="footer-link d-none d-sm-inline-block">Spenser Holdings</a>
            
        </div>
        </div>
    </div>
    </footer>
    <!-- / Footer -->

            
            <div class="content-backdrop fade"></div>
            
            </div>
            <!-- Content wrapper -->
            
        </div>
        <!-- / Layout page -->
        
        </div>  
        
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
            
        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
        
    </div>
    <!-- / Layout wrapper -->


        <!-- Core JS -->
        <!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> -->

        <!-- build:js assets/vendor/js/theme.js  -->
        <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>    
        <script src="{{ asset('/assets/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
        
        <script src="{{ asset('/assets/vendor/libs/node-waves/node-waves.js') }}"></script>
        <!-- <script src="{{ asset('/assets/vendor/libs/@algolia/autocomplete-js.js') }}"></script> -->
        <script src="{{ asset('/assets/vendor/libs/pickr/pickr.js') }}"></script>
        <script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('/assets/vendor/libs/hammer/hammer.js') }}"></script>
        <script src="{{ asset('/assets/vendor/libs/i18n/i18n.js') }}"></script> 
        <script src="{{ asset('/assets/vendor/js/menu.js') }}"></script>
        
        <!-- endbuild -->

        <!-- Vendors JS -->
        <!-- <script src="{{ asset('/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script> -->
        <script src="{{ asset('/assets/vendor/libs/swiper/swiper.js') }}"></script>
      
        <!-- Main JS -->    
        <script src="{{ asset('/assets/js/main.js') }}"></script>    

        <!-- Page JS -->
        <!-- <script src="{{ asset('/assets/js/dashboards-analytics.js') }}"></script>
         -->

        <script>
            $(document).ready(function() {


                const timeout = 1800000;  // 900,000 ms = 15 minutes
                var idleTimer = null;
                $('*').bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {
                    clearTimeout(idleTimer);

                    idleTimer = setTimeout(function () {
                        document.getElementById('logout-form').submit();
                        //window.location = "/logout";

                    }, timeout);
                });
                $("body").trigger("mousemove");

            // const loaderColor = localStorage.getItem('vuexy-vue-demo-1-initial-loader-bg') || '#FFFFFF'
            // const primaryColor = localStorage.getItem('vuexy-vue-demo-1-initial-loader-color') || '#2092EC'

            // if (loaderColor)
            // document.documentElement.style.setProperty('--initial-loader-bg', loaderColor)
            // if (loaderColor)
            // document.documentElement.style.setProperty('--initial-loader-bg', loaderColor)

            // if (primaryColor)
            // document.documentElement.style.setProperty('--initial-loader-color', primaryColor)

            });

        </script>

        @stack('scripts')
        
    </body>
</html>


