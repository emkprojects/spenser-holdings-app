@extends('layouts.admin', ['title' => 'Referrers'])

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

@endpush

@section('content')


    <!-- view record table start -->
    <div class="row">
        <div class="col-12">
        
            <div class="card">

                <div class="card-header">

                    <div class="row">

                            <div class="col-xl-10">
                                <h4 class="pb-0 mt-1 text-md-start text-center fw-bold">All Referrers</h4>
                            </div>

                            @can('add-referrers')
                            <div class="col-xl-2 float:right;">
                                <a href="/new-referrer" class="btn btn-primary record-view-btn" title="Add Record">
                                    <i class="menu-icon icon-base ti tabler-file-plus"></i> New Referer
                                </a>
                            </div>
                            @endcan
                    </div>

                </div>

                <div class="card-body text-nowrap">
                    <div class="row">
                        <div class="col-12">

                            <table class="table table-bordered table-striped align-middle dt-responsive nowrap" id="record-table">
                                <thead>
                                <tr class="fw-bold fs-3">
                                    <th width="2%">ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Phone Number</th>
                                    <th>Email Address</th>
                                    <th>Physical Address</th>
                                    <!-- <th>Gender</th> -->
                                    <th>Referrer Type</th>                
                                    <!-- <th>Status</th> -->
                                    <!-- <th width="10%">Record Date</th> -->
                                    <!-- <th width="10%">Created By</th> -->
                                    <th width="3%">Actions</th>
                                </tr>
                                </thead>
                            </table>

                        </div>
                    </div>
                </div>
                
                <br/><br/>

            </div>

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

  <script>
    $(document).ready(function() {

        ///////////////////////////AJAX CSRF SET UP ///////////////////////////////////////////////////////////////

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





        //////////////////////////////// DATATABLE INITIALISATION /////////////////////////////////////////////////
        
        var table =  $('#record-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/referrers",
            columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false},
            { data: 'first_name', name: 'referrers.first_name'},
            { data: 'last_name', name: 'referrers.last_name'},
            { data: 'phone_number', name: 'referrers.phone_number'},
            { data: 'email_address', name: 'referrers.email_address'}, 
            { data: 'physical_address', name: 'referrers.physical_address'},
            // { data: 'gender', name: 'referrers.gender'},
            { data: 'referrer_type', name: 'referrer_types.referrer_type'},              
            //{ data: 'is_active', name: 'users.is_active'},                           
            // { data: 'created_at', name: 'users.created_at' },
            // { data: 'name', name: 'users.name' },
            { data: 'actions', name: 'actions' },
            ],

            "columnDefs": [

                {
                
                },
            ]
        });
    




        ///////// DELETE RECORD /////////////////////////////////////////////////////////////////
        $(document).on('click', '.record-del-btn', function() {
            var record_id = $(this).attr('id');
            // console.log(id);

            Swal.fire({
                title: '<span class="text text-warning fw-bold">Are you sure?</span>',
                text: "Referrer will be deleted",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'

            }).then((result) => {

                if (result.isConfirmed) {
                                        
                    //console.log("X-CRSF-TOKEN : ", "{{csrf_token()}}" );

                    $.ajax({
                    // headers: {
                    //   'X-CSRF-Token': "{{csrf_token()}}",
                    // },
                    type:'post',
                    url: '/delete-referrer/'+ record_id,

                        success:function(response){

                            Swal.fire(
                                '<span class="text text-success fw-bold">SUCCESS MESSAGE</span>',
                                'Referrer has been deleted.',
                                'success'
                            )

                            table.ajax.reload();
                        }
                    });
                }
            
            });
              
        });





    });

  </script>
  
@endpush