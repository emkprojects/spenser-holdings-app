@extends('layouts.admin', ['title' => 'Edit Supplier'])

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
                        <h4 class="pb-0 mt-1 fs-5 text-md-start text-center fw-bold"> UPDATE SUPPLIER RECORD</h4>
                        </div>
                    </div>
                
                </div>

                <div class="card-body">

                    <form method="POST" id="add-form" nam="add-form" class="row g-6">
                        <!-- @csrf -->

                        <input type="hidden" value="{{ $supplier->id}}" id="supplier_id" name="supplier_id" class="form-control" placeholder="" style="text-transform:;" aria-describedby="basic-addon-customer-id" />
                        <input type="hidden" value="{{ $supplier->supplier_reference}}" id="supplier_reference" name="supplier_reference" class="form-control" placeholder="" style="text-transform:;" aria-describedby="basic-addon-customer-ref" />

                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="supplier_type_id">Supplier Type</label>
                            <div class="input-group input-group-merge">                    
                                
                                <select id="supplier_type_id" name="supplier_type_id" class="select2 form-select fs-6" style="text-transform:capitalize;">
                                    @foreach($supplier_types as $supplier_type)
                                        
                                        <!-- @if($supplier_type->id == $supplier->supplier_type_id)
                                            <option value="{{$supplier_type->id}}">{{ucwords($supplier_type->supplier_type)}}</option>
                                        @else
                                            <option value="{{$supplier_type->id}}">{{ucwords($supplier_type->supplier_type)}}</option>
                                        @endif -->

                                        <option value="{{ $supplier_type->id }}" {{ ($supplier_type->id == $supplier->supplier_type_id) ? 'selected' : '' }}>{{ $supplier_type->supplier_type }}</option>

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
                                <input type="text" value="{{ $supplier->national_identification_number}}" id="national_identification_number" name="national_identification_number" class="form-control" placeholder="Enter NIN (Optional)" style="text-transform:uppercase;" aria-describedby="basic-addon-nin"  maxlength="14"/>                        
                            </div> 
                        </div> 

                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="tax_identification_number">TIN</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-tin">
                                    <i class="icon-base ti tabler-user"></i>
                                </span>                                    
                                <input type="text" value="{{ $supplier->tax_identification_number}}" id="tax_identification_number" name="tax_identification_number" class="form-control" placeholder="Enter TIN (Optional)" style="text-transform:uppercase;" aria-describedby="basic-addon-tin" maxlength="10"/>                        
                            </div> 
                        </div>
                        
                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="supplier">Supplier</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-supplier">
                                    <i class="icon-base ti tabler-user"></i>
                                </span>                                    
                                <input type="text" value="{{ $supplier->supplier}}" id="supplier" name="supplier" class="form-control" placeholder="Enter Supplier" style="text-transform:;" aria-describedby="basic-addon-supplier" />                        
                            </div> 
                        </div> 

                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="phone">Phone Number</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-phone">
                                    <i class="icon-base ti tabler-phone"></i>
                                </span>                                    
                                <input type="text" value="{{ $supplier->phone_number}}" id="phone_number" name="phone_number" class="form-control phone" placeholder="Enter Mobile Number" style="text-transform:;" aria-describedby="basic-addon-phone" maxlength="11" />                        
                            </div> 
                        </div> 

                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="alternative_phone">Alternative Mobile Number</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-aphone">
                                    <i class="icon-base ti tabler-phone"></i>
                                </span>                                    
                                <input type="text" value="{{ $supplier->alternative_phone}}" id="alternative_phone" name="alternative_phone" class="form-control phone" placeholder="Enter Alternative Mobile Number (Optional)" style="text-transform:;" aria-describedby="basic-addon-aphone" maxlength="11" />                        
                            </div> 
                        </div>                        
                        
                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="email">Email Address</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-email">
                                    <i class="icon-base ti tabler-mail"></i>
                                </span>                                    
                                <input type="email" value="{{ $supplier->email_address}}" id="email_address" name="email_address" class="form-control" placeholder="Enter Email Address" style="text-transform:;" aria-describedby="basic-addon-email" />                        
                            </div> 
                        </div>


                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="alternative_email">Alternative Email Address</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-aemail">
                                    <i class="icon-base ti tabler-mail"></i>
                                </span>                                    
                                <input type="email" value="{{ $supplier->alternative_email}}" id="alternative_email" name="alternative_email" class="form-control" placeholder="Enter Alternavtive Email Address (Optional)" style="text-transform:;" aria-describedby="basic-addon-aemail" />                        
                            </div> 
                        </div>                  


                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="physical_address">Physical Address</label>                             
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-paddress">
                                    <i class="icon-base ti tabler-map-pin"></i>
                                </span>
                                <textarea id="physical_address" name="physical_address" class="form-control autosize fs-5" placeholder="Enter Physical Address... (Optional)" rows="3" style="text-transform:capitalize;" aria-describedby="basic-addon-paddress" >{{ $supplier->physical_address}}</textarea>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="first_name">Contact First Name</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-fname">
                                    <i class="icon-base ti tabler-user"></i>
                                </span>                                    
                                <input type="text" value="{{ $supplier->contact_first_name}}" id="contact_first_name" name="contact_first_name" class="form-control" placeholder="Enter Contact First name" style="text-transform:capitalize;" aria-describedby="basic-addon-fname" />                        
                            </div> 
                        </div> 


                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="last_name">Contact Last Name</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-lname">
                                    <i class="icon-base ti tabler-user"></i>
                                </span>                                    
                                <input type="text" value="{{ $supplier->contact_last_name}}" id="contact_last_name" name="contact_last_name" class="form-control" placeholder="Enter Contact Last name" style="text-transform:capitalize;" aria-describedby="basic-addon-lname" />                        
                            </div> 
                        </div> 


                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="other_name">Contact Other Names</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-oname">
                                    <i class="icon-base ti tabler-user"></i>
                                </span>                                    
                                <input type="text" value="{{ $supplier->contact_other_name}}" id="contact_other_name" name="other_name" class="form-control" placeholder="Enter Contact Other names (Optional)" style="text-transform:capitalize;" aria-describedby="basic-addon-oname" maxlength="11" />                        
                            </div> 
                        </div> 

                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="cphone">Contact Mobile Number</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-cphone">
                                    <i class="icon-base ti tabler-phone"></i>
                                </span>                                    
                                <input type="text" value="{{ $supplier->contact_phone_number}}" id="contact_phone_number" name="contact_phone_number" class="form-control phone" placeholder="Enter Contact Mobile Number" style="text-transform:;" aria-describedby="basic-addon-cphone" maxlength="11" />                        
                            </div> 
                        </div> 

                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="contact_alternative_phone">Contact Alternative Phone</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-caphone">
                                    <i class="icon-base ti tabler-phone"></i>
                                </span>                                    
                                <input type="text" value="{{ $supplier->contact_alternative_phone}}" id="contact_alternative_phone" name="contact_alternative_phone" class="form-control phone" placeholder="Enter Contact Alternative Mobile Number (Optional)" style="text-transform:;" aria-describedby="basic-addon-caphone" maxlength="11" />                        
                            </div> 
                        </div>                        
                        
                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="contact_email">Contact Email Address</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-cemail">
                                    <i class="icon-base ti tabler-mail"></i>
                                </span>                                    
                                <input type="email" value="{{ $supplier->contact_email_address}}" id="contact_email_address" name="contact_email_address" class="form-control" placeholder="Enter Contact Email Address" style="text-transform:;" aria-describedby="basic-addon-cemail" />                        
                            </div> 
                        </div>


                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="contact_alternative_email">Contact Alternative Email</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-caemail">
                                    <i class="icon-base ti tabler-mail"></i>
                                </span>                                    
                                <input type="email" value="{{ $supplier->contact_alternative_email}}" id="contact_alternative_email" name="contact_alternative_email" class="form-control" placeholder="Enter Contact Alternavtive Email Address (Optional)" style="text-transform:;" aria-describedby="basic-addon-caemail" />                        
                            </div> 
                        </div> 
                        
                        
                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="position_id">Contact Position</label>
                            <div class="input-group input-group-merge">                    
                                
                                <select id="position_id" name="position_id" class="select2 form-select fs-6" style="text-transform:capitalize;">
                                    @foreach($positions as $position)
                                        
                                        <!-- @if($position->id == $supplier->position_id)
                                            <option value="{{$supplier->position_id}}">{{ucwords($supplier->position)}}</option>
                                        @else
                                            <option value="{{$position->id}}">{{ucwords($position->position)}}</option>
                                        @endif -->

                                        <option value="{{ $position->id }}" {{ ($position->id == $supplier->position_id) ? 'selected' : '' }}>{{ $position->position }}</option>

                                    @endforeach
                                                            
                                </select>

                            </div> 
                        </div>                        

                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="contact_date_of_birth">Contact Date of Birth</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-dob">
                                    <i class="icon-base ti tabler-calendar"></i>
                                </span>                                    
                                <input type="date" value="{{ $supplier->contact_date_of_birth}}" id="contact_date_of_birth" name="contact_date_of_birth" class="form-control" placeholder="Enter Date of Birth (Optional)" style="text-transform:;" aria-describedby="basic-addon-dob" />                        
                            </div> 
                        </div>
                        

                        <div class="col-md-4 form-control-validation">
                            <label class="form-label fs-5" for="contact_physical_address">Conatct Physical Address</label>                             
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-cpaddress">
                                    <i class="icon-base ti tabler-map-pin"></i>
                                </span>
                                <textarea id="contact_physical_address" name="contact_physical_address" class="form-control autosize fs-5" placeholder="Enter Contact Physical Address... (Optional)" rows="3" style="text-transform:capitalize;" aria-describedby="basic-addon-cpaddress" >{{ $supplier->contact_physical_address}}</textarea>
                            </div>
                        </div>


                        <div class="col-md-2 form-control-validation">
                            <label class="form-label fs-5" for="gender">Contact Gender</label> 
                            
                            <div class="switches-stacked">
                                <label class="switch switch-square">
                                    @if($supplier->contact_gender == "Male")
                                        <input type="radio" value="Male" class="switch-input" id="contact_gender" name="contact_gender" checked />
                                    @else
                                        <input type="radio" value="Male" class="switch-input" id="contact_gender" name="contact_gender" />
                                    @endif
                                    <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                    </span>
                                    <span class="switch-label"><i class="icon-base ti tabler-gender-male"></i> Male</span>
                                </label>

                                <label class="switch switch-square">
                                    @if($supplier->contact_gender == "Female")
                                        <input type="radio" value="Female" class="switch-input" id="contact_gender" name="contact_gender" checked />
                                    @else
                                        <input type="radio" value="Female" class="switch-input" id="contact_gender" name="contact_gender" />
                                    @endif                                    
                                    <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                    </span>
                                    <span class="switch-label"><i class="icon-base ti tabler-gender-female"></i> Female</span>
                                </label>

                                <label class="switch switch-square">
                                    @if($supplier->contact_gender == "Other")
                                        <input type="radio" value="Other" class="switch-input" id="contact_gender" name="contact_gender" checked />
                                    @else
                                        <input type="radio" value="Other" class="switch-input" id="contact_gender" name="contact_gender" />
                                    
                                    @endif    
                                    <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                    </span>
                                    <span class="switch-label"><i class="icon-base ti tabler-gender-third"></i> Other</span>
                                </label>

                               
                            </div>
                            
                        </div>


                        <div class="col-md-2 form-control-validation">
                            <label class="form-label fs-6" for="is_active">Record Status</label>
                            <div class="input-group input-group-merge">                    
                                
                                <select id="is_active" name="is_active" class="select2 w-100 fs-6" data-style="btn-default" style="text-transform:capitalize;">
                                    
                                    @if($supplier->is_active == 1)
                                        <option value="1">Enabled</option>
                                        <option value="0">Disable</option>
                                    @else
                                        <option value="0">Disabled</option>
                                        <option value="1">Enable</option>                                    
                                    @endif   
                                   
                                                                
                                </select>

                            </div> 
                        </div>


                                               

                        <div class="col-12 form-control-validation">
                            <div class="form-check">
                                <input type="checkbox" id="terms" name="terms" class="form-check-input" checked />
                                <label class="form-check-label fs-5" for="terms">Referrer has agreed to our terms and conditions</label>
                            </div>
                        </div>

                        <div class="col-12 form-control-validation">
                            <button type="submit" id="add-btn" name="add-btn" class="btn btn-info button-prevent-multiple-submits p-3 float-end">Update SUpplier</button>
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
             
            $('#supplier_type_id').select2({

                "placeholder": "Select Customer Type",

            });


            $('#referrer_type_id').select2({

                "placeholder": "Select Referrer Type",

            });


            $('#position_id').select2({

                "placeholder": "Select Contact Position",

            });

          
            $('#is_active').select2({

                "placeholder": "Choose Status",

            });




            /////////////////////////////////////////////// PHONE NUMBER FORMATTING /////////////////////////
            
            var phone_number = $("#phone_number").val();
           
            var sliced_phone_number = 0;
            if(phone_number.length == 13){
                sliced_phone_number = phone_number.slice(4);
            }
            else {
                sliced_phone_number = phone_number.slice(3);
            }    
            var formatted_phone_number = sliced_phone_number.replace(/^(.{3})(.{3})(.*)$/, "$1 $2 $3");
            
            $("#phone_number").val(formatted_phone_number);

         
            var alternative_phone_number = $("#alternative_phone").val();

            if(alternative_phone_number !== null){

                var sliced_alternative_phone_number = 0;
                if(alternative_phone_number.length == 13){
                    sliced_alternative_phone_number = alternative_phone_number.slice(4);
                }
                else {
                    sliced_alternative_phone_number = alternative_phone_number.slice(3);
                }    
                var formatted_alternative_phone_number = sliced_alternative_phone_number.replace(/^(.{3})(.{3})(.*)$/, "$1 $2 $3");
                
                $("#alternative_phone").val(formatted_alternative_phone_number);

            }

            var contact_phone_number = $("#contact_phone_number").val();
            
            var sliced_contact_phone_number = 0;
            if(contact_phone_number.length == 13){
                sliced_contact_phone_number = contact_phone_number.slice(4);
            }
            else {
                sliced_contact_phone_number = contact_phone_number.slice(3);
            }    
            var formatted_contact_phone_number = sliced_contact_phone_number.replace(/^(.{3})(.{3})(.*)$/, "$1 $2 $3");
            
            $("#contact_phone_number").val(formatted_contact_phone_number);


            var alternative_contact_phone_number = $("#contact_alternative_phone").val();

            if(alternative_contact_phone_number !== null){

                var sliced_alternative_contact_phone_number = 0;
                if(alternative_contact_phone_number.length == 13){
                    sliced_alternative_contact_phone_number = alternative_contact_phone_number.slice(4);
                }
                else {
                    sliced_alternative_contact_phone_number = alternative_contact_phone_number.slice(3);
                }    
                var formatted_alternative_contact_phone_number = sliced_alternative_contact_phone_number.replace(/^(.{3})(.{3})(.*)$/, "$1 $2 $3");
                
                $("#contact_alternative_phone").val(formatted_alternative_contact_phone_number);

            }
            


            //////////////////////////// /////////////////////////////////////////////////////////




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

                    //console.log("CURRENT REFERRER TYPE :", referrer_type);                    
                        
                    // Format the form data
                    var formData = new FormData(form);   
                
                    // Initiate Ajax request
                    $.ajax({

                        url: '/edit-supplier',
                        type: 'post',
                        data: formData,
                        processData: false,
                        contentType: false,

                        beforeSend:function(){

                            $('#add-btn').text('Processing...');

                        },

                        success: function(response) {

                            //console.log(response);

                            Swal.fire({
                                title: '<span class="text text-success fw-bold">SUCCESS MESSAGE</span>',
                                //text: 'Supplier updated successfully',
                                text: response.message,
                                icon: 'success',
                                toast:'true',
                                showConfirmButton:false,
                                position:'top-end',
                                //background: "#FCFCFC",
                                timer:5000
                                
                            }).then(function() {

                                window.location = "/suppliers";

                            });
                        
                            $('.button-prevent-multiple-submits').attr('disabled', false);
                            $('#add-btn').text('Update Supplier');
                        },

                        error: function(response){
                                                
                            //console.log(response);
                            
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
                            $('#add-btn').text('Update Supplier');
                        }

                    });
                }

                
            });


        });

    </script>
    <!-- end script -->

@endpush