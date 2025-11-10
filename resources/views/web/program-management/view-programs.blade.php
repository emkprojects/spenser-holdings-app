@extends('layouts.admin', ['title' => 'View Programs'])

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
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/flatpickr/flatpickr.css') }}" />    -->

    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.5/css/responsive.bootstrap5.min.css" />

   

@endpush

@section('content')


    <!-- table start -->
    <div class="row">
      <div class="card">

        <div class="card-header">

          <div class="row">
            <div class="col-xl-10">
              <h4 class="pb-0 mt-1 text-md-start text-center fw-bold">All Programs</h4>
            </div>

            <div class="col-xl-2 float:right;">
              <a href="/add-program" class="btn btn-primary">
                <i class="menu-icon icon-base ti tabler-file-plus"></i> New Program
              </a>
            </div>
          </div>

        </div>

        <div class="card-datatable text-nowrap">
          <table class="table table-bordered table-striped align-middle dt-responsive nowrap" id="program-record">
            <thead>
              <tr class="fw-bold fs-3">
                <th width="2%">ID</th>
                <th>Program</th>
                <th style="word-wrap: break-word;">Description</th>                
                <th>Program Date</th>
                <th>Created By</th>
                <th width="3%">Actions</th>
              </tr>
            </thead>
          </table>
          <br/><br/>
        </div>

      </div>
    </div>
    <!-- table end -->
    


    <!-- view record modal start -->
    <div class="modal modal-lg fade animate__fadeInDownBig" id="viewRecordModal" data-bs-backdrop="static" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title fw-bold fs-5" id="viewRecordModalTitle">RECORD FOR <span class="text text-primary" id="record_header_view"></span> PROGRAM</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">

          <div class="row">

            <!-- <div class="demo-inline-spacing mt-4">
              <ul class="list-group">
                <li class="list-group-item d-flex align-items-center">                  
                  <div class="col-md-4 fw-bold fs-5">
                    <i class="icon-base ti tabler-file-text icon-md me-3"></i>PROGRAM
                  </div> 
                  <div class="col-md-8" id="program_view"></div>
                </li>
                <li class="list-group-item d-flex align-items-center">
                  <div class="col-md-4 fw-bold fs-5">
                    <i class="icon-base ti tabler-file-info icon-md me-3"></i>DESCRIPTION
                  </div> 
                  <div class="col-md-8" id="description_view"></div>
                </li>
              </ul>
            </div> -->


            <div class="accordion mt-4" id="accordionWithIcon">

              <div class="accordion-item active">
                <h2 class="accordion-header d-flex align-items-center">
                  <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                    <i class="icon-base ti tabler-file-text me-2"></i>
                    Program
                  </button>
                </h2>

                <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                  <div class="accordion-body" id="program_view"></div>
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

        <form method="POST" id="edit-form" nam="edit-form" class="row g-6">

        <div class="modal-header">
          <h5 class="modal-title fw-bold fs-5" id="editRecordModalTitle">UPDATE <span class="text text-primary" id="record_header_edit"></span> PROGRAM RECORD</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">

          <div class="row">

            <input type="hidden" id="program_reference_edit" name="program_reference" class="form-control" />

            <div class="col-md-12 form-control-validation">
                <label class="form-label" for="program">Program</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text" id="basic-addon-program">
                        <i class="icon-base ti tabler-file-text"></i>
                    </span> 
                    <input type="text" id="program_edit" name="program" class="form-control" placeholder="Enter Program" style="text-transform:capitalize;" />
                </div> 
            </div> 

            <div class="col-md-12 form-control-validation">
                <label class="form-label" for="description">Description</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text" id="basic-addon-description">
                        <i class="icon-base ti tabler-file-info"></i>
                    </span>
                    <textarea id="description_edit" name="description" class="form-control autosize" placeholder="Describe something about the Program..." rows="3" style="text-transform:capitalize;" ></textarea>
                </div>
            </div>          
              
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




 

    <!-- <hr class="my-12" /> -->
@endsection

@push('scripts')

    <!-- <script src="{{ asset('/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('/assets/js/tables-datatables-advanced.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script> -->

    <!-- Vendors JS -->
    <script src="{{ asset('/assets/vendor/libs/select2/select2.js') }}"></script>
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
    <!--
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> -->

    <!-- sweetalert2 scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function() {

          ///////////////////////////AJAX CSRF SET UP ///////////////////////////////////////
          $.ajaxSetup({
              headers: {
              //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
              'X-CSRF-TOKEN': "{{csrf_token()}}",
              }
          });

          ////////////////////////////////DATATABLE INITIALISATION ///////////////////////////
          
          var table =  $('#program-record').DataTable({
                          processing: true,
                          serverSide: true,
                          ajax: "/view-programs",
                          columns: [
                            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false},
                            { data: 'program', name: 'programs.program'},
                            { data: 'description', name: 'programs.description'},
                            { data: 'created_at', name: 'programs.created_at' },
                            { data: 'name', name: 'users.name' },
                            { data: 'actions', name: 'actions' },
                          ]
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

        $("#edit-form").validate({

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

                    url: '/edit-program',
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

                            window.location = "/view-programs";

                        });
                    
                        $('.button-prevent-multiple-submits').attr('disabled', false);
                        $('#edit-btn').text('Update Program');
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
                        $('#edit-btn').text('Update Program');
                    }

                });
            }
            
        });


        ///////// VIEW RECORD /////////////////////////////////////////////////////////////////
        $(document).on('click', '.record-edit-btn', function(){
            var record_id = $(this).attr('id');
            
              $.ajax({
                url: '/specific-program/'+ record_id,
                type: 'GET',
                
                success: function(response) {

                  console.log(response);

                  $('#record_header_edit').text(response.data.program);
                
                  $('#program_reference_edit').val(response.data.program_reference);
                  $('#program_edit').val(response.data.program);
                  $('#description_edit').html(response.data.description);
                    
                  $("#editRecordModal").modal('show');
                                                
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


        ///////// VIEW RECORD /////////////////////////////////////////////////////////////////
        $(document).on('click', '.record-view-btn', function(){
            var record_id = $(this).attr('id');

            $.ajax({
                url: '/specific-program/'+ record_id,
                type: 'GET',
                
                success: function(response) {

                  console.log(response);

                  $('#record_header_view').text(response.data.program);

                  $('#program_view').text(response.data.program);
                  $('#description_view').text(response.data.description);
                    
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
                        url: '/delete-program/'+ record_id,

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