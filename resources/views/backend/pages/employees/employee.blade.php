@extends('backend.layouts.main')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Lists</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Employee</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <!-- ROW-4 -->
    <div class="row">
        <div class="col-12 col-sm-12">
            @role(['admin'])
                {{-- Create Employee Button --}}
                <div class="d-flex justify-content-end mb-2">
                    <a href="{{ route('employee.create') }}" class="btn btn-primary"><span class="me-2">+</span>Create
                        Employee</a>
                </div>
            @endrole
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Employee</h3>
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
                                            <li><a href="#tab6" data-bs-toggle="tab" class="text-dark">Active</a>
                                            </li>
                                            <li><a href="#tab7" data-bs-toggle="tab" class="text-dark">Inactive</a></li>

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
                                                                Role</th>
                                                            <th class="bg-transparent border-bottom-0" style="width: 10%;">
                                                                Status</th>
                                                            <th class="bg-transparent border-bottom-0">
                                                                Email Verification</th>
                                                            <th class="bg-transparent border-bottom-0" style="width: 5%;">
                                                                Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($users as $user)
                                                            <tr class="border-bottom">
                                                                <td class="text-center">
                                                                    <div class="mt-0 mt-sm-2 d-block">
                                                                        <h6 class="mb-0 fs-14  mt-sm-2 d-block">
                                                                            {{ $user->uid }}</h6>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span class="mt-sm-2 d-block">
                                                                        {{ $user->userInfo->full_name ?? 'null' }}</span>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="mt-0 mt-sm-2 d-block">
                                                                            <h6
                                                                                class="mb-0 fs-14  mt-sm-2 d-block text-capitalize">
                                                                                {{ $user?->userInfo?->userPosition?->position ?? 'null' }}
                                                                            </h6>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="mt-sm-2 d-block">{{ $user->created_at->toFormattedDateString() }}</span>
                                                                </td>

                                                                <td>
                                                                    <div class="mt-sm-1 d-block">
                                                                        <span class="text-capitalize badge bg-warning">
                                                                            {{ $user->getRoleNames()->first() }}</span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="mt-sm-1 d-block">
                                                                        <span
                                                                            class="text-capitalize badge {{ $user->userInfo->status == 'active' ? 'bg-success' : 'bg-danger' }}">{{ $user->userInfo->status }}</span>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">
                                                                    <div class="mt-sm-1 d-block juctify-ceter">
                                                                        @if ($user->email_verified_at !== null)
                                                                            <span class="badge bg-success text-capitalize">
                                                                                Verified
                                                                            </span>
                                                                        @else
                                                                            <form action="{{route('email.again.verified',['id'=>encrypt($user->id)])}}" method="POST">
                                                                                @csrf
                                                                                <button type="submit"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-original-title="resend meail for verification"
                                                                                    class="badge bg-danger text-white border-0">Unverified</button>
                                                                            </form>
                                                                        @endif
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    @role(['admin'])
                                                                        <div class="g-2">
                                                                            <a href="{{ route('staff.profile.view', $user->id) }}"
                                                                                class="btn text-success btn-sm"
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-original-title="View"><span
                                                                                    class="fe fe-eye fs-14"></span></a>
                                                                            <a href="{{ route('employee.edit', ['id' => $user->userInfo->employee_id]) }}"
                                                                                class="btn text-primary btn-sm"
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-original-title="Edit"><span
                                                                                    class="fe fe-edit fs-14"></span></a>
                                                                            <a href="{{ route('employee.delete', ['uid' => $user->uid]) }}"
                                                                                class="btn text-danger btn-sm"
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-original-title="Delete"
                                                                                id="delete"><span
                                                                                    class="fe fe-trash-2 fs-14"></span></a>
                                                                        </div>
                                                                    @endrole
                                                                </td>
                                                            </tr>
                                                        @empty
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab6">
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
                                                                Role</th>
                                                            <th class="bg-transparent border-bottom-0"
                                                                style="width: 10%;">
                                                                Status</th>
                                                            <th class="bg-transparent border-bottom-0"
                                                                style="width: 10%;">
                                                                Email Verification</th>
                                                            <th class="bg-transparent border-bottom-0" style="width: 5%;">
                                                                Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($users as $user)
                                                            @if ($user->userInfo->status == 'active')
                                                                <tr class="border-bottom">
                                                                    <td class="text-center">
                                                                        <div class="mt-0 mt-sm-2 d-block">
                                                                            <h6 class="mb-0 fs-14">
                                                                                {{ $user->uid }}</h6>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="d-flex">
                                                                            <div class="ms-3 mt-0 mt-sm-2 d-block">
                                                                                <h6 class="mb-0 fs-14 text-capitalize">
                                                                                    {{ $user->userInfo->full_name ?? 'null' }}
                                                                                </h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="d-flex">
                                                                            <div class="mt-0 mt-sm-3 d-block">
                                                                                <h6 class="mb-0 fs-14 text-capitalize">
                                                                                    {{ $user?->userInfo?->userPosition?->position ?? 'null' }}
                                                                                </h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td><span
                                                                            class="mt-sm-2 d-block">{{ $user->created_at }}</span>
                                                                    </td>

                                                                    <td>
                                                                        <div class="mt-sm-1 d-block">
                                                                            <span class="text-capitalize badge bg-warning">
                                                                                {{ $user->getRoleNames()->first() }}</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="mt-sm-1 d-block">
                                                                            <span
                                                                                class="badge bg-success text-capitalize">Active</span>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center cursor-pointer">
                                                                        <div class="mt-sm-1 d-block">
                                                                            @if ($user->email_verified_at !== null)
                                                                                <span
                                                                                    class="badge bg-success text-capitalize">
                                                                                    Verified
                                                                                </span>
                                                                            @else
                                                                                <form action="#" method="POST">
                                                                                    @csrf
                                                                                    <button type="submit"
                                                                                        class="badge bg-danger text-white border-0">Unverified</button>
                                                                                </form>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        @role(['admin'])
                                                                            <div class="g-2">
                                                                                <a href="{{ route('staff.profile.view', $user->id) }}"
                                                                                    class="btn text-success btn-sm"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-original-title="View"><span
                                                                                        class="fe fe-eye fs-14"></span></a>
                                                                                <a href="{{ route('employee.edit', ['id' => $user->userInfo->employee_id]) }}"
                                                                                    class="btn text-primary btn-sm"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-original-title="Edit"><span
                                                                                        class="fe fe-edit fs-14"></span></a>
                                                                                <a href="{{ route('employee.delete', ['uid' => $user->uid]) }}"
                                                                                    class="btn text-danger btn-sm"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-original-title="Delete"
                                                                                    id="delete"><span
                                                                                        class="fe fe-trash-2 fs-14"></span></a>
                                                                            </div>
                                                                        @endrole
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @empty
                                                            <tr>
                                                                <td class="text-center" colspan="7">
                                                                    not active user data
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab7">
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
                                                                Role</th>
                                                            <th class="bg-transparent border-bottom-0"
                                                                style="width: 10%;">Status</th>
                                                            <th class="bg-transparent border-bottom-0"
                                                                style="width: 10%;">Email varification</th>
                                                            <th class="bg-transparent border-bottom-0" style="width: 5%;">
                                                                Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($users as $user)
                                                            @if ($user->userInfo->status == 'inactive')
                                                                <tr class="border-bottom">
                                                                    <td class="text-center">
                                                                        <div class="mt-0 mt-sm-2 d-block">
                                                                            <h6 class="mb-0 fs-14">
                                                                                {{ $user->uid }}</h6>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="d-flex">
                                                                            <div class="ms-3 mt-0 mt-sm-2 d-block">
                                                                                <h6 class="mb-0 fs-14 text-capitalize">
                                                                                    {{ $user->userInfo->full_name ?? 'null' }}
                                                                                </h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="d-flex">
                                                                            <div class="mt-0 mt-sm-3 d-block">
                                                                                <h6 class="mb-0 fs-14 text-capitalize">
                                                                                    {{ $user?->userInfo?->userPosition?->position ?? 'null' }}
                                                                                </h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td><span class="mt-sm-2 d-block">
                                                                            {{ $user->created_at }}</span></td>

                                                                    <td>
                                                                        <div class="mt-sm-1 d-block">
                                                                            <span
                                                                                class="text-capitalize badge badge bg-warning">
                                                                                {{ $user->getRoleNames()->first() }}</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="mt-sm-1 d-block">
                                                                            <span
                                                                                class="badge bg-danger text-capitalize">Inactive</span>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center cursor-pointer">
                                                                        <div class="mt-sm-1 d-block">
                                                                            @if ($user->email_verified_at !== null)
                                                                                <span
                                                                                    class="badge bg-success text-capitalize">
                                                                                    Verified
                                                                                </span>
                                                                            @else
                                                                                <form action="#" method="POST">
                                                                                    @csrf
                                                                                    <button type="submit"
                                                                                        class="badge bg-danger text-white border-0">Unverified</button>
                                                                                </form>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        @role(['admin'])
                                                                            <div class="g-2">
                                                                                <a href="{{ route('staff.profile.view', $user->id) }}"
                                                                                    class="btn text-success btn-sm"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-original-title="View"><span
                                                                                        class="fe fe-eye fs-14"></span></a>
                                                                                <a href="{{ route('employee.edit', ['id' => $user->userInfo->employee_id]) }}"
                                                                                    class="btn text-primary btn-sm"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-original-title="Edit"><span
                                                                                        class="fe fe-edit fs-14"></span></a>
                                                                                <a href="{{ route('employee.delete', ['uid' => $user->uid]) }}"
                                                                                    class="btn text-danger btn-sm"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-original-title="Delete"
                                                                                    id="delete"><span
                                                                                        class="fe fe-trash-2 fs-14"></span></a>
                                                                            </div>
                                                                        @endrole
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @empty
                                                            <tr>
                                                                <td class="text-center" colspan="7">
                                                                    not inactive user data
                                                                </td>
                                                            </tr>
                                                        @endforelse
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
    </div>
    <!-- ROW-4 END -->
@endsection

@section('extra_js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>;
    <script src="{{ asset('backend/assets/js/delete-sweete-alert.js') }}"></script>
    <!-- INTERNAL SELECT2 JS -->
    <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

    <!-- DATA TABLE JS-->
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/table-data.js') }}"></script>
@endsection
