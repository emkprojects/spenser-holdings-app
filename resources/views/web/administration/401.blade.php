<!DOCTYPE html>
<html lang="en" class="layout-wide customizer-hide" dir="ltr" data-skin="default" data-bs-theme="light" data-assets-path="/assets/" data-template="vertical-menu-template">

    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <meta name="robots" content="noindex, nofollow" />
        <title>SIMS - Unauthorized</title>    
        
        <!-- Canonical SEO -->
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta property="og:title" content="" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        <meta property="og:description" content="" />
        <meta property="og:site_name" content="" />
        <link rel="canonical" href="" />           
        
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon/favicon.ico') }}" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/iconify-icons.css') }}" rel="stylesheet" type="text/css" />

        <!-- Core CSS -->  
        <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/node-waves/node-waves.css') }}" rel="stylesheet" type="text/css" /> 
        <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/pickr/pickr-themes.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('/assets/vendor/css/core.css') }}" rel="stylesheet" type="text/css" />
        <!-- <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}') }}" rel="stylesheet" type="text/css" /> -->
        
        <!-- Vendors CSS -->    
        <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
        
        <!-- Page CSS -->
        <!-- Page -->        
        <link rel="stylesheet" href="{{ asset('/assets/vendor/css/pages/page-misc.css') }}" />


        <!-- Helpers -->
        <script src="{{ asset('/assets/vendor/js/helpers.js') }}"></script>
        <script src="{{ asset('/assets/vendor/js/template-customizer.js') }}"></script>
        <script src="{{ asset('/assets/js/config.js') }}"></script>

        <style>
            .swal2-container {
                z-index: 20000 !important;
            }
        </style>

        @stack('stylesheets')
    
    </head>

    <body>    
    
    <!-- Content start -->
    <div class="">
      
      <!-- Not Authorized -->
      <div class="container-xxl container-p-y">
        <div class="misc-wrapper">
          <h1 class="mb-2 mx-2" style="line-height: 6rem;font-size: 6rem;">401</h1>
          <h4 class="mb-2 mx-2">Sorry! You are not authorized! 🔐</h4>
          <p class="mb-6 mx-2">You don’t have permission to access this page.</p>
          <a href="/login" class="btn btn-primary">Go home!</a>
          <div class="mt-12">
            <img src="{{ asset('/assets/img/illustrations/page-misc-you-are-not-authorized.png') }}" alt="page-misc-not-authorized" width="170" class="img-fluid" />
          </div>
        </div>
      </div>
      <div class="container-fluid misc-bg-wrapper">
        <img src="{{ asset('/assets/img/illustrations/bg-shape-image-light.png') }}" height="355" alt="page-misc-not-authorized" data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png" />
      </div>
      <!-- /Not Authorized -->
    
    </div>
    <!-- Content end -->

    <!-- Core JS -->
    <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>
    
    <script src="{{ asset('/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    
    <script src="{{ asset('/assets/vendor/libs/@algolia/autocomplete-js.js') }}"></script>
        
    <script src="{{ asset('/assets/vendor/libs/pickr/pickr.js') }}"></script>
        
    <script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
      
        
    <script src="{{ asset('/assets/vendor/libs/hammer/hammer.js') }}"></script>
        
    <script src="{{ asset('/assets/vendor/libs/i18n/i18n.js') }}"></script>
              
    <script src="{{ asset('/assets/vendor/js/menu.js') }}"></script>
    
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('/assets/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/@form-validation/auto-focus.js') }}"></script>

    <!-- Main JS -->
    
    <script src="{{ asset('/assets/js/main.js') }}"></script>
    

    @stack('scripts')

  </body>
</html>