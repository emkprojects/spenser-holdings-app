@extends('layouts.admin', ['title' => 'Dashboard'])

@push('stylesheets')

@endpush

@section('content')
   
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row g-6">

                <!-- Card Border Shadow -->
                <div class="col-lg-3 col-sm-6">
                <div class="card card-border-shadow-primary h-100">
                    <div class="card-body">
                    <div class="d-flex align-items-center mb-1">
                        <div class="avatar me-4">
                        <span class="avatar-initial rounded bg-label-primary">
                            <i class="icon-base ti tabler-shopping-cart icon-28px"></i></span>
                        </div>
                        <h4 class="mb-0">200M</h4>
                    </div>
                    <p class="mb-1">Sales</p>
                    <p class="mb-0">
                        <span class="text-heading fw-medium me-2">+5.5M</span>
                        <small class="text-body-secondary">this week</small>
                    </p>
                    </div>
                </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                <div class="card card-border-shadow-warning h-100">
                    <div class="card-body">
                    <div class="d-flex align-items-center mb-1">
                        <div class="avatar me-4">
                        <span class="avatar-initial rounded bg-label-warning">
                           <i class="icon-base ti tabler-shopping-cart icon-28px"></i></span>
                        </div>
                        <h4 class="mb-0">200M</h4>
                    </div>
                    <p class="mb-1">Sales</p>
                    <p class="mb-0">
                        <span class="text-heading fw-medium me-2">+5.5M</span>
                        <small class="text-body-secondary">this week</small>
                    </p>
                    </div>
                </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                <div class="card card-border-shadow-danger h-100">
                    <div class="card-body">
                    <div class="d-flex align-items-center mb-1">
                        <div class="avatar me-4">
                        <span class="avatar-initial rounded bg-label-danger">
                          <i class="icon-base ti tabler-shopping-cart icon-28px"></i></span>
                        </div>
                        <h4 class="mb-0">200M</h4>
                    </div>
                    <p class="mb-1">Sales</p>
                    <p class="mb-0">
                        <span class="text-heading fw-medium me-2">+5.5M</span>
                        <small class="text-body-secondary">this week</small>
                    </p>
                    </div>
                </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                <div class="card card-border-shadow-info h-100">
                    <div class="card-body">
                    <div class="d-flex align-items-center mb-1">
                        <div class="avatar me-4">
                        <span class="avatar-initial rounded bg-label-info">
                              <i class="icon-base ti tabler-shopping-cart icon-28px"></i></span>
                        </div>
                        <h4 class="mb-0">200M</h4>
                    </div>
                    <p class="mb-1">Sales</p>
                    <p class="mb-0">
                        <span class="text-heading fw-medium me-2">+5.5M</span>
                        <small class="text-body-secondary">this week</small>
                    </p>
                    </div>
                </div>
            </div>
            <!--/ Card Border Shadow -->


                <div class="col-6 col-xl-6 col-md-6">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Top Clients</h5>
                        </div>
                        <div class="dropdown">
                            <button class="btn text-body-secondary p-0" type="button" id="popularInstructors" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-base ti tabler-dots-vertical icon-22px"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="popularInstructors">
                            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            </div>
                        </div>
                        </div>
                        <div class="px-5 py-4 border border-start-0 border-end-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-0 text-uppercase">Clients</p>
                            <p class="mb-0 text-uppercase">Kilograms</p>
                        </div>
                        </div>
                        <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-6">

                            <div class="d-flex align-items-center">
                            <div class="avatar avatar me-4">
                                <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                            </div>

                            <div>
                                <div>
                                <h6 class="mb-0 text-truncate">John Doe</h6>
                                <small class="text-truncate text-body">Meat</small>
                                </div>
                            </div>

                            </div>
                            <div class="text-end">
                            <h6 class="mb-0">200K</h6>
                            </div>

                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-6">

                            <div class="d-flex align-items-center">
                            <div class="avatar avatar me-4">
                                <img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                            </div>

                            <div>
                                <div>
                                <h6 class="mb-0 text-truncate">Jane Doe</h6>
                                <small class="text-truncate text-body">Chicken</small>
                                </div>
                            </div>

                            </div>
                            <div class="text-end">
                            <h6 class="mb-0">10K</h6>
                            </div>

                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-6">
                            <div class="d-flex align-items-center">
                            <div class="avatar avatar me-4">
                                <img src="../../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div>
                                <div>
                                <h6 class="mb-0 text-truncate">George Doe</h6>
                                <small class="text-truncate text-body">Neck</small>
                                </div>
                            </div>
                            </div>
                            <div class="text-end">
                            <h6 class="mb-0">50K</h6>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                            <div class="avatar avatar me-4">
                                <img src="../../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div>
                                <div>
                                <h6 class="mb-0 text-truncate">Lucy Doe</h6>
                                <small class="text-truncate text-body">Pork</small>
                                </div>
                            </div>
                            </div>
                            <div class="text-end">
                            <h6 class="mb-0">12K</h6>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>


                <div class="col-6 col-xl-6 col-md-6">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Top Suppliers</h5>
                        </div>
                        <div class="dropdown">
                            <button class="btn text-body-secondary p-0" type="button" id="popularInstructors" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-base ti tabler-dots-vertical icon-22px"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="popularInstructors">
                            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            </div>
                        </div>
                        </div>
                        <div class="px-5 py-4 border border-start-0 border-end-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-0 text-uppercase">Suppliers</p>
                            <p class="mb-0 text-uppercase">Tons</p>
                        </div>
                        </div>
                        <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-6">

                            <div class="d-flex align-items-center">
                            <div class="avatar avatar me-4">
                                <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                            </div>

                            <div>
                                <div>
                                <h6 class="mb-0 text-truncate">John Doe</h6>
                                <small class="text-truncate text-body">Meat</small>
                                </div>
                            </div>

                            </div>
                            <div class="text-end">
                            <h6 class="mb-0">200K</h6>
                            </div>

                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-6">

                            <div class="d-flex align-items-center">
                            <div class="avatar avatar me-4">
                                <img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                            </div>

                            <div>
                                <div>
                                <h6 class="mb-0 text-truncate">Jane Doe</h6>
                                <small class="text-truncate text-body">Chicken</small>
                                </div>
                            </div>

                            </div>
                            <div class="text-end">
                            <h6 class="mb-0">10K</h6>
                            </div>

                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-6">
                            <div class="d-flex align-items-center">
                            <div class="avatar avatar me-4">
                                <img src="../../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div>
                                <div>
                                <h6 class="mb-0 text-truncate">George Doe</h6>
                                <small class="text-truncate text-body">Neck</small>
                                </div>
                            </div>
                            </div>
                            <div class="text-end">
                            <h6 class="mb-0">50K</h6>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                            <div class="avatar avatar me-4">
                                <img src="../../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div>
                                <div>
                                <h6 class="mb-0 text-truncate">Lucy Doe</h6>
                                <small class="text-truncate text-body">Pork</small>
                                </div>
                            </div>
                            </div>
                            <div class="text-end">
                            <h6 class="mb-0">12K</h6>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>


                <!-- 
                <div class="col-12 col-xl-6 col-md-6">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Top Courses</h5>
                        <div class="dropdown">
                            <button class="btn text-body-secondary p-0" type="button" id="topCourses" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-base ti tabler-dots-vertical icon-lg"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="topCourses">
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Download</a>
                            <a class="dropdown-item" href="javascript:void(0);">View All</a>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex mb-6 align-items-center">
                            <div class="avatar flex-shrink-0 me-4">
                                <span class="avatar-initial rounded bg-label-primary"><i class="icon-base ti tabler-video icon-lg"></i></span>
                            </div>
                            <div class="row w-100 align-items-center">
                                <div class="col-sm-8 col-md-12 col-xxl-8 mb-1 mb-sm-0 mb-md-1 mb-xxl-0">
                                <h6 class="mb-0">Gender Based Voilence</h6>
                                </div>
                                <div class="col-sm-4 col-md-12 col-xxl-4 d-flex justify-content-xxl-end">
                                <div class="badge bg-label-secondary">1.2k Views</div>
                                </div>
                            </div>
                            </li>
                            <li class="d-flex mb-6 align-items-center">
                            <div class="avatar flex-shrink-0 me-4">
                                <span class="avatar-initial rounded bg-label-info"><i class="icon-base ti tabler-code icon-lg"></i></span>
                            </div>
                            <div class="row w-100 align-items-center">
                                <div class="col-sm-8 col-md-12 col-xxl-8 mb-1 mb-sm-0 mb-md-1 mb-xxl-0">
                                <h6 class="mb-0">Gender Based Voilence</h6>
                                </div>
                                <div class="col-sm-4 col-md-12 col-xxl-4 d-flex justify-content-xxl-end">
                                <div class="badge bg-label-secondary">834 Views</div>
                                </div>
                            </div>
                            </li>
                            <li class="d-flex mb-6 align-items-center">
                            <div class="avatar flex-shrink-0 me-4">
                                <span class="avatar-initial rounded bg-label-success"><i class="icon-base ti tabler-camera icon-lg"></i></span>
                            </div>
                            <div class="row w-100 align-items-center">
                                <div class="col-sm-8 col-md-12 col-xxl-8 mb-1 mb-sm-0 mb-md-1 mb-xxl-0">
                                <h6 class="mb-0">Gender Based Voilence</h6>
                                </div>
                                <div class="col-sm-4 col-md-12 col-xxl-4 d-flex justify-content-xxl-end">
                                <div class="badge bg-label-secondary">3.7k Views</div>
                                </div>
                            </div>
                            </li>
                            <li class="d-flex mb-6 align-items-center">
                            <div class="avatar flex-shrink-0 me-4">
                                <span class="avatar-initial rounded bg-label-warning"><i class="icon-base ti tabler-brand-dribbble icon-lg"></i></span>
                            </div>
                            <div class="row w-100 align-items-center">
                                <div class="col-sm-8 col-md-12 col-xxl-8 mb-1 mb-sm-0 mb-md-1 mb-xxl-0">
                                <h6 class="mb-0">Gender Based Voilence</h6>
                                </div>
                                <div class="col-sm-4 col-md-12 col-xxl-4 d-flex justify-content-xxl-end">
                                <div class="badge bg-label-secondary">2.5k Views</div>
                                </div>
                            </div>
                            </li>
                            <li class="d-flex align-items-center">
                            <div class="avatar flex-shrink-0 me-4">
                                <span class="avatar-initial rounded bg-label-danger"><i class="icon-base ti tabler-microphone-2 icon-lg"></i></span>
                            </div>
                            <div class="row w-100 align-items-center">
                                <div class="col-sm-8 col-md-12 col-xxl-8 mb-1 mb-sm-0 mb-md-1 mb-xxl-0">
                                <h6 class="mb-0">Gender Based Voilence</h6>
                                </div>
                                <div class="col-sm-4 col-md-12 col-xxl-4 d-flex justify-content-xxl-end">
                                <div class="badge bg-label-secondary">948 Views</div>
                                </div>
                            </div>
                            </li>
                        </ul>
                        </div>
                    </div>
                </div> -->


                


            
        </div>
    </div>

@endsection

@push('scripts')

@endpush