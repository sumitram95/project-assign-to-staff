@extends('backend.layouts.main')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Permissions</h1>
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
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Permission</h3>
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
                                                        <th class="wd-15p border-bottom-0 sorting sorting_asc text-center"
                                                            tabindex="0" aria-controls="responsive-datatable"
                                                            rowspan="1" colspan="1" aria-sort="ascending"
                                                            aria-label="First name: activate to sort column descending">
                                                            Permission name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($permissions ?? [] as $permission)
                                                        <tr class="even">
                                                            <td class="sorting_1">
                                                                {{ $loop->index + 1 }}
                                                            </td>
                                                            <td class="sorting_1">
                                                                {{ $permission?->name ?? 'null' }}
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
    <!-- TypeHead js -->
    {{-- <script src="{{ asset('assets/plugins/bootstrap5-typehead/autocomplete.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/typehead.js') }}"></script> --}}

    <!-- INTERNAL SELECT2 JS -->
    <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

    <!-- DATA TABLE JS-->
    {{-- <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script> --}}
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
