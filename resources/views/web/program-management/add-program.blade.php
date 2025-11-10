@extends('layouts.admin', ['title' => 'Add Program'])

@push('stylesheets')

    <!-- CSRF-TOEKN -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Vendors CSS -->
    <!-- <link rel="stylesheet" href="/assets/vendor/libs/bootstrap-select/bootstrap-select.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/tagify/tagify.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/@form-validation/form-validation.css" /> -->

    <!-- select2 styles -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


@endpush

@section('content')

    <!-- start container-fluid -->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            
            <!-- start page card -->
            <div class="col-12">
            <div class="card">

                <div class="card-header">

                    <div class="row">
                        <div class="col-xl-12">
                        <h4 class="pb-0 mt-1 fs-5 text-md-start text-center fw-bold"> ADD NEW PROGRAM</h4>
                        </div>
                    </div>
                
                </div>

                <div class="card-body">

                    <form method="POST" id="add-form" nam="add-form" class="row g-6">
                        <!-- @csrf -->
                        
                        <div class="col-md-12 form-control-validation">
                            <label class="form-label fs-5" for="program">Program</label>
                           <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-program">
                                    <i class="icon-base ti tabler-file-text"></i>
                                </span>                                    
                                <input type="text" id="program" name="program" class="form-control" placeholder="Enter Program" style="text-transform:capitalize;" aria-describedby="basic-addon-program" />                        
                            </div> 
                        </div> 

                        <div class="col-md-12 form-control-validation">
                            <label class="form-label fs-5" for="description">Description</label>                             
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-description">
                                    <i class="icon-base ti tabler-file-info"></i>
                                </span>
                                <textarea id="description" name="description" class="form-control autosize" placeholder="Describe something about the Program..." rows="3" style="text-transform:capitalize;" aria-describedby="basic-addon-description" ></textarea>
                            </div>
                        </div>

                        <!-- <div class="col-12 form-control-validation">
                            <div class="form-check">
                                <input type="checkbox" id="terms" name="terms" class="form-check-input" checked />
                                <label class="form-check-label fs-5" for="terms">Agree to our terms and conditions</label>
                            </div>
                        </div> -->

                        <div class="col-12 form-control-validation">
                            <button type="submit" id="add-btn" name="add-btn" class="btn btn-info button-prevent-multiple-submits p-3 float-end">Add Program</button>
                        </div>

                    </form>

                </div>
            </div>
            </div>
            <!-- end page card -->

        </div>
        <!-- end page title -->

    </div>
    <!-- end container-fluid -->

@endsection

@push('scripts')

    <!-- Vendors JS -->
    <!-- <script src="/assets/vendor/libs/select2/select2.js"></script>
    <script src="/assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
    <script src="/assets/vendor/libs/moment/moment.js"></script>
    <script src="/assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="/assets/vendor/libs/tagify/tagify.js"></script>
    <script src="/assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="/assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="/assets/vendor/libs/@form-validation/auto-focus.js"></script> -->

    <!-- validation scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
    <!-- sweetalert2 scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- select2 scripts -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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


            /////////////////DATE TIME PICKER INITIALISATION /////////////////////////////////////
        

            ///////////////////////SELECT 2 INITIALISATION ///////////////////////////////////////



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

                        url: '/add-program',
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
                                //text: 'Program created successfully',
                                text: response.message,
                                icon: 'success',
                                toast:'true',
                                showConfirmButton:false,
                                position:'top-end',
                                //background: "#FCFCFC",
                                timer:5000
                                
                            }).then(function() {

                                window.location = "/view-programs";

                            });
                        
                            $('.button-prevent-multiple-submits').attr('disabled', false);
                            $('#add-btn').text('Add Program');
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
                            $('#add-btn').text('Add Program');
                        }

                    });
                }

                
            });


        });

    </script>
    <!-- end script -->

@endpush