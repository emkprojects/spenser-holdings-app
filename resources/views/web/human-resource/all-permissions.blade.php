@extends('layouts.admin', ['title' => 'Permissions'])

@push('stylesheets')

    <!-- CSRF-TOEKN -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/tagify/tagify.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/@form-validation/form-validation.css') }}" />
    
    <!-- <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/flatpickr/flatpickr.css') }}" /> -->

    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.5/css/responsive.bootstrap5.min.css" /> 

@livewireStyles()

@endpush

@section('content')


    <!-- view record table start -->
    <div class="page-content">
        <div class="container-fluid">

             <div class="row">
                <div class="card">

                    <div class="card-header">

                        <div class="row">

                            <div class="col-xl-10">
                                <h4 class="pb-0 mt-1 text-md-start text-center fw-bold" style="text-transform:uppercase;">{{$role->name}} ROLE PERMISSIONS</h4>
                            </div>

                        </div>

                    </div>


                    <!-- start page title -->
                    <!-- <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0" style="text-transform:uppercase;">{{$role->name}} PERMISSION MANAGEMENT</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Permissions</a></li>
                                        <li class="breadcrumb-item active">All Permissions</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div> -->
                    <!-- end page title -->

                    <!-- <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                     -->
                                    <div class="card-body">


                                        <div class="mb-4">

                                            <div class="mb-3 text-center">
                                                <h5 class="card-title mb-0">Selected Permissions</h5>
                                            </div>                                        

                                            <livewire:selected-permission :role_id="$role->id">

                                        </div>

                                        <div class="mb-3">

                                            <div class="mb-3 text-center">
                                                <h5 class="card-title mb-0">Available Permissions</h5>
                                            </div>

                                            <form id="add-permisions-to-role-form" method="POST">
                                                <button type="submit" class="btn btn-success button-prevent-multiple-submits">Assign Permissions</button>
                                            </form>

                                        </div>


                                        <div class="table-responsive custom-scrollbar">
                                            <table id="permissions" class="table table-bordered nowrap table-striped align-middle" style="width:100%">

                                                <thead>
                                                    <tr>
                                                        <th width="3%">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                            </div>
                                                        </th>

                                                        <th width="3%">ID</th>
                                                        <th>Permission</th>
                                
                                                    </tr>
                                                </thead>

                                            
                                            </table>
                                        </div>

                                    </div>

                                <!-- </div>
                            </div>
                        </div> -->
                        <!--end col-->
                    <!-- </div> -->
                    <!--end row-->
                            
                            
                            
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            

        </div>
    </div>
    <!-- view record table end -->
    




@endsection

@push('scripts')

    <!-- <script src="{{ asset('/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('/assets/js/tables-datatables-advanced.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script> -->

    <!-- Vendors JS -->
    <script src="{{ asset('/assets/vendor/libs/select2/select2.js') }}"></script>
    <!-- <script src="{{ asset('/assets/js/forms-selects.js') }}"></script> -->
    <script src="{{ asset('/assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/tagify/tagify.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/@form-validation/auto-focus.js') }}"></script>

    <!-- validation scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
    <!-- sweetalert2 scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    
    
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.5/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.5/js/responsive.bootstrap5.min.js"></script>
    
    <!-- <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> -->

    <!-- sweetalert2 scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @livewireScripts()

  <script>

    $(document).ready(function() {

        ///////////////////////////AJAX CSRF SET UP ///////////////////////////////////////////////////////////////

        $.ajaxSetup({
            headers: {
            //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-CSRF-TOKEN': "{{csrf_token()}}",
            }
        });


        var role_id = '{{$role->id}}';

        var role_reference = '{{$role->role_reference}}';
 
        //console.log(role_id);

        var permissions_to_add = [];

        var table = $('#permissions').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/permissions-by-role/"+role_reference,
            columns: [
                { data: 'checkbox', name: 'checkbox'},
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false},
                { data: 'name', name: 'name'},
         
            ]
        });


        //document.getElementById('checkAll').addEventListener('change', function () {

        $(document).on('change', '#checkAll', function() {
            
            let checkboxes = document.querySelectorAll('.permission-checkbox');

            checkboxes.forEach(function (checkbox) {

                checkbox.checked = this.checked;
            }, this);

        });


        //////////////////////ON SELECT OF MEMBER /////////////////////////////////////////////
        
        $(document).on('change', '.permission-checkbox', function() {

            var permission = $(this).attr('id');

            if($(this).prop('checked')){

                permissions_to_add.push(permission);
                
            }

            else{
                var index = permissions_to_add.indexOf(permission);

                if (index !== -1) {

                    permissions_to_add.splice(index, 1);

                }
            }

        });




        /////////////////ON SUBMIT ///////////////////////////////////////////////////////////
        $("#add-permisions-to-role-form").on('submit', function(event) { 

            $('.button-prevent-multiple-submits').attr('disabled', true);
            event.preventDefault();

            if(permissions_to_add.length > 0){

                var formData = new FormData();

                $.each(permissions_to_add, function(index, value) 
                {
                    formData.append('permissions[]', value);
                });

                formData.append('role_id', role_id);

                $.ajax({
                    type: 'post',
                    url: '/add-permissions-to-role/'+role_id,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: formData,

                    success: function(response){

                        Swal.fire({

                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            toast:'true',
                            showConfirmButton:false,
                            position:'top-end',
                            timer:3000
                                
                        });

                        $("#add-permisions-to-role-form")[0].reset();
                        $('.button-prevent-multiple-submits').attr('disabled', false);
                        permissions_to_add.length = 0;
                        table.ajax.reload();
                        Livewire.dispatch('refreshComponent', { role_id: role_id });
                        

                    },
                    error: function(response){
                            
                            if(response.status == 422){
                                var firstKey = Object.keys(response.responseJSON.errors)[0];
                                Swal.fire({
                                title: 'Error',
                                text: response.responseJSON.errors[firstKey][0],
                                icon: 'error',
                                toast:'true',
                                showConfirmButton:false,
                                position:'top-end',
                                timer:5000
                                
                                });
                            }    
                            $('.button-prevent-multiple-submits').attr('disabled', false);
                    }
                
                });
            }
            else{

                Swal.fire({
                    title: 'Error',
                    text: 'Please select atleast one permission',
                    icon: 'error',
                    toast:'true',
                    showConfirmButton:false,
                    position:'top-end',
                    timer:3000

                    
                });

                $('.button-prevent-multiple-submits').attr('disabled', false);
            }

        });


        window.addEventListener('reloadTable', (e) => {

            //console.log(e);
            
            table.ajax.reload();

        });
 


    });

  </script>
  
@endpush