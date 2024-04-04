@extends('backend.layouts.main')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Tasks</h1>
        <div>
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li> --}}
                <li class="breadcrumb-item active" aria-current="page">All</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <!-- ROW-1 -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
            <div class="row">
                @can('staff view own tasks')
                    {{-- project for staff --}}

                    @forelse ($userProject->projectNamesPivot as $projectNamesPivots)
                        {{-- {{ $staffAssignPage }} --}}
                        @foreach ($projectNamesPivots->projectNames as $projectName)
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="mt-2">
                                                <form action="{{ route('project.group.staff.name', $projectName->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="btn text-success fs-20">{{ $projectName->project_name }}</button>

                                                </form>
                                                <h2 class="mb-0 number-font fs-16 text-warning">Pages</h2>
                                                <div class="ms-auto">
                                                    <div class="chart-wrapper mt-1">
                                                        <ol>
                                                            @foreach ($projectName->onlyAuthStaffPivot as $onlyAuthStaffPivots)
                                                                @foreach ($onlyAuthStaffPivots->getPages as $getPage)
                                                                    <li>{{ $getPage->project_page }}</li>
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
                @endcan
            </div>

        </div>
    </div>
    <!-- ROW-1 END -->
    <div class="modal fade" id="myModal" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body" id="modaldata">
                    {{-- @foreach ($novel->episodes as $episode) --}}
                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="main mt-2">
                                    <div class="d-flex justify-content-center">
                                        kdjfla;fak;
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @endforeach --}}
                </div>
            </div>
        </div>
    </div>
    <!-- ROW-3 -->

    <!-- ROW-3 END -->

    <!-- ROW-4 -->

    <!-- ROW-4 END -->
@endsection

@section('extra_js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myImg').click(function() {
                $('#myModal').modal('show')
            });
        });
    </script>

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
