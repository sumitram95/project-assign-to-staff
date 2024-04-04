@extends('backend.layouts.main')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Lists</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('errors.website.index') }}">Error</a></li>
                <li class="breadcrumb-item active" aria-current="page">All</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- Row -->
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Error</h3>
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
                                                            style="width: 81.4583px;">#</th>
                                                        <th class="wd-15p border-bottom-0 sorting text-center"
                                                            tabindex="0" aria-controls="responsive-datatable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Last name: activate to sort column ascending"
                                                            style="width: 75.1875px;">Controller Name</th>
                                                        <th class="wd-15p border-bottom-0 sorting text-center"
                                                            tabindex="0" aria-controls="responsive-datatable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Last name: activate to sort column ascending"
                                                            style="width: 75.1875px;">Method Name</th>
                                                        <th class="wd-15p border-bottom-0 sorting text-center"
                                                            tabindex="0" aria-controls="responsive-datatable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Last name: activate to sort column ascending"
                                                            style="width: 75.1875px;">Error Count</th>
                                                        <th class="wd-15p border-bottom-0 sorting text-center"
                                                            tabindex="0" aria-controls="responsive-datatable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Last name: activate to sort column ascending"
                                                            style="width: 75.1875px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($errors ?? [] as $error)
                                                        <tr class="even">
                                                            <td class="sorting_1 text-center">
                                                                {{ $loop->index + 1 }}</td>
                                                            <td class="text-center">
                                                                {{ $error?->controller_name }}</td>
                                                            <td class="text-center">
                                                                {{ $error?->method }}</td>
                                                            <td class="sorting_1 text-center">
                                                                {{ $error->count_error }}</td>
                                                            <td class="text-center">
                                                                <div class="g-2">
                                                                    <a href="{{ route('errors.website.view.code', $error->id) }}"
                                                                        class="btn text-success btn-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="View"><span
                                                                            class="fe fe-eye fs-14"></span></a>
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
