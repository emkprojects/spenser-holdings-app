@extends('layouts.admin', ['title' => 'Item Categories'])

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
        <div class="card">

            <div class="card-header">

            <div class="row">

                    <div class="col-xl-10">
                        <h4 class="pb-0 mt-1 text-md-start text-center fw-bold">All Item Categories</h4>
                    </div>

                    @can('add-item-categories')
                    <div class="col-xl-2 float:right;">
                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#addRecordModal" class="btn btn-primary record-view-btn" title="Add Record">
                            <i class="menu-icon icon-base ti tabler-file-plus"></i> New Record
                        </a>
                    </div>
                    @endcan
            </div>

            </div>

            <div class="card-datatable text-nowrap">
                <table class="table table-bordered table-striped align-middle dt-responsive nowrap" id="record-table">
                    <thead>
                    <tr class="fw-bold fs-3">
                        <th width="2%">ID</th>
                        <th>Item Category</th>
                        <th style="word-wrap: break-word;">Description</th> 
                        <th>Item Group</th>
                        <th>Status</th>
                        <th width="10%">Record Date</th>
                        <th width="10%">Created By</th>
                        <th width="3%">Actions</th>
                    </tr>
                    </thead>
                </table>
                <br/><br/>
            </div>

      </div>
    </div>
    <!-- view record table end -->
    




    <!-- view record modal start -->
    <div class="modal modal-lg fade animate__fadeInDownBig" id="viewRecordModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold fs-5" id="viewRecordModalTitle">RECORD FOR 
                        <span class="text text-primary" id="record_header_view" style="text-transform:uppercase;"></span> 
                        CATEGORY TYPE
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="accordion mt-4" id="accordionWithIcon">

                            <div class="accordion-item active">
                                <h2 class="accordion-header d-flex align-items-center">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                    <i class="icon-base ti tabler-file-text me-2"></i>
                                    Item Category
                                </button>
                                </h2>

                                <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                <div class="accordion-body" id="item_category_view"></div>
                                </div>
                            </div>

                            <div class="accordion-item active">
                                <h2 class="accordion-header d-flex align-items-center">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-2" aria-expanded="true">
                                    <i class="icon-base ti tabler-file-info me-2"></i>
                                    Description
                                </button>
                                </h2>
                                <div id="accordionWithIcon-2" class="accordion-collapse collapse show">
                                <div class="accordion-body" id="description_view"></div>
                                </div>
                            </div>

                            <div class="accordion-item active">
                                <h2 class="accordion-header d-flex align-items-center">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-2" aria-expanded="true">
                                    <i class="icon-base ti tabler-file-info me-2"></i>
                                    Item Group
                                </button>
                                </h2>
                                <div id="accordionWithIcon-2" class="accordion-collapse collapse show">
                                <div class="accordion-body" id="group_view"></div>
                                </div>
                            </div>


                            <div class="accordion-item active">
                                <h2 class="accordion-header d-flex align-items-center">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-2" aria-expanded="true">
                                    <i class="icon-base ti tabler-file-info me-2"></i>
                                    Status
                                </button>
                                </h2>
                                <div id="accordionWithIcon-2" class="accordion-collapse collapse show">
                                <div class="accordion-body" id="is_active_view"></div>
                                </div>
                            </div>


                            <!-- <div class="accordion-item active">
                                <h2 class="accordion-header d-flex align-items-center">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                    <i class="icon-base ti tabler-file-text me-2"></i>
                                    Category
                                </button>
                                </h2>

                                <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                <div class="accordion-body" id="category_view"></div>
                                </div>
                            </div>


                            <div class="accordion-item active">
                                <h2 class="accordion-header d-flex align-items-center">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                    <i class="icon-base ti tabler-file-text me-2"></i>
                                    Category Type
                                </button>
                                </h2>

                                <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                <div class="accordion-body" id="category_type_view"></div>
                                </div>
                            </div> -->

                        </div>

                    </div>
                
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <!-- view record modal end -->





    <!-- edit record modal start -->
    <div class="modal modal-lg fade animate__fadeInDownBig" id="editRecordModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold fs-5" id="editRecordModalTitle">UPDATE 
                        <span class="text text-primary" id="record_header_edit" style="text-transform:uppercase;"></span> 
                        ITEM CATEGORY RECORD
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" id="edit-form" nam="edit-form" class="row g-6">

                    <div class="modal-body">
                
                    
                        <div class="row">

                            <input type="hidden" id="item_category_reference_edit" name="item_category_reference" class="form-control" />

                            <div class="col-md-12 form-control-validation">
                                <label class="form-label fs-6" for="item-category">Item Category</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text" id="basic-addon-item-category">
                                        <i class="icon-base ti tabler-file-text"></i>
                                    </span> 
                                    <input type="text" id="item_category_edit" name="item_category" class="form-control fs-6" placeholder="Enter item Category" style="text-transform:capitalize;" />
                                </div> 
                            </div> 

                            <div class="col-md-12 form-control-validation">
                                <br/>
                            </div> 

                            <div class="col-md-12 form-control-validation">
                                <label class="form-label fs-6" for="description">Description</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text" id="basic-addon-description">
                                        <i class="icon-base ti tabler-file-info"></i>
                                    </span>
                                    <textarea id="description_edit" name="description" class="form-control autosize fs-6" placeholder="Describe something about the Item Category..." rows="3" style="text-transform:;" ></textarea>
                                </div>
                            </div>            

                            <div class="col-md-12 form-control-validation">
                                <br/>
                            </div> 
            
                            <div class="col-md-12 form-control-validation">
                                <label class="form-label fs-6" for="group_id">Item Group</label>
                                <div class="input-group input-group-merge">                    
                                    
                                    <select id="group_id_edit" name="group_id" class="select2 form-select fs-6" style="text-transform:capitalize;">
                                        <option value="">Select Item Group</option>
                                        @foreach($groups as $group)
                                            <option value="{{$group->id}}">{{$group->group}}</option>
                                        @endforeach
                                                                
                                    </select>

                                </div> 
                            </div>

                            <div class="col-md-12 form-control-validation">
                                <br/>
                            </div> 
            
                            <div class="col-md-12 form-control-validation">
                                <label class="form-label fs-6" for="is_active_edit">Status</label>
                                <div class="input-group input-group-merge">                    
                                    
                                    <select id="is_active_edit" name="is_active" class="select2 w-100 fs-6" data-style="btn-default" style="text-transform:capitalize;">
                                        <option value="">Choose Status</option>    
                                        <option value="1">Enabled</option>
                                        <option value="0">Disabled</option>
                                                                    
                                    </select>

                                </div> 
                            </div>


                            <!-- <div class="col-md-12 p-3">
                                
                                <label class="form-label fs-6" for="is_active_edit">Status</label>
                                <br/>
                                
                                <label class="switch">
                                    <input type="checkbox" class="switch-input" />
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on">
                                        <i class="icon-base ti tabler-check"></i>
                                        </span>
                                        <span class="switch-off">
                                        <i class="icon-base ti tabler-x"></i>
                                        </span>
                                    </span>
                                    <span class="switch-label">Enabled</span>
                                </label>

                            </div> -->

              
                        </div>
            
                    </div>

                    <div class="modal-footer">

                        <button type="submit" id="edit-btn" name="edit-btn" class="btn btn-success button-prevent-multiple-submits float-end">Update Record</button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- edit record modal end -->




    <!-- add record modal start -->
    <div class="modal modal-lg fade animate__fadeInDownBig" id="addRecordModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
        
                <div class="modal-header">
                    <h5 class="modal-title fw-bold fs-5" id="addRecordModalTitle">ADD 
                        <span class="text text-primary" id="record_header" style="text-transform:uppercase;">NEW</span> 
                        ITEM CATEGORY RECORD
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" id="add-form" nam="add-form" class="row g-6">

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12 form-control-validation">
                                <label class="form-label fs-6" for="category-type">Item Category</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text" id="basic-addon-category-type">
                                        <i class="icon-base ti tabler-file-text"></i>
                                    </span> 
                                    <input type="text" id="item_category" name="item_category" class="form-control fs-6" placeholder="Enter Item Category" style="text-transform:capitalize;" />
                                </div> 
                            </div> 

                            <div class="col-md-12 form-control-validation">
                                <br/>
                            </div> 

                            <div class="col-md-12 form-control-validation">
                                <label class="form-label fs-6" for="description">Description</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text" id="basic-addon-description">
                                        <i class="icon-base ti tabler-file-info"></i>
                                    </span>
                                    <textarea id="description" name="description" class="form-control autosize fs-6" placeholder="Describe something about the item Category..." rows="3" style="text-transform:capitalize;" ></textarea>
                                </div>
                            </div> 
                            
                            <div class="col-md-12 form-control-validation">
                                <br/>
                            </div>
            
            
                            <div class="col-md-12 form-control-validation">
                                <label class="form-label fs-6" for="group_id">Item Group</label>
                                <div class="input-group input-group-merge">                    
                                    
                                    <select id="group_id" name="group_id" class="select2 form-select fs-6" style="text-transform:capitalize;">
                                        <option value="">Select Item Group</option>
                                        @foreach($groups as $group)
                                            <option value="{{$group->id}}">{{$group->group}}</option>
                                        @endforeach
                                                                
                                    </select>

                                </div> 
                            </div>

                            <div class="col-md-12 form-control-validation">
                                <br/>
                            </div>

              
                        </div>
            
                    </div>

                    <!-- <hr class="my-12" /> -->
 
                    <div class="modal-footer">

                        <button type="submit" id="add-btn" name="add-btn" class="btn btn-success button-prevent-multiple-submits float-end">Add Record</button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- add record modal end -->



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
    
        $('#group_id').select2({

            "placeholder": "Select Item Group",
            "dropdownParent": $("#addRecordModal"),

        });

        $('#group_id_edit').select2({

            "placeholder": "Select Item Group",
            "dropdownParent": $("#editRecordModal"),

        });


        $('#is_active_edit').select2({

            "placeholder": "Choose Status",
            "dropdownParent": $("#editRecordModal"),

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





        //////////////////////////////// DATATABLE INITIALISATION /////////////////////////////////////////////////
        
        var table =  $('#record-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/item-categories",
            columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false},
            { data: 'item_category', name: 'item_categories.item_category'},
            { data: 'description', name: 'item_categories.description'},
            { data: 'group', name: 'groups.group'}, 
            { data: 'is_active', name: 'item_categories.is_active'},                         
            { data: 'created_at', name: 'item_categories.created_at' },
            { data: 'name', name: 'users.name' },
            { data: 'actions', name: 'actions' },
            ]
        });
    

        


        ///////// VIEW RECORD ///////////////////////////////////////////////////////////////////////////////////////

        $(document).on('click', '.record-view-btn', function(){
            var record_id = $(this).attr('id');

            $.ajax({
                url: '/specific-item-category/'+ record_id,
                type: 'GET',
                
                success: function(response) {

                  //console.log(response);

                  $('#record_header_view').text(response.data.item_category);

                  $('#item_category_view').text(response.data.item_category);
                  $('#description_view').text(response.data.description);
                  $('#group_view').text(response.data.group);

                  if(response.data.is_active == 1){
                    $('#is_active_view').text("Enabled");
                  }
                  else{
                    $('#is_active_view').text("Disabled");
                  }
                    
                  $("#viewRecordModal").modal('show');
                                                
                },

                error: function(response) {

                  if(response.status == 422){
                    var firstKey = Object.keys(response.responseJSON.errors)[0];
                    Swal.fire({
                    title: 'Error',
                    text: response.responseJSON.errors[firstKey][0],
                    icon: 'error',
                    toast:'true',
                    showConfirmButton:false,
                    position:'top-end',
                    timer:10000
                    
                  });
                }  
                    
                }

            });

        });






        ///////////////// ADD RECORD ////////////////////////////////////////////////////////

        $("#add-form").validate({

            //ignore: null,   

            // rules: {
            //     record:{ required:true },
            // },
            // messages: {
            //     record:"Record is required",
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

                    url: '/add-item-category',
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
                            //text: 'Record updated successfully',
                            text: response.message,
                            icon: 'success',
                            toast:'true',
                            showConfirmButton:false,
                            position:'top-end',
                            //background: "#FCFCFC",
                            timer:5000
                            
                        }).then(function() {

                            //window.location = "/item-categories";
                            table.ajax.reload();

                        });
                    
                        $('.button-prevent-multiple-submits').attr('disabled', false);
                        $('#add-btn').text('Add record');
                        $("#addRecordModal").modal('hide');
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
        
                        else if(response.status == 500){

                        }
                        else if(response.status == 404){

                            Swal.fire({
                                 title: '<span class="text text-danger fw-bold">ERROR MESSAGE</span>',
                                text: response.responseJSON.message,
                                icon: 'error',
                                toast:'true',
                                showConfirmButton:false,
                                position:'top-end',
                                timer:5000
                                
                            });

                        }
                        else if(response.status == 403){

                            Swal.fire({
                                 title: '<span class="text text-danger fw-bold">ERROR MESSAGE</span>',
                                text: response.responseJSON.message,
                                icon: 'error',
                                toast:'true',
                                showConfirmButton:false,
                                position:'top-end',
                                timer:5000
                                
                            });

                        }
                        else if(response.status = 400){

                            //console.log(response);

                            Swal.fire({
                                 title: '<span class="text text-danger fw-bold">ERROR MESSAGE</span>',
                                text: response.responseJSON.message,
                                icon: 'error',
                                toast:'true',
                                showConfirmButton:false,
                                position:'top-end',
                                timer:5000
                                
                            }); 

                        }
                        else{

                        }

                        
                        $('.button-prevent-multiple-submits').attr('disabled', false);
                        $('#add-btn').text('Add Record');
                    }

                });
            }
            
        });
        

        $('#addRecordModal').on('hidden.bs.modal', function (e) {
            
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();

        });


        
        


        ///////// VIEW UPDATE RECORD ////////////////////////////////////////////////////////////////////////////

        $(document).on('click', '.record-edit-btn', function(){
            var record_id = $(this).attr('id');
            
              $.ajax({
                url: '/edit-item-category/'+ record_id,
                type: 'GET',
                
                success: function(response) {

                    //console.log(response);

                    $('#record_header_edit').text(response.data.item_category);

                    $('#item_category_reference_edit').val(response.data.item_category_reference);
                    $('#item_category_edit').val(response.data.item_category);
                    $('#description_edit').val(response.data.description);                    
                    $('#group_id_edit').val(response.data.group_id).trigger('change');
                    $('#is_active_edit').val(response.data.is_active).trigger('change');              

                    // $('#is_active_edit').text(response.data.group_id);
                    // var selected_value = $('#is_active_edit').val();
                    // var selected_text = $('#is_active_edit :selected').text();                
                    // $('#is_active_edit').val(selected_value).trigger('change');
                        
                    $('#editRecordModal').modal('show');
                                                
                },

                error: function(response) {

                  if(response.status == 422){
                    var firstKey = Object.keys(response.responseJSON.errors)[0];
                    Swal.fire({
                    title: 'Error',
                    text: response.responseJSON.errors[firstKey][0],
                    icon: 'error',
                    toast:'true',
                    showConfirmButton:false,
                    position:'top-end',
                    timer:10000
                    
                  });
                }  
                    
                }

            });

           

        });






        ///////////////// EDIT RECORD ////////////////////////////////////////////////////////

        $("#edit-form").validate({

            //ignore: null,   

            // rules: {
            //     record:{ required:true },
            // },
            // messages: {
            //     record:"Record is required",
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

                    url: '/edit-item-category',
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,

                    beforeSend:function(){

                        $('#edit-btn').text('Processing...');

                    },

                    success: function(response) {

                        //console.log(response);

                        Swal.fire({
                            title: '<span class="text text-success fw-bold">SUCCESS MESSAGE</span>',
                            //text: 'Program updated successfully',
                            text: response.message,
                            icon: 'success',
                            toast:'true',
                            showConfirmButton:false,
                            position:'top-end',
                            //background: "#FCFCFC",
                            timer:5000
                            
                        }).then(function() {

                            //window.location = "/item-categories";
                            table.ajax.reload();

                        });
                    
                        $('.button-prevent-multiple-submits').attr('disabled', false);
                        $('#edit-btn').text('Update record');
                        $("#editRecordModal").modal('hide');
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
        
                        else if(response.status == 500){

                        }
                        else if(response.status == 404){

                            Swal.fire({
                                 title: '<span class="text text-danger fw-bold">ERROR MESSAGE</span>',
                                text: response.responseJSON.message,
                                icon: 'error',
                                toast:'true',
                                showConfirmButton:false,
                                position:'top-end',
                                timer:5000
                                
                            });

                        }
                        else if(response.status == 403){

                            Swal.fire({
                                 title: '<span class="text text-danger fw-bold">ERROR MESSAGE</span>',
                                text: response.responseJSON.message,
                                icon: 'error',
                                toast:'true',
                                showConfirmButton:false,
                                position:'top-end',
                                timer:5000
                                
                            });

                        }
                        else if(response.status = 400){

                            //console.log(response);

                            Swal.fire({
                                 title: '<span class="text text-danger fw-bold">ERROR MESSAGE</span>',
                                text: response.responseJSON.message,
                                icon: 'error',
                                toast:'true',
                                showConfirmButton:false,
                                position:'top-end',
                                timer:5000
                                
                            }); 

                        }
                        else{

                        }

                        
                        $('.button-prevent-multiple-submits').attr('disabled', false);
                        $('#edit-btn').text('Update Record');
                    }

                });
            }
            
        });
        

        $('#editRecordModal').on('hidden.bs.modal', function (e) {
            
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();

        });





        ///////// DELETE RECORD /////////////////////////////////////////////////////////////////
        $(document).on('click', '.record-del-btn', function() {
            var record_id = $(this).attr('id');
            // console.log(id);

            Swal.fire({
                title: '<span class="text text-warning fw-bold">Are you sure?</span>',
                text: "Record will be deleted",
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
                    url: '/delete-item-category/'+ record_id,

                        success:function(response){

                            Swal.fire(
                                '<span class="text text-success fw-bold">SUCCESS MESSAGE</span>',
                                'Record has been deleted.',
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