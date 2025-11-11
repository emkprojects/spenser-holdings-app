<!DOCTYPE html>
<html lang="en" class=" layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-skin="default" data-bs-theme="light" data-assets-path="/assets/" data-template="vertical-menu-template">
  
    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <meta name="robots" content="noindex, nofollow" />
        <title>SIMS - Login Page</title>    
        
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
        
        <!-- Vendor -->
        <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/@form-validation/form-validation.css') }}" />

        <!-- Page CSS -->
        <!-- Page -->
        <link rel="stylesheet" href="{{ asset('/assets/vendor/css/pages/page-auth.css') }}" />

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

        <div class="authentication-wrapper authentication-cover">
            <!-- Logo -->
            <a href="index.html" class="app-brand auth-cover-brand">
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
            <span class="app-brand-text demo text-heading fw-bold fs-3">SIMS</span>
            </a>
            <!-- /Logo -->
            <div class="authentication-inner row m-0">
            <!-- /Left Text -->
            <div class="d-none d-xl-flex col-xl-8 p-0">
                <div class="auth-cover-bg d-flex justify-content-center align-items-center">

                <img src="{{ asset('/assets/img/illustrations/auth-login-illustration-light.png') }}" alt="auth-login-cover" class="my-5 auth-illustration" 
                data-app-light-img="illustrations/auth-login-illustration-light.png" data-app-dark-img="illustrations/auth-login-illustration-dark.png" />

                <img src="{{ asset('/assets/img/illustrations/bg-shape-image-light.png') }}" alt="auth-login-cover" class="platform-bg" 
                data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png" />
                
            </div>
            </div>
            <!-- /Left Text -->

            <!-- Login -->
            <div class="d-flex col-12 col-xl-4 align-items-center authentication-bg p-sm-12 p-6">
                <div class="w-px-400 mx-auto mt-12 pt-5">
                
                <h4 class="mb-1">Welcome! to SIMS 👋</h4>
                <p class="mb-6 fs-5">Sign-in to your account and start the adventure</p>

                <form method="POST" action="{{ route('login') }}" id="formAuthentication" class="mb-4">
                @csrf
                    
                    <div class="mb-6 form-control-validation">
                        <label for="email" class="form-label">Username</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" 
                        placeholder="Enter Username" autofocus />
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-6 form-password-toggle form-control-validation">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                            <span class="input-group-text cursor-pointer">
                                <i class="icon-base ti tabler-eye-off"></i></span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="my-8">
                        <div class="d-flex justify-content-between">

                            <div class="form-check mb-0 ms-2">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                            </div>

                            <!-- <a href="{{ route('password.request') }}"> -->
                            <a href="/login">
                            <p class="mb-0">Forgot Password?</p>
                            </a>

                            <!-- <a href="{{ route('unauthorized') }}">
                            <p class="mb-0">Unauthorized</p>
                            </a> -->

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary d-grid w-100">Login</button>
                </form>

                <!-- <p class="text-center">
                    <span>New employee?</span>
                    <a href="#">
                    <span>Create an account</span>
                    </a>
                </p> -->

                <div class="divider my-6">
                    <div class="divider-text">-</div>
                </div>

                </div>

            </div>
            <!-- /Login -->
            </div>
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
    

    <!-- Page JS -->
    <script src="{{ asset('/assets/js/pages-auth.js') }}"></script>

    @stack('scripts')

  </body>
</html>