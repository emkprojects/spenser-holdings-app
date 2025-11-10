@extends('layouts.admin', ['title' => 'View Customer'])

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

      
        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
            <div class="flex-grow-1 container-p-y">

                <div class="row">


                    <!-- customer Sidebar -->
                    <div class="col-xl-4 col-lg-5 order-1 order-md-0">


                    <!-- customer Card -->
                    <div class="card mb-6">
                        <div class="card-body pt-12">

                        <div class="customer-avatar-section">
                            <div class=" d-flex align-items-center flex-column">
                            <img class="img-fluid rounded mb-4" src="../../assets/img/avatars/2.png" height="120" width="120" alt="customer avatar" />
                            <div class="customer-info text-center">
                                <h5 class="fs-4">{{ $customer->customer }}</h5>
                                <span class="badge bg-label-secondary fs-5">{{ $customer->position }}</span>
                            </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-around flex-wrap my-6 gap-0 gap-md-3 gap-lg-4">

                            <div class="d-flex align-items-center me-5 gap-4">

                                <div class="avatar">
                                    <div class="avatar-initial bg-label-primary rounded">
                                    <i class="icon-base ti tabler-checkbox icon-lg"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-0">+100</h5>
                                    <span>Products</span>
                                </div>

                            </div>

                            <div class="d-flex align-items-center gap-4">

                                <div class="avatar">
                                    <div class="avatar-initial bg-label-primary rounded">
                                    <i class="icon-base ti tabler-shopping-cart icon-lg"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-0">+200M</h5>
                                    <span>Purchases</span>
                                </div>

                            </div>

                        </div>


                        <h5 class="pb-4 border-bottom mb-4">INFORMATION</h5>
                        <div class="info-container">

                            <div class="accordion mt-4" id="accordionWithIcon">

                                <div class="accordion-item active">
                                    <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                        <i class="icon-base ti tabler-file-text me-2"></i>
                                        TIN
                                    </button>
                                    </h2>

                                    <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                        @if($customer->tax_identification_number)
                                            <div class="accordion-body" id="">{{ $customer->tax_identification_number }}</div>
                                        @else
                                            <div class="accordion-body" id="">...</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="accordion-item active">
                                    <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                        <i class="icon-base ti tabler-file-text me-2"></i>
                                        NIN
                                    </button>
                                    </h2>

                                    <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                        @if($customer->national_identification_number)
                                            <div class="accordion-body" id="">{{ $customer->national_identification_number }}</div>
                                        @else
                                            <div class="accordion-body" id="">...</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="accordion-item active">
                                    <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                        <i class="icon-base ti tabler-file-text me-2"></i>
                                        Next Birth Date is in...
                                    </button>
                                    </h2>

                                    <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                        <div class="accordion-body" id="">200 Days</div>
                                    </div>
                                </div>

                                <div class="accordion-item active">
                                    <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                        <i class="icon-base ti tabler-file-text me-2"></i>
                                        Customer Contact is around
                                    </button>
                                    </h2>

                                    <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                        <div class="accordion-body" id="">25 Years old</div>
                                    </div>
                                </div>

                                <div class="accordion-item active">
                                    <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                        <i class="icon-base ti tabler-file-text me-2"></i>
                                        Started buying on...
                                    </button>
                                    </h2>

                                    <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                        <div class="accordion-body" id="">{{ date("l F d, Y", strtotime($customer->created_at)) }}</div>
                                    </div>
                                </div>


                                <div class="accordion-item active">
                                    <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                        <i class="icon-base ti tabler-file-text me-2"></i>
                                        Has been buying for ...
                                    </button>
                                    </h2>

                                    <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                        <div class="accordion-body" id="">3 Years now</div>
                                    </div>
                                </div>


                            </div>
                            <br/><br/>
                            <br/><br/>
                            <br/><br/>
                            <br/><br/>

                            <!-- <ul class="list-unstyled mb-6">
                                <li class="mb-2">
                                    <span class="h6">customername:</span>
                                    <span>@violet.dev</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Email:</span>
                                    <span>vafgot@vultukir.org</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Status:</span>
                                    <span>Active</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Role:</span>
                                    <span>Author</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Tax id:</span>
                                    <span>Tax-8965</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Contact:</span>
                                    <span>(123) 456-7890</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Languages:</span>
                                    <span>French</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Country:</span>
                                    <span>England</span>
                                </li>
                            </ul> -->

                            <div class="d-flex justify-content-center">
                                <a href="javascript:;" class="btn btn-primary me-4" data-bs-target="#editcustomer" data-bs-toggle="modal">
                                    <i class="icon-base ti tabler-phone"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-success me-4" data-bs-target="#editcustomer" data-bs-toggle="modal">
                                    <i class="icon-base ti tabler-mail"></i>
                                </a>
                                <!-- <a href="javascript:;" class="btn btn-label-danger suspend-customer">Suspend</a> -->
                            </div>

                        </div>
                        </div>
                    </div>
                    <!-- /customer Card -->


                    <!-- Plan Card -->
                    <!-- <div class="card mb-6 border border-2 border-primary rounded primary-shadow">
                        <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <span class="badge bg-label-primary">Standard</span>
                            <div class="d-flex justify-content-center">
                            <sub class="h5 pricing-currency mb-auto mt-1 text-primary">$</sub>
                            <h1 class="mb-0 text-primary">99</h1>
                            <sub class="h6 pricing-duration mt-auto mb-3 fw-normal">month</sub>
                            </div>
                        </div>
                        <ul class="list-unstyled g-2 my-6">
                            <li class="mb-2 d-flex align-items-center"><i class="icon-base ti tabler-circle-filled icon-10px text-secondary me-2"></i><span>10 customers</span></li>
                            <li class="mb-2 d-flex align-items-center"><i class="icon-base ti tabler-circle-filled icon-10px text-secondary me-2"></i><span>Up to 10 GB storage</span></li>
                            <li class="mb-2 d-flex align-items-center"><i class="icon-base ti tabler-circle-filled icon-10px text-secondary me-2"></i><span>Basic Support</span></li>
                        </ul>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="h6 mb-0">Days</span>
                            <span class="h6 mb-0">26 of 30 Days</span>
                        </div>
                        <div class="progress mb-1 bg-label-primary" style="height: 6px;">
                            <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small>4 days remaining</small>
                        <div class="d-grid w-100 mt-6">
                            <button class="btn btn-primary" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">Upgrade Plan</button>
                        </div>
                        </div>
                    </div> -->
                    <!-- /Plan Card -->


                    </div>
                    <!--/ customer Sidebar -->

                    <!-- customer Content -->
                    <div class="col-xl-8 col-lg-7 order-0 order-md-1">

                    <!-- customer Pills -->
                    <div class="nav-align-top">
                        <ul class="nav nav-pills flex-column flex-md-row flex-wrap mb-6 row-gap-2">
                            <li class="nav-item">
                                <a class="nav-link active" href="javascript:void(0);"><i class="icon-base ti tabler-user-check icon-sm me-1_5"></i>Account</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);"><i class="icon-base ti tabler-building-warehouse  icon-sm me-1_5"></i>Productions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);"><i class="icon-base ti tabler-shopping-cart icon-sm me-1_5"></i>Orders</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);"><i class="icon-base ti tabler-cash icon-sm me-1_5"></i>Purchases</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);"><i class="icon-base ti tabler-settings icon-sm me-1_5"></i>Settings</a>
                            </li>
                        </ul>
                    </div>
                    <!--/ customer Pills -->



                    <!-- Project table -->
                    <!-- <div class="card mb-6">
                        <div class="table-responsive mb-4">
                        
                        </div>
                    </div> -->
                    <!-- /Project table -->

                    <!-- Activity Timeline -->
                    <div class="card mb-6">

                        <!-- <h5 class="card-header">MY INFO</h5> -->

                        <div class="card-body pt-1">

                            <div class="accordion mt-4" id="accordionWithIcon">

                                <div class="accordion-item active">
                                    <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                        <i class="icon-base ti tabler-file-text me-2"></i>
                                        Customer Phone
                                    </button>
                                    </h2>

                                    <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                        <div class="accordion-body" id="">+{{ $customer->phone_number }}</div>
                                    </div>
                                </div>


                                <div class="accordion-item active">
                                    <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                        <i class="icon-base ti tabler-file-text me-2"></i>
                                        Customer Email
                                    </button>
                                    </h2>

                                    <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                        <div class="accordion-body" id="">{{ $customer->email_address }}</div>
                                    </div>
                                </div>


                                <div class="accordion-item active">
                                    <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                        <i class="icon-base ti tabler-file-text me-2"></i>
                                        Customer Address
                                    </button>
                                    </h2>

                                    <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                        <div class="accordion-body" id="">{{ $customer->physical_address }}</div>
                                    </div>
                                </div> 
                                                               
                                
                                <div class="accordion-item active">
                                    <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                        <i class="icon-base ti tabler-file-text me-2"></i>
                                        Customer Status
                                    </button>
                                    </h2>

                                    <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                        @if($customer->is_active == 1)
                                            <div class="accordion-body" id="">Active</div>
                                        @else
                                            <div class="accordion-body" id="">Inactive</div>
                                        @endif
                                    </div>
                                </div>

                               
                                <div class="accordion-item active">
                                    <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                        <i class="icon-base ti tabler-file-text me-2"></i>
                                        Contact Full Name
                                    </button>
                                    </h2>

                                    <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                        <div class="accordion-body" id="">{{ $customer->contact_first_name }} {{ $customer->contact_last_name }} {{ $customer->contact_other_name }}</div>
                                    </div>
                                </div>

                                <div class="accordion-item active">
                                    <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                        <i class="icon-base ti tabler-file-text me-2"></i>
                                        Contact Email Address
                                    </button>
                                    </h2>

                                    <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                        <div class="accordion-body" id="">{{ $customer->contact_email_address }}</div>
                                        @if($customer->contact_alternative_email)
                                            <div class="accordion-body" id="">{{ $customer->contact_alternative_email }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="accordion-item active">
                                    <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                        <i class="icon-base ti tabler-file-text me-2"></i>
                                        Contact Mobile Number
                                    </button>
                                    </h2>

                                    <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                        <div class="accordion-body" id="">+{{ $customer->contact_phone_number }}</div>
                                        @if($customer->contact_alternative_phone)
                                            <div class="accordion-body" id="">+{{ $customer->contact_alternative_phone }}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="accordion-item active">
                                    <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                        <i class="icon-base ti tabler-file-text me-2"></i>
                                        Contact Current Position
                                    </button>
                                    </h2>

                                    <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                        <div class="accordion-body" id="">{{ $customer->position }}</div>
                                    </div>
                                </div>

                                <div class="accordion-item active">
                                    <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                        <i class="icon-base ti tabler-file-text me-2"></i>
                                       Contact Date of Birth
                                    </button>
                                    </h2>

                                    <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                        <div class="accordion-body" id="">{{ date("l F d, Y", strtotime($customer->contact_date_of_birth)) }}</div>
                                    </div>
                                </div>

                                <div class="accordion-item active">
                                    <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                        <i class="icon-base ti tabler-file-text me-2"></i>
                                        Contact Gender
                                    </button>
                                    </h2>

                                    <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                        <div class="accordion-body" id="">{{ ucwords($customer->contact_gender) }}</div>
                                    </div>
                                </div>


                                <div class="accordion-item active">
                                    <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                        <i class="icon-base ti tabler-file-text me-2"></i>
                                        Contact Physical Address
                                    </button>
                                    </h2>

                                    <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                        <div class="accordion-body" id="">{{ ucwords($customer->contact_physical_address) }}</div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- /Activity Timeline -->

                    <!-- Invoice table -->
                    <!-- <div class="card mb-4">
                        <div class="card-datatable table-responsive">
                        <table class="table datatable-invoice">
                            <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Issued Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
                        </div>
                    </div> -->
                    <!-- /Invoice table -->

                    </div>
                    <!--/ customer Content -->
                </div>

                <!-- Modal -->
                <!-- Edit customer Modal -->
                <div class="modal fade" id="editcustomer" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-simple modal-edit-customer">
                    <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-6">
                        <h4 class="mb-2">Edit customer Information</h4>
                        <p>Updating customer details will receive a privacy audit.</p>
                        </div>
                        <form id="editcustomerForm" class="row g-6" onsubmit="return false">
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditcustomerFirstName">First Name</label>
                            <input type="text" id="modalEditcustomerFirstName" name="modalEditcustomerFirstName" class="form-control" placeholder="John" value="John" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditcustomerLastName">Last Name</label>
                            <input type="text" id="modalEditcustomerLastName" name="modalEditcustomerLastName" class="form-control" placeholder="Doe" value="Doe" />
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalEditcustomerName">customername</label>
                            <input type="text" id="modalEditcustomerName" name="modalEditcustomerName" class="form-control" placeholder="johndoe007" value="johndoe007" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditcustomerEmail">Email</label>
                            <input type="text" id="modalEditcustomerEmail" name="modalEditcustomerEmail" class="form-control" placeholder="example@domain.com" value="example@domain.com" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditcustomerStatus">Status</label>
                            <select id="modalEditcustomerStatus" name="modalEditcustomerStatus" class="select2 form-select" aria-label="Default select example">
                            <option selected>Status</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                            <option value="3">Suspended</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditTaxID">Tax ID</label>
                            <input type="text" id="modalEditTaxID" name="modalEditTaxID" class="form-control modal-edit-tax-id" placeholder="123 456 7890" value="123 456 7890" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditcustomerPhone">Phone Number</label>
                            <div class="input-group">
                            <span class="input-group-text">US (+1)</span>
                            <input type="text" id="modalEditcustomerPhone" name="modalEditcustomerPhone" class="form-control phone-number-mask" placeholder="202 555 0111" value="202 555 0111" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditcustomerLanguage">Language</label>
                            <select id="modalEditcustomerLanguage" name="modalEditcustomerLanguage" class="select2 form-select" multiple>
                            <option value="">Select</option>
                            <option value="english" selected>English</option>
                            <option value="spanish">Spanish</option>
                            <option value="french">French</option>
                            <option value="german">German</option>
                            <option value="dutch">Dutch</option>
                            <option value="hebrew">Hebrew</option>
                            <option value="sanskrit">Sanskrit</option>
                            <option value="hindi">Hindi</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditcustomerCountry">Country</label>
                            <select id="modalEditcustomerCountry" name="modalEditcustomerCountry" class="select2 form-select" data-allow-clear="true">
                            <option value="">Select</option>
                            <option value="Australia">Australia</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Canada">Canada</option>
                            <option value="China">China</option>
                            <option value="France">France</option>
                            <option value="Germany">Germany</option>
                            <option value="India" selected>India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Japan">Japan</option>
                            <option value="Korea">Korea, Republic of</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Russia">Russian Federation</option>
                            <option value="South Africa">South Africa</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="editBillingAddress" />
                            <label for="editBillingAddress" class="switch-label">Use as a billing address?</label>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-3">Submit</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
                </div>
                <!--/ Edit customer Modal -->

                <!-- Add New Credit Card Modal -->
                <div class="modal fade" id="upgradePlanModal" tabindex="-1" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
                    <div class="modal-content">
                    <div class="modal-body p-4">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-6">
                        <h2>Upgrade Plan</h2>
                        <p class="text-body-secondary">Choose the best plan for customer.</p>
                        </div>
                        <form id="upgradePlanForm" class="row g-4" onsubmit="return false">
                        <div class="col-sm-9">
                            <label class="form-label" for="choosePlan">Choose Plan</label>
                            <select id="choosePlan" name="choosePlan" class="form-select" aria-label="Choose Plan">
                            <option selected>Choose Plan</option>
                            <option value="standard">Standard - $99/month</option>
                            <option value="exclusive">Exclusive - $249/month</option>
                            <option value="Enterprise">Enterprise - $499/month</option>
                            </select>
                        </div>
                        <div class="col-sm-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">Upgrade</button>
                        </div>
                        </form>
                    </div>
                    <hr class="mx-md-n5 mx-n3" />
                    <div class="modal-body">
                        <h6 class="mb-0">customer current plan is standard plan</h6>
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="d-flex justify-content-center me-2 mt-1">
                            <sup class="h6 pricing-currency pt-1 mt-2 mb-0 me-1 text-primary">$</sup>
                            <h1 class="mb-0 text-primary">99</h1>
                            <sub class="pricing-duration mt-auto mb-5 pb-1 small text-body">/month</sub>
                        </div>
                        <button class="btn btn-label-danger cancel-subscription">Cancel Subscription</button>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!--/ Add New Credit Card Modal -->

                <!-- /Modal -->
        </div>
        <!-- / Content -->

                        


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


        });

    </script>
    <!-- end script -->

@endpush