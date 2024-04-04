@extends('backend.layouts.main')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
        <div>
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li> --}}
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <!-- ROW-1 -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
            <div class="row">
                {{-- <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="mt-2">
                                    <h6 class="">Total Users</h6>
                                    <h2 class="mb-0 number-font">44,278</h2>
                                </div>
                                <div class="ms-auto">
                                    <div class="chart-wrapper mt-1">
                                        <canvas id="saleschart" class="h-8 w-9 chart-dropshadow"></canvas>
                                    </div>
                                </div>
                            </div>
                            <span class="text-muted fs-12"><span class="text-secondary"><i
                                        class="fe fe-arrow-up-circle  text-secondary"></i>
                                    5%</span>
                                Last week</span>
                        </div>
                    </div>
                </div> --}}

                @can('projects management')
                    {{-- total employee --}}
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xl-6">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="mt-2">
                                        <h6 class="">Total Employee</h6>
                                        <h2 class="mb-0 number-font">{{ $user_count ?? '0' }}</h2>
                                    </div>
                                    <div class="ms-auto">
                                        <div class="chart-wrapper mt-1">
                                            <canvas id="leadschart" class="h-8 w-9 chart-dropshadow"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- completed project --}}
                    {{-- new project --}}
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="mt-2">
                                        <h6 class="">New Projects</h6>
                                        <h2 class="mb-0 number-font">{{ $project_count ?? '0' }}</h2>
                                    </div>
                                    <div class="ms-auto">
                                        <div class="chart-wrapper mt-1">
                                            <canvas id="costchart" class="h-8 w-9 chart-dropshadow"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
                @can('staff view own tasks')
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                        <div class="row">

                            {{-- project for staff --}}

                            @forelse ($userProject?->projectNamesPivot ?? [] as $projectNamesPivots)
                                {{-- {{ $staffAssignPage }} --}}
                                @foreach ($projectNamesPivots?->projectNames ?? [] as $projectName)
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xl-6">
                                        <div class="card overflow-hidden">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <form action="{{ route('project.group.staff.name', $projectName?->id ?? 0) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button
                                                                class="btn text-success fs-20">{{ $projectName?->project_name ??  '' }}</button>

                                                        </form>
                                                        <h2 class="mb-0 number-font fs-16 text-warning">Pages</h2>
                                                        <div class="ms-auto">
                                                            <div class="chart-wrapper mt-1">
                                                                <ol>
                                                                    @foreach ($projectName?->onlyAuthStaffPivot ?? [] as $onlyAuthStaffPivots)
                                                                        @foreach ($onlyAuthStaffPivots?->getPages ?? [] as $getPage)
                                                                            <li>{{ $getPage?->project_page ?? '' }}</li>
                                                                        @endforeach
                                                                    @endforeach
                                                                </ol>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @empty
                                <div class="shadow-lg p-3 mb-5 bg-white text-danger text-center">
                                    you have not assign any project
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </div>
    <!-- ROW-1 END -->

    <!-- ROW-3 -->
    {{-- <div class="row">
        <div class="col-xl-4 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title fw-semibold">Weekly Activity</h4>
                </div>
                <div class="card-body pb-0">
                    <ul class="task-list">
                        <li class="d-sm-flex">
                            <div>
                                <i class="task-icon bg-primary"></i>
                                <h6 class="fw-semibold">Task Finished<span class="text-muted fs-11 mx-2 fw-normal">09 July
                                        2021</span>
                                </h6>
                                <p class="text-muted fs-12">Adam Berry finished task on<a href="javascript:void(0)"
                                        class="fw-semibold"> Project
                                        Management</a></p>
                            </div>
                            <div class="ms-auto d-md-flex">
                                <a href="javascript:void(0)" class="text-muted me-2" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Edit" aria-label="Edit"><span
                                        class="fe fe-edit"></span></a>
                                <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                            </div>
                        </li>
                        <li class="d-sm-flex">
                            <div>
                                <i class="task-icon bg-secondary"></i>
                                <h6 class="fw-semibold">New Comment<span class="text-muted fs-11 mx-2 fw-normal">05 July
                                        2021</span>
                                </h6>
                                <p class="text-muted fs-12">Victoria commented on Project <a href="javascript:void(0)"
                                        class="fw-semibold"> AngularJS
                                        Template</a></p>
                            </div>
                            <div class="ms-auto d-md-flex">
                                <a href="javascript:void(0)" class="text-muted me-2" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Edit" aria-label="Edit"><span
                                        class="fe fe-edit"></span></a>
                                <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                            </div>
                        </li>
                        <li class="d-sm-flex">
                            <div>
                                <i class="task-icon bg-success"></i>
                                <h6 class="fw-semibold">New Comment<span class="text-muted fs-11 mx-2 fw-normal">25 June
                                        2021</span>
                                </h6>
                                <p class="text-muted fs-12">Victoria commented on Project <a href="javascript:void(0)"
                                        class="fw-semibold"> AngularJS
                                        Template</a></p>
                            </div>
                            <div class="ms-auto d-md-flex">
                                <a href="javascript:void(0)" class="text-muted me-2" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Edit" aria-label="Edit"><span
                                        class="fe fe-edit"></span></a>
                                <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                            </div>
                        </li>
                        <li class="d-sm-flex">
                            <div>
                                <i class="task-icon bg-warning"></i>
                                <h6 class="fw-semibold">Task Overdue<span class="text-muted fs-11 mx-2 fw-normal">14 June
                                        2021</span>
                                </h6>
                                <p class="text-muted mb-0 fs-12">Petey Cruiser finished task <a href="javascript:void(0)"
                                        class="fw-semibold"> Integrated
                                        management</a></p>
                            </div>
                            <div class="ms-auto d-md-flex">
                                <a href="javascript:void(0)" class="text-muted me-2" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Edit" aria-label="Edit"><span
                                        class="fe fe-edit"></span></a>
                                <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                            </div>
                        </li>
                        <li class="d-sm-flex">
                            <div>
                                <i class="task-icon bg-danger"></i>
                                <h6 class="fw-semibold">Task Overdue<span class="text-muted fs-11 mx-2 fw-normal">29 June
                                        2021</span>
                                </h6>
                                <p class="text-muted mb-0 fs-12">Petey Cruiser finished task <a href="javascript:void(0)"
                                        class="fw-semibold"> Integrated
                                        management</a></p>
                            </div>
                            <div class="ms-auto d-md-flex">
                                <a href="javascript:void(0)" class="text-muted me-2" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Edit" aria-label="Edit"><span
                                        class="fe fe-edit"></span></a>
                                <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                            </div>
                        </li>
                        <li class="d-sm-flex">
                            <div>
                                <i class="task-icon bg-info"></i>
                                <h6 class="fw-semibold">Task Finished<span class="text-muted fs-11 mx-2 fw-normal">09 July
                                        2021</span>
                                </h6>
                                <p class="text-muted fs-12">Adam Berry finished task on<a href="javascript:void(0)"
                                        class="fw-semibold"> Project
                                        Management</a></p>
                            </div>
                            <div class="ms-auto d-md-flex">
                                <a href="javascript:void(0)" class="text-muted me-2" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Edit" aria-label="Edit"><span
                                        class="fe fe-edit"></span></a>
                                <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title fw-semibold">Browser Usage</h4>
                </div>
                <div class="card-body">
                    <div class="browser-stats">
                        <div class="row mb-4">
                            <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                                <img src="../assets/images/browsers/chrome.svg" class="img-fluid" alt="img">
                            </div>
                            <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                                <div class="d-flex align-items-end justify-content-between mb-1">
                                    <h6 class="mb-1">Chrome</h6>
                                    <h6 class="fw-semibold mb-1">35,502 <span class="text-success fs-11">(<i
                                                class="fe fe-arrow-up"></i>12.75%)</span></h6>
                                </div>
                                <div class="progress h-2 mb-3">
                                    <div class="progress-bar bg-primary" style="width: 70%;" role="progressbar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                                <img src="../assets/images/browsers/opera.svg" class="img-fluid" alt="img">
                            </div>
                            <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                                <div class="d-flex align-items-end justify-content-between mb-1">
                                    <h6 class="mb-1">Opera</h6>
                                    <h6 class="fw-semibold mb-1">12,563 <span class="text-danger fs-11">(<i
                                                class="fe fe-arrow-down"></i>15.12%)</span></h6>
                                </div>
                                <div class="progress h-2 mb-3">
                                    <div class="progress-bar bg-secondary" style="width: 40%;" role="progressbar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                                <img src="../assets/images/browsers/ie.svg" class="img-fluid" alt="img">
                            </div>
                            <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                                <div class="d-flex align-items-end justify-content-between mb-1">
                                    <h6 class="mb-1">IE</h6>
                                    <h6 class="fw-semibold mb-1">25,364 <span class="text-success fs-11">(<i
                                                class="fe fe-arrow-down"></i>24.37%)</span></h6>
                                </div>
                                <div class="progress h-2 mb-3">
                                    <div class="progress-bar bg-success" style="width: 50%;" role="progressbar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                                <img src="../assets/images/browsers/firefox.svg" class="img-fluid" alt="img">
                            </div>
                            <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                                <div class="d-flex align-items-end justify-content-between mb-1">
                                    <h6 class="mb-1">Firefox</h6>
                                    <h6 class="fw-semibold mb-1">14,635 <span class="text-success fs-11">(<i
                                                class="fe fe-arrow-down"></i>15.63%)</span></h6>
                                </div>
                                <div class="progress h-2 mb-3">
                                    <div class="progress-bar bg-danger" style="width: 50%;" role="progressbar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                                <img src="../assets/images/browsers/edge.svg" class="img-fluid" alt="img">
                            </div>
                            <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                                <div class="d-flex align-items-end justify-content-between mb-1">
                                    <h6 class="mb-1">Edge</h6>
                                    <h6 class="fw-semibold mb-1">15,453 <span class="text-danger fs-11">(<i
                                                class="fe fe-arrow-down"></i>23.70%)</span></h6>
                                </div>
                                <div class="progress h-2 mb-3">
                                    <div class="progress-bar bg-warning" style="width: 10%;" role="progressbar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                                <img src="../assets/images/browsers/safari.svg" class="img-fluid" alt="img">
                            </div>
                            <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                                <div class="d-flex align-items-end justify-content-between mb-1">
                                    <h6 class="mb-1">Safari</h6>
                                    <h6 class="fw-semibold mb-1">10,054 <span class="text-success fs-11">(<i
                                                class="fe fe-arrow-up"></i>11.04%)</span></h6>
                                </div>
                                <div class="progress h-2 mb-3">
                                    <div class="progress-bar bg-info" style="width: 40%;" role="progressbar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                                <img src="../assets/images/browsers/netscape.svg" class="img-fluid" alt="img">
                            </div>
                            <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                                <div class="d-flex align-items-end justify-content-between mb-1">
                                    <h6 class="mb-1">Netscape</h6>
                                    <h6 class="fw-semibold mb-1">35,502 <span class="text-success fs-11">(<i
                                                class="fe fe-arrow-up"></i>12.75%)</span></h6>
                                </div>
                                <div class="progress h-2 mb-3">
                                    <div class="progress-bar bg-green" style="width: 30%;" role="progressbar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- ROW-3 END -->

    <!-- ROW-4 -->
    {{-- <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Employee Status</h3>
                </div>
                <div class="card-body pt-4">
                    <div class="grid-margin">
                        <div class="">
                            <div class="panel panel-primary">
                                <div class="tab-menu-heading border-0 p-0">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs product-sale">
                                            <li><a href="#tab5" class="active" data-bs-toggle="tab">All Employee</a>
                                            </li>
                                            <li><a href="#tab6" data-bs-toggle="tab" class="text-dark">Verified</a>
                                            </li>
                                            <li><a href="#tab7" data-bs-toggle="tab" class="text-dark">Pending</a></li>
                                            <li><a href="#tab8" data-bs-toggle="tab" class="text-dark">Block</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body border-0 pt-0">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab5">
                                            <div class="table-responsive">
                                                <table id="basic-datatable" class="table table-bordered text-nowrap mb-0">
                                                    <thead class="border-top">
                                                        <tr>
                                                            <th class="bg-transparent border-bottom-0" style="width: 5%;">
                                                                Employee Id</th>
                                                            <th class="bg-transparent border-bottom-0">
                                                                Name</th>
                                                            <th class="bg-transparent border-bottom-0">
                                                                Position</th>
                                                            <th class="bg-transparent border-bottom-0">
                                                                Date</th>

                                                            <th class="bg-transparent border-bottom-0">
                                                                Payment Mode</th>
                                                            <th class="bg-transparent border-bottom-0"
                                                                style="width: 10%;">Status</th>
                                                            <th class="bg-transparent border-bottom-0" style="width: 5%;">
                                                                Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border-bottom">
                                                            <td class="text-center">
                                                                <div class="mt-0 mt-sm-2 d-block">
                                                                    <h6 class="mb-0 fs-14 fw-semibold">
                                                                        #98765490</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <span class="avatar bradius"
                                                                        style="background-image: url(../assets/images/orders/10.jpg)"></span>
                                                                    <div class="ms-3 mt-0 mt-sm-2 d-block">
                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                            Headsets</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                            Cherry Blossom</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><span class="mt-sm-2 d-block">30
                                                                    Aug
                                                                    2021</span></td>

                                                            <td>
                                                                <div class="d-flex">
                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                            Online Payment</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="mt-sm-1 d-block">
                                                                    <span
                                                                        class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Shipped</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="g-2">
                                                                    <a class="btn text-primary btn-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="Edit"><span
                                                                            class="fe fe-edit fs-14"></span></a>
                                                                    <a class="btn text-danger btn-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="Delete"><span
                                                                            class="fe fe-trash-2 fs-14"></span></a>
                                                                    <a class="btn text-success btn-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="View"><span
                                                                            class="fe fe-eye fs-14"></span></a>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab6">
                                            <div class="table-responsive">
                                                <table id="example3" class="table text-nowrap mb-0">
                                                    <thead class="border-top">
                                                        <tr>
                                                            <th class="bg-transparent border-bottom-0" style="width: 5%;">
                                                                Employee Id
                                                            </th>
                                                            <th class="bg-transparent border-bottom-0">
                                                                Name</th>
                                                            <th class="bg-transparent border-bottom-0">
                                                                Position</th>
                                                            <th class="bg-transparent border-bottom-0">
                                                                Date</th>

                                                            <th class="bg-transparent border-bottom-0">
                                                                Payment Mode</th>
                                                            <th class="bg-transparent border-bottom-0"
                                                                style="width: 10%;">Status</th>
                                                            <th class="bg-transparent border-bottom-0" style="width: 5%;">
                                                                Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border-bottom">
                                                            <td class="text-center">
                                                                <div class="mt-0 mt-sm-2 d-block">
                                                                    <h6 class="mb-0 fs-14 fw-semibold">
                                                                        #98765490</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <span class="avatar bradius"
                                                                        style="background-image: url(../assets/images/orders/10.jpg)"></span>
                                                                    <div class="ms-3 mt-0 mt-sm-2 d-block">
                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                            Headsets</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                            Cherry Blossom</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><span class="mt-sm-2 d-block">30
                                                                    Aug
                                                                    2021</span></td>

                                                            <td>
                                                                <div class="d-flex">
                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                            Online Payment</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="mt-sm-1 d-block">
                                                                    <span
                                                                        class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Verified</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="g-2">
                                                                    <a class="btn text-primary btn-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="Edit"><span
                                                                            class="fe fe-edit fs-14"></span></a>
                                                                    <a class="btn text-danger btn-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="Delete"><span
                                                                            class="fe fe-trash-2 fs-14"></span></a>
                                                                    <a class="btn text-success btn-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="View"><span
                                                                            class="fe fe-eye fs-14"></span></a>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab7">
                                            <div class="table-responsive">
                                                <table id="basic-datatable" class="table table-bordered text-nowrap mb-0">
                                                    <thead class="border-top">
                                                        <tr>
                                                            <th class="bg-transparent border-bottom-0" style="width: 5%;">
                                                                Employee Id
                                                            </th>
                                                            <th class="bg-transparent border-bottom-0">
                                                                Name</th>
                                                            <th class="bg-transparent border-bottom-0">
                                                                Position</th>
                                                            <th class="bg-transparent border-bottom-0">
                                                                Date</th>

                                                            <th class="bg-transparent border-bottom-0">
                                                                Payment Mode</th>
                                                            <th class="bg-transparent border-bottom-0"
                                                                style="width: 10%;">Status</th>
                                                            <th class="bg-transparent border-bottom-0" style="width: 5%;">
                                                                Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border-bottom">
                                                            <td class="text-center">
                                                                <div class="mt-0 mt-sm-2 d-block">
                                                                    <h6 class="mb-0 fs-14 fw-semibold">
                                                                        #98765490</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <span class="avatar bradius"
                                                                        style="background-image: url(../assets/images/orders/10.jpg)"></span>
                                                                    <div class="ms-3 mt-0 mt-sm-2 d-block">
                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                            Headsets</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                            Cherry Blossom</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><span class="mt-sm-2 d-block">30
                                                                    Aug
                                                                    2021</span></td>

                                                            <td>
                                                                <div class="d-flex">
                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                            Online Payment</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="mt-sm-1 d-block">
                                                                    <span
                                                                        class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">Pending</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="g-2">
                                                                    <a class="btn text-primary btn-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="Edit"><span
                                                                            class="fe fe-edit fs-14"></span></a>
                                                                    <a class="btn text-danger btn-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="Delete"><span
                                                                            class="fe fe-trash-2 fs-14"></span></a>
                                                                    <a class="btn text-success btn-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="View"><span
                                                                            class="fe fe-eye fs-14"></span></a>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab8">
                                            <div class="table-responsive">
                                                <table class="table table-bordered text-nowrap mb-0">
                                                    <thead class="border-top">
                                                        <tr>
                                                            <th class="bg-transparent border-bottom-0" style="width: 5%;">
                                                                Employee Id
                                                            </th>
                                                            <th class="bg-transparent border-bottom-0">
                                                                Name</th>
                                                            <th class="bg-transparent border-bottom-0">
                                                                Position</th>
                                                            <th class="bg-transparent border-bottom-0">
                                                                Date</th>

                                                            <th class="bg-transparent border-bottom-0">
                                                                Payment Mode</th>
                                                            <th class="bg-transparent border-bottom-0"
                                                                style="width: 10%;">Status</th>
                                                            <th class="bg-transparent border-bottom-0" style="width: 5%;">
                                                                Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border-bottom">
                                                            <td class="text-center">
                                                                <div class="mt-0 mt-sm-2 d-block">
                                                                    <h6 class="mb-0 fs-14 fw-semibold">
                                                                        #98765490</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <span class="avatar bradius"
                                                                        style="background-image: url(../assets/images/orders/10.jpg)"></span>
                                                                    <div class="ms-3 mt-0 mt-sm-2 d-block">
                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                            Headsets</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                            Cherry Blossom</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><span class="mt-sm-2 d-block">30
                                                                    Aug
                                                                    2021</span></td>

                                                            <td>
                                                                <div class="d-flex">
                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                            Online Payment</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="mt-sm-1 d-block">
                                                                    <span
                                                                        class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">Block</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="g-2">
                                                                    <a class="btn text-primary btn-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="Edit"><span
                                                                            class="fe fe-edit fs-14"></span></a>
                                                                    <a class="btn text-danger btn-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="Delete"><span
                                                                            class="fe fe-trash-2 fs-14"></span></a>
                                                                    <a class="btn text-success btn-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="View"><span
                                                                            class="fe fe-eye fs-14"></span></a>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- ROW-4 END -->
@endsection

@section('extra_js')
    <!-- TypeHead js -->
    <script src="{{ asset('assets/plugins/bootstrap5-typehead/autocomplete.js') }}"></script>
    <script src="{{ asset('assets/js/typehead.js') }}"></script>

    <!-- INTERNAL SELECT2 JS -->
    <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

    <!-- DATA TABLE JS-->
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/table-data.js') }}"></script>
@endsection
