@extends('backend.layouts.main')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Lists</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- Row -->
    <div class="row">
        <div class="col-sm-12 col-md-12">
            @role(['admin'])
                {{-- Create project Button --}}

                <div class="d-flex justify-content-end mb-2">
                    <a href="{{ route('create.project') }}" class="btn btn-primary me-2"><span class="me-2">+</span>Create
                        Project</a>
                </div>
            @endrole
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Projects</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="responsive-datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table
                                                class="table table-bordered text-nowrap border-bottom dataTable no-footer"
                                                id="responsive-datatable" role="grid"
                                                aria-describedby="responsive-datatable_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="wd-15p border-bottom-0 sorting sorting_asc text-center"
                                                            tabindex="0" aria-controls="responsive-datatable"
                                                            rowspan="1" colspan="1" aria-sort="ascending"
                                                            aria-label="First name: activate to sort column descending"
                                                            style="width: 81.4583px;">Project name</th>
                                                        <th class="wd-15p border-bottom-0 sorting text-center"
                                                            tabindex="0" aria-controls="responsive-datatable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Last name: activate to sort column ascending"
                                                            style="width: 75.1875px;">Total Employee</th>
                                                        <th class="wd-15p border-bottom-0 sorting text-center"
                                                            tabindex="0" aria-controls="responsive-datatable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Last name: activate to sort column ascending"
                                                            style="width: 75.1875px;">Total Project Pages</th>
                                                        <th class="wd-15p border-bottom-0 sorting text-center"
                                                            tabindex="0" aria-controls="responsive-datatable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Last name: activate to sort column ascending"
                                                            style="width: 75.1875px;">Assign Employee</th>
                                                        <th class="wd-15p border-bottom-0 sorting text-center"
                                                            tabindex="0" aria-controls="responsive-datatable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Last name: activate to sort column ascending"
                                                            style="width: 75.1875px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($projects ?? [] as $project)
                                                        <tr class="even">
                                                            <td class="sorting_1 text-center">
                                                                {{ $project?->project_name ?? 'null' }}</td>
                                                            <td class="text-center">
                                                                {{ $project?->assign_project_count_unique }}</td>
                                                            <td class="text-center">
                                                                {{ $project?->project_pages_count }}</td>
                                                            <td class="text-center">
                                                                <form action="{{ route('assign.project.index') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="project_id"
                                                                        value="{{ $project?->id }}">
                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-sm fs-10"><i
                                                                            class="fe fe-plus"></i>assign</button>
                                                                </form>
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="g-2">
                                                                    <a href="{{ route('project.view', ['id' => $project?->id, 'name' => $project?->project_name]) }}"
                                                                        class="btn text-success btn-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="View"><span
                                                                            class="fe fe-eye fs-14"></span></a>
                                                                    <a href="{{ route('project.edit', ['id' => $project->id]) }}"
                                                                        class="btn text-primary btn-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="Edit"><span
                                                                            class="fe fe-edit fs-14"></span></a>
                                                                    <a href="{{ route('project.delete', $project->id) }}"
                                                                        class="btn text-danger btn-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="Delete" id="delete"><span
                                                                            class="fe fe-trash-2 fs-14"></span></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
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
    <!-- End Row -->
@endsection

@section('extra_js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>;
    <script src="{{ asset('backend/assets/js/delete-sweete-alert.js') }}"></script>


    <!-- DATA TABLE JS-->
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/table-data.js') }}"></script>
@endsection
