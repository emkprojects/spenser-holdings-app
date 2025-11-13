@extends('layouts.admin', ['title' => 'Add Customer'])

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
                        <h4 class="pb-0 mt-1 fs-5 text-md-start text-center fw-bold"> ADD NEW CUSTOMER</h4>
                        </div>
                    </div>
                
                </div>

                <div class="card-body">

                    <form method="POST" id="add-form" nam="add-form" class="row g-6">
                        <!-- @csrf -->

                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="position_id">Customer Type</label>
                            <div class="input-group input-group-merge">                    
                                <!-- <span class="input-group-text" id="basic-addon-dob">
                                    <i class="icon-base ti tabler-list"></i>
                                </span>  -->
                                <select id="customer_type_id" name="customer_type_id" class="select2 form-select fs-6" style="text-transform:capitalize;">
                                    <option value="">Select Customer Type</option>
                                    @foreach($customer_types as $customer_type)
                                        <option value="{{$customer_type->id}}">{{$customer_type->customer_type}}</option>
                                    @endforeach
                                                            
                                </select>

                            </div> 
                        </div>

                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="national_identification_number">NIN</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-nin">
                                    <i class="icon-base ti tabler-user"></i>
                                </span>                                    
                                <input type="text" id="national_identification_number" name="national_identification_number" class="form-control" placeholder="Enter NIN (Optional)" style="text-transform:uppercase;" aria-describedby="basic-addon-nin" />                        
                            </div> 
                        </div> 

                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="tax_identification_number">TIN</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-tin">
                                    <i class="icon-base ti tabler-user"></i>
                                </span>                                    
                                <input type="text" id="tax_identification_number" name="tax_identification_number" class="form-control" placeholder="Enter TIN (Optional)" style="text-transform:uppercase;" aria-describedby="basic-addon-tin" />                        
                            </div> 
                        </div> 
                        
                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="first_name">Customer</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-fname">
                                    <i class="icon-base ti tabler-user"></i>
                                </span>                                    
                                <input type="text" id="customer" name="customer" class="form-control" placeholder="Enter Customer" style="text-transform:capitalize;" aria-describedby="basic-addon-fname" />                        
                            </div> 
                        </div> 


                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="phone">Mobile Number</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-phone">
                                    <i class="icon-base ti tabler-phone"></i>
                                </span>                                    
                                <input type="text" id="phone_number" name="phone_number" class="form-control phone" placeholder="Enter Mobile Number" style="text-transform:;" aria-describedby="basic-addon-phone" maxlength="11" />                        
                            </div> 
                        </div> 

                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="alternative_phone">Alternative Mobile Number</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-aphone">
                                    <i class="icon-base ti tabler-phone"></i>
                                </span>                                    
                                <input type="text" id="alternative_phone" name="alternative_phone" class="form-control phone" placeholder="Enter Alternative Mobile Number (Optional)" style="text-transform:;" aria-describedby="basic-addon-aphone" maxlength="11" />                        
                            </div> 
                        </div>                        
                        
                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="email">Email Address</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-email">
                                    <i class="icon-base ti tabler-mail"></i>
                                </span>                                    
                                <input type="email" id="email_address" name="email_address" class="form-control" placeholder="Enter Email Address" style="text-transform:;" aria-describedby="basic-addon-email" />                        
                            </div> 
                        </div>

                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="alternative_email">Alternative Email Address</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-aemail">
                                    <i class="icon-base ti tabler-mail"></i>
                                </span>                                    
                                <input type="email" id="alternative_email" name="alternative_email" class="form-control" placeholder="Enter Alternavtive Email Address (Optional)" style="text-transform:;" aria-describedby="basic-addon-aemail" />                        
                            </div> 
                        </div>

                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="physical_address">Physical Address</label>                             
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-paddress">
                                    <i class="icon-base ti tabler-map-pin"></i>
                                </span>
                                <textarea id="physical_address" name="physical_address" class="form-control autosize fs-5" placeholder="Enter Physical Address..." rows="" style="text-transform:capitalize;" aria-describedby="basic-addon-paddress" ></textarea>
                            </div>
                        </div>
                    
                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="first_name">Contact First Name</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-fname">
                                    <i class="icon-base ti tabler-user"></i>
                                </span>                                    
                                <input type="text" id="contact_first_name" name="contact_first_name" class="form-control" placeholder="Enter First Name" style="text-transform:capitalize;" aria-describedby="basic-addon-fname" />                        
                            </div> 
                        </div> 


                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="last_name">Contact Last Name</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-lname">
                                    <i class="icon-base ti tabler-user"></i>
                                </span>                                    
                                <input type="text" id="contact_last_name" name="contact_last_name" class="form-control" placeholder="Enter Last Name" style="text-transform:capitalize;" aria-describedby="basic-addon-lname" />                        
                            </div> 
                        </div> 


                        <!-- <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="last_name">Contact Other Names</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-lname">
                                    <i class="icon-base ti tabler-user"></i>
                                </span>                                    
                                <input type="text" id="contact_othert_name" name="contact_othert_name" class="form-control" placeholder="Enter Contact Other Names" style="text-transform:capitalize;" aria-describedby="basic-addon-lname" />                        
                            </div> 
                        </div>  -->


                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="phone">Contact Mobile Number</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-phone">
                                    <i class="icon-base ti tabler-phone"></i>
                                </span>                                    
                                <input type="text" id="contact_phone_number" name="contact_phone_number" class="form-control phone" placeholder="Enter Contact Mobile Number" style="text-transform:;" aria-describedby="basic-addon-phone" maxlength="11" />                        
                            </div> 
                        </div> 


                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="alternative_phone">Contact Alternative Mobile</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-aphone">
                                    <i class="icon-base ti tabler-phone"></i>
                                </span>                                    
                                <input type="text" id="contact_alternative_phone" name="contact_alternative_phone" class="form-control phone" placeholder="Enter Contact Alternative Mobile Number (Optional)" style="text-transform:;" aria-describedby="basic-addon-aphone" maxlength="11" />                        
                            </div> 
                        </div>      


                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="alternative_email">Contact Email Address</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-aemail">
                                    <i class="icon-base ti tabler-mail"></i>
                                </span>                                    
                                <input type="email" id="contact_email_address" name="contact_email_address" class="form-control" placeholder="Enter Contact Email Address" style="text-transform:;" aria-describedby="basic-addon-aemail" />                        
                            </div> 
                        </div>


                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="alternative_email">Contact Alternative Email </label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-aemail">
                                    <i class="icon-base ti tabler-mail"></i>
                                </span>                                    
                                <input type="email" id="contact_alternative_email" name="contact_alternative_email" class="form-control" placeholder="Enter Contact Alternavtive Email (Optional)" style="text-transform:;" aria-describedby="basic-addon-aemail" />                        
                            </div> 
                        </div>  
                        
                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="position_id">Contact Position</label>
                            <div class="input-group input-group-merge">                    
                                <!-- <span class="input-group-text" id="basic-addon-dob">
                                    <i class="icon-base ti tabler-list"></i>
                                </span>  -->
                                <select id="position_id" name="position_id" class="select2 form-select fs-6" style="text-transform:capitalize;">
                                    <option value="">Select Contact Position</option>
                                    @foreach($positions as $position)
                                        <option value="{{$position->id}}">{{$position->position}}</option>
                                    @endforeach
                                                            
                                </select>

                            </div> 
                        </div>

                    
                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="physical_address">Contact Physical Address</label>                             
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-paddress">
                                    <i class="icon-base ti tabler-map-pin"></i>
                                </span>
                                <textarea id="contact_physical_address" name="contact_physical_address" class="form-control autosize fs-5" placeholder="Enter Contact Physical Address... (Optional)" rows="" style="text-transform:capitalize;" aria-describedby="basic-addon-paddress" ></textarea>
                            </div>
                        </div>
                        
                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="gender">Contact Gender</label> 
                            
                            <div class="switches-stacked">
                                <label class="switch switch-square">
                                    <input type="radio" value="Male" class="switch-input" id="contact_gender" name="contact_gender" />
                                    <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                    </span>
                                    <span class="switch-label"><i class="icon-base ti tabler-gender-male"></i> Male</span>
                                </label>

                                <label class="switch switch-square">
                                    <input type="radio" value="Female" class="switch-input" id="contact_gender" name="contact_gender" />
                                    <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                    </span>
                                    <span class="switch-label"><i class="icon-base ti tabler-gender-female"></i> Female</span>
                                </label>

                                <label class="switch switch-square">
                                    <input type="radio" value="Other" class="switch-input" id="contact_gender" name="contact_gender" />
                                    <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                    </span>
                                    <span class="switch-label"><i class="icon-base ti tabler-gender-third"></i> Other</span>
                                </label>

                               
                            </div>
                            
                        </div>


                        
                        <div class="col-md-4 form-control-validation">
                           <label class="form-label fs-5" for="date_of_birth">Contact Date of Birth</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-dob">
                                    <i class="icon-base ti tabler-calendar"></i>
                                </span>                                    
                                <input type="date" id="contact_date_of_birth" name="contact_date_of_birth" class="form-control" placeholder="Contact Date of Birth (Optional)" style="text-transform:;" aria-describedby="basic-addon-dob" />                        
                            </div> 
                        </div>


                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="position_id">Referrer Type</label>
                            <div class="input-group input-group-merge"> 
                                <select id="referrer_type_id" name="referrer_type_id" class="select2 form-select fs-6" style="text-transform:capitalize;">
                                    <option value="">Select Referrer Type</option>
                                    @foreach($referrer_types as $referrer_type)
                                        <option value="{{$referrer_type->id}}">{{$referrer_type->referrer_type}}</option>
                                    @endforeach
                                                            
                                </select>

                            </div> 
                        </div>

                        <div class="col-md-4 form-control-validation" id="ref-employee-div">
                            <label class="form-label fs-5" for="position_id">Employee</label>
                            <div class="input-group input-group-merge"> 
                                <select id="user_id" name="user_id" class="select2 form-select fs-6" style="text-transform:capitalize;">
                                    <option value="">Select Employee</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                                    @endforeach
                                                            
                                </select>

                            </div> 
                        </div>

                        <div class="col-md-4 form-control-validation" id="ref-supplier-div">
                            <label class="form-label fs-5" for="position_id">Supplier</label>
                            <div class="input-group input-group-merge"> 
                                <select id="supplier_id" name="supplier_id" class="select2 form-select fs-6" style="text-transform:capitalize;">
                                    <option value="">Select Supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{$supplier->id}}">{{$supplier->supplier}} (+{{$supplier->phone_number}})</option>
                                    @endforeach
                                                            
                                </select>

                            </div> 
                        </div>

                        <div class="col-md-4 form-control-validation" id="ref-customer-div">
                            <label class="form-label fs-5" for="position_id">Customer</label>
                            <div class="input-group input-group-merge"> 
                                <select id="customer_id" name="customer_id" class="select2 form-select fs-6" style="text-transform:capitalize;">
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->customer}} (+{{$customer->phone_number}})</option>
                                    @endforeach
                                                            
                                </select>

                            </div> 
                        </div>

                        <div class="col-md-4 form-control-validation" id="ref-referrer-div">
                            <label class="form-label fs-5" for="position_id">Referrer</label>
                            <div class="input-group input-group-merge"> 
                                <select id="referrer_id" name="referrer_id" class="select2 form-select fs-6" style="text-transform:capitalize;">
                                    <option value="">Select Referrer</option>
                                    @foreach($referrers as $referrer)
                                        <option value="{{$referrer->id}}">{{$referrer->first_name}} {{$referrer->last_name}}</option>
                                    @endforeach
                                                            
                                </select>

                            </div> 
                        </div>
                        

                        <div class="col-12 form-control-validation">
                            <div class="form-check">
                                <input type="checkbox" id="terms" name="terms" class="form-check-input" checked />
                                <label class="form-check-label fs-5" for="terms">Customer has agreed to our terms and conditions</label>
                            </div>
                        </div>

                        <div class="col-12 form-control-validation">
                            <button type="submit" id="add-btn" name="add-btn" class="btn btn-info button-prevent-multiple-submits p-3 float-end">Add Customer</button>
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
             
            $('#customer_type_id').select2({

                "placeholder": "Select Customer Type",

            });

            $('#position_id').select2({

                "placeholder": "Select Contact Position",

            });
          
            $('#is_active').select2({

                "placeholder": "Choose Status",

            });


            $('#referrer_type_id').select2({

                "placeholder": "Select Referrer Type",

            });


            $('#referrer_id').select2({

                "placeholder": "Select Referrer",

            });


            $('#user_id').select2({

                "placeholder": "Select Employee",

            });


            $('#customer_id').select2({

                "placeholder": "Select Customer",

            });


            $('#supplier_id').select2({

                "placeholder": "Select Supplier",

            });


            //////////////////////////// /////////////////////////////////////////////////////////

            $('#ref-customer-div').hide();
            $('#ref-supplier-div').hide();
            $('#ref-employee-div').hide();
            $('#ref-referrer-div').hide();


            let referrer_type = "";

            $(document).on('change', '#referrer_type_id', function() {
                
                //let ref_selected_item = $(this).find('option:selected').val();
                let ref_selected_item = $(this).find('option:selected').text();
                referrer_type = $(this).find('option:selected').text();

                if(ref_selected_item == "Employee"){
                    
                    $('#employee_id').val($('#employee_id option:first-child').val()).trigger('change');
                    $('#customer_id').val($('#customer_id option:first-child').val()).trigger('change');
                    $('#supplier_id').val($('#supplier_id option:first-child').val()).trigger('change');
                    $('#referrer_id').val($('#referrer_id option:first-child').val()).trigger('change');
                   
                    $('#ref-customer-div').hide();
                    $('#ref-supplier-div').hide();
                    $('#ref-employee-div').show();
                    $('#ref-referrer-div').hide();
                    

                }
                else if(ref_selected_item == "Customer"){

                    $('#customer_id').val($('#customer_id option:first-child').val()).trigger('change');
                    $('#employee_id').val($('#employee_id option:first-child').val()).trigger('change');                    
                    $('#supplier_id').val($('#supplier_id option:first-child').val()).trigger('change');
                    $('#referrer_id').val($('#referrer_id option:first-child').val()).trigger('change');
                                                          
                    $('#ref-customer-div').show();
                    $('#ref-supplier-div').hide();
                    $('#ref-employee-div').hide();
                    $('#ref-referrer-div').hide();
                }
                else if(ref_selected_item == "Supplier"){

                    
                    $('#supplier_id').val($('#supplier_id option:first-child').val()).trigger('change');
                    $('#employee_id').val($('#employee_id option:first-child').val()).trigger('change');
                    $('#customer_id').val($('#customer_id option:first-child').val()).trigger('change');
                    $('#referrer_id').val($('#referrer_id option:first-child').val()).trigger('change');
                                       
                    $('#ref-customer-div').hide();
                    $('#ref-supplier-div').show();
                    $('#ref-employee-div').hide();
                    $('#ref-referrer-div').hide();
                   
                }else if(ref_selected_item == "Others"){

                    $('#referrer_id').val($('#referrer_id option:first-child').val()).trigger('change');                      
                    $('#employee_id').val($('#employee_id option:first-child').val()).trigger('change');
                    $('#customer_id').val($('#customer_id option:first-child').val()).trigger('change');
                    $('#supplier_id').val($('#supplier_id option:first-child').val()).trigger('change');
                                     
                    $('#ref-customer-div').hide();
                    $('#ref-supplier-div').hide();
                    $('#ref-employee-div').hide();
                    $('#ref-referrer-div').show();
                   
                }else{

                    $('#employee_id').val($('#employee_id option:first-child').val()).trigger('change');
                    $('#customer_id').val($('#customer_id option:first-child').val()).trigger('change');
                    $('#supplier_id').val($('#supplier_id option:first-child').val()).trigger('change');
                    $('#referrer_id').val($('#referrer_id option:first-child').val()).trigger('change');
                   
                    $('#ref-customer-div').hide();
                    $('#ref-supplier-div').hide();
                    $('#ref-employee-div').hide();
                    $('#ref-referrer-div').hide();

                }
            
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
                    formData.append("referrer_type", referrer_type);

                    console.log(referrer_type);
                                  
                    // Initiate Ajax request
                    $.ajax({

                        url: '/add-customer',
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

                                window.location = "/customers";

                            });
                        
                            $('.button-prevent-multiple-submits').attr('disabled', false);
                            $('#add-btn').text('Add Customer');
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
                            $('#add-btn').text('Add Customer');
                        }

                    });
                }

                
            });


        });

    </script>
    <!-- end script -->

@endpush