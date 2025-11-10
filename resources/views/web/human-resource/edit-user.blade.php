@extends('layouts.admin', ['title' => 'Edit Employee'])

@push('stylesheets')

    <!-- CSRF-TOEKN -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/assets/vendor/libs/bootstrap-select/bootstrap-select.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/tagify/tagify.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/@form-validation/form-validation.css" />

    <!-- select2 styles -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->


@endpush

@section('content')

    <!-- start container-fluid -->
    <!-- <div class="container-fluid"> -->

        <!-- start page title -->
        <div class="row">
            
            <!-- start page card -->
            <div class="col-12">
            <div class="card">

                <div class="card-header">

                    <div class="row">
                        <div class="col-xl-12">
                        <h4 class="pb-0 mt-1 fs-5 text-md-start text-center fw-bold"> UPDATE EMPLOYEE RECORD</h4>
                        </div>
                    </div>
                
                </div>

                <div class="card-body">

                    <form method="POST" id="add-form" nam="add-form" class="row g-6">
                        <!-- @csrf -->

                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="national_identification_number">NIN</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-nin">
                                    <i class="icon-base ti tabler-user"></i>
                                </span>                                    
                                <input type="text" value="{{ $user->national_identification_number}}" id="national_identification_number" name="national_identification_number" class="form-control" placeholder="Enter NIN (Optional)" style="text-transform:uppercase;" aria-describedby="basic-addon-nin" />                        
                            </div> 
                        </div> 

                        
                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="first_name">First Name</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-fname">
                                    <i class="icon-base ti tabler-user"></i>
                                </span>                                    
                                <input type="text" value="{{ $user->first_name}}" id="first_name" name="first_name" class="form-control" placeholder="Enter First name" style="text-transform:capitalize;" aria-describedby="basic-addon-fname" />                        
                            </div> 
                        </div> 


                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="last_name">Last Name</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-lname">
                                    <i class="icon-base ti tabler-user"></i>
                                </span>                                    
                                <input type="text" value="{{ $user->last_name}}" id="last_name" name="last_name" class="form-control" placeholder="Enter Last name" style="text-transform:capitalize;" aria-describedby="basic-addon-lname" />                        
                            </div> 
                        </div> 


                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="other_name">Other Name</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-oname">
                                    <i class="icon-base ti tabler-user"></i>
                                </span>                                    
                                <input type="text" value="{{ $user->other_name}}" id="other_name" name="other_name" class="form-control" placeholder="Enter Other name (Optional)" style="text-transform:capitalize;" aria-describedby="basic-addon-oname" maxlength="11" />                        
                            </div> 
                        </div> 


                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="phone">Mobile Number</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-phone">
                                    <i class="icon-base ti tabler-phone"></i>
                                </span>                                    
                                <input type="text" value="{{ $user->phone}}" id="phone" name="phone" class="form-control phone" placeholder="Enter Mobile Number" style="text-transform:;" aria-describedby="basic-addon-phone" maxlength="11" />                        
                            </div> 
                        </div> 

                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="alternative_phone">Alternative Mobile Number</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-aphone">
                                    <i class="icon-base ti tabler-phone"></i>
                                </span>                                    
                                <input type="text" value="{{ $user->alternative_phone}}" id="alternative_phone" name="alternative_phone" class="form-control phone" placeholder="Enter Alternative Mobile Number (Optional)" style="text-transform:;" aria-describedby="basic-addon-aphone" maxlength="11" />                        
                            </div> 
                        </div>                        
                        
                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="email">Email Address</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-email">
                                    <i class="icon-base ti tabler-mail"></i>
                                </span>                                    
                                <input type="email" value="{{ $user->email}}" id="email" name="email" class="form-control" placeholder="Enter Email Address" style="text-transform:;" aria-describedby="basic-addon-email" />                        
                            </div> 
                        </div>


                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="alternative_email">Alternative Email Address</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-aemail">
                                    <i class="icon-base ti tabler-mail"></i>
                                </span>                                    
                                <input type="email" value="{{ $user->alternative_email}}" id="alternative_email" name="alternative_email" class="form-control" placeholder="Enter Alternavtive Email Address (Optional)" style="text-transform:;" aria-describedby="basic-addon-aemail" />                        
                            </div> 
                        </div>


                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="date_of_birth">Date of Birth</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-dob">
                                    <i class="icon-base ti tabler-calendar"></i>
                                </span>                                    
                                <input type="date" value="{{ $user->date_of_birth}}" id="date_of_birth" name="date_of_birth" class="form-control" placeholder="Enter Date of Birth (Optional)" style="text-transform:;" aria-describedby="basic-addon-dob" />                        
                            </div> 
                        </div>


                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="role_id">Employee Role</label>
                            <div class="input-group input-group-merge">                    
                                
                                <select id="role_id" name="role_id" class="select2 form-select fs-6" style="text-transform:capitalize;">
                                    <!-- <option value="">Select Employee Role</option> -->
                                    @foreach($roles as $role)
                                        
                                        @if($role->id == $user->role_id)
                                            <option value="{{$user->role_id}}">{{ucwords($role->name)}}</option>
                                        @else
                                            <option value="{{$role->id}}">{{ucwords($role->name)}}</option>
                                        @endif

                                    @endforeach
                                                            
                                </select>

                            </div> 
                        </div>



                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="position_id">Employee Position</label>
                            <div class="input-group input-group-merge">                    
                                <!-- <span class="input-group-text" id="basic-addon-dob">
                                    <i class="icon-base ti tabler-list"></i>
                                </span>  -->
                                <select id="position_id" name="position_id" class="select2 form-select fs-6" style="text-transform:capitalize;">
                                    <!-- <option value="">Select Employee Position</option> -->
                                    @foreach($positions as $position)
                                        @if($position->id == $user->position_id)
                                            <option value="{{$user->position_id}}">{{ucwords($position->position)}}</option>
                                        @else
                                            <option value="{{$position->id}}">{{ucwords($position->position)}}</option>
                                        @endif
                                    @endforeach
                                                            
                                </select>

                            </div> 
                        </div>


                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="user_status_id">Employee Status</label>
                            <div class="input-group input-group-merge">                    
                                
                                <select id="user_status_id" name="user_status_id" class="select2 form-select fs-6" style="text-transform:capitalize;">
                                    <!-- <option value="">Select Employee Status</option> -->
                                    @foreach($user_statuses as $user_status)
                                        
                                        @if($user_status->id == $user->user_status_id)
                                            <option value="{{$user->user_status_id}}">{{$user_status->user_status}}</option>
                                        @else
                                            <option value="{{$user_status->id}}">{{$user_status->user_status}}</option>
                                        @endif
                                    @endforeach
                                                            
                                </select>

                            </div> 
                        </div>


                        <div class="col-md-6 form-control-validation">
                            <label class="form-label fs-5" for="physical_address">Physical Address</label>                             
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-paddress">
                                    <i class="icon-base ti tabler-map-pin"></i>
                                </span>
                                <textarea id="physical_address" name="physical_address" class="form-control autosize fs-5" placeholder="Enter Physical Address... (Optional)" rows="3" style="text-transform:capitalize;" aria-describedby="basic-addon-paddress" >{{ $user->physical_address}}</textarea>
                            </div>
                        </div>


                        <div class="col-md-2 form-control-validation">
                            <label class="form-label fs-5" for="gender">Gender</label> 
                            
                            <div class="switches-stacked">
                                <label class="switch switch-square">
                                    @if($user->gender == "Male")
                                        <input type="radio" value="Male" class="switch-input" id="gender" name="gender" checked />
                                    @else
                                        <input type="radio" value="Male" class="switch-input" id="gender" name="gender" />
                                    @endif
                                    <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                    </span>
                                    <span class="switch-label"><i class="icon-base ti tabler-gender-male"></i> Male</span>
                                </label>

                                <label class="switch switch-square">
                                    @if($user->gender == "Female")
                                        <input type="radio" value="Female" class="switch-input" id="gender" name="gender" checked />
                                    @else
                                        <input type="radio" value="Female" class="switch-input" id="gender" name="gender" />
                                    @endif                                    
                                    <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                    </span>
                                    <span class="switch-label"><i class="icon-base ti tabler-gender-female"></i> Female</span>
                                </label>

                                <label class="switch switch-square">
                                    @if($user->gender == "Other")
                                        <input type="radio" value="Other" class="switch-input" id="gender" name="gender" checked />
                                    @else
                                        <input type="radio" value="Other" class="switch-input" id="gender" name="gender" />
                                    
                                    @endif    
                                    <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                    </span>
                                    <span class="switch-label"><i class="icon-base ti tabler-gender-third"></i> Other</span>
                                </label>

                               
                            </div>
                            
                        </div>
                        

                        <div class="col-12 form-control-validation">
                            <div class="form-check">
                                <input type="checkbox" id="terms" name="terms" class="form-check-input" checked />
                                <label class="form-check-label fs-5" for="terms">Employee has agreed to our terms and conditions</label>
                            </div>
                        </div>

                        <div class="col-12 form-control-validation">
                            <button type="submit" id="add-btn" name="add-btn" class="btn btn-info button-prevent-multiple-submits p-3 float-end">Add Employee</button>
                        </div>

                    </form>

                </div>
            </div>
            </div>
            <!-- end page card -->

        </div>
        <!-- end page title -->

    <!-- </div> -->
    <!-- end container-fluid -->

@endsection

@push('scripts')

    <!-- Vendors JS -->
    <script src="/assets/vendor/libs/select2/select2.js"></script>
    <script src="/assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
    <script src="/assets/vendor/libs/moment/moment.js"></script>
    <script src="/assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="/assets/vendor/libs/tagify/tagify.js"></script>
    <script src="/assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="/assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="/assets/vendor/libs/@form-validation/auto-focus.js"></script>

    <!-- validation scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
    <!-- sweetalert2 scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- select2 scripts -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

    <!-- start script -->
    <script>
        $(document).ready(function() {


            ///////////////////////////AJAX CSRF SET UP ///////////////////////////////////////
             $.ajaxSetup({
                headers: {
                //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-CSRF-TOKEN': "{{csrf_token()}}",
                }
            });


            //////////////////// OTHER VALIDATIONS //////////////////////////////////////////////

            // var gender = "Male";

            // $("#gender").change(function() {

            //     if ($('#gender').prop('checked')) {
            //         gender = "Male";           
            //     }
            //     else{
            //         gender = "Female";
            //     }

            // });


            /////////////////DATE TIME PICKER INITIALISATION /////////////////////////////////////
        

            ///////////////////////SELECT 2 INITIALISATION ///////////////////////////////////////
             
            $('#role_id').select2({

                "placeholder": "Select Employee Role",

            });


            $('#position_id').select2({

                "placeholder": "Select Employee Position",

            });


            $('#user_status_id').select2({

                "placeholder": "Select Employee Status",

            });

          
            $('#is_active').select2({

                "placeholder": "Choose Status",

            });



            ///////////////////NUMBER INPUT INITIALISATION ///////////////////////////////////////

            $('input.money').keyup(function(event) {

                if(event.which >= 37 && event.which <= 40) return;

                $(this).val(function(index, value) {
                    return value
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                });

            });

            
            $('input.phone').keyup(function(event) {

                if(event.which >= 37 && event.which <= 40) return;

                $(this).val(function(index, value) {
                    return value
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, " ");
                });

            });



            ///////////////// FORM VALIDATIONS ////////////////////////////////////////////////////////

            $("#add-form").validate({

                //ignore: null,   

                // rules: {
                //     program:{ required:true },
                // },
                // messages: {
                //     program:"Program is required",
                // },

                errorElement: 'span',

                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },

                // Called when the element is invalid:
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
        
                // Called when the element is valid:
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },

                submitHandler: function(form) {

                    // Disable button on clicking submit
                    $('.button-prevent-multiple-submits').attr('disabled', true); 
                        
                    // Format the form data
                    var formData = new FormData(form);
                
                    // Initiate Ajax request
                    $.ajax({

                        url: '/add-employee',
                        type: 'post',
                        data: formData,
                        processData: false,
                        contentType: false,

                        beforeSend:function(){

                            $('#add-btn').text('Processing...');

                        },

                        success: function(response) {

                            console.log(response);

                            Swal.fire({
                                title: '<span class="text text-success fw-bold">SUCCESS MESSAGE</span>',
                                //text: 'Employee created successfully',
                                text: response.message,
                                icon: 'success',
                                toast:'true',
                                showConfirmButton:false,
                                position:'top-end',
                                //background: "#FCFCFC",
                                timer:5000
                                
                            }).then(function() {

                                window.location = "/employees";

                            });
                        
                            $('.button-prevent-multiple-submits').attr('disabled', false);
                            $('#add-btn').text('Add Employee');
                        },

                        error: function(response){
                                                
                            console.log(response);
                            
                            if(response.status == 422){
                                
                                var firstKey = Object.keys(response.responseJSON.errors)[0];

                                Swal.fire({
                                    title: '<span class="text text-danger fw-bold">ERROR MESSAGE</span>',
                                    text: response.responseJSON.errors[firstKey][0],
                                    icon: 'error',
                                    toast:'true',
                                    showConfirmButton:false,
                                    position:'top-end',
                                    width:'',
                                    //background: "#FCFCFC",
                                    timer:5000                            
                                });
                            } 

                            $('.button-prevent-multiple-submits').attr('disabled', false);
                            $('#add-btn').text('Add Employee');
                        }

                    });
                }

                
            });


        });

    </script>
    <!-- end script -->

@endpush