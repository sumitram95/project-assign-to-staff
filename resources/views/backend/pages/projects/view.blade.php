@extends('backend.layouts.main')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title text-capitalize">{{ $project->project_name }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('project.index') }}">Projects</a></li>
                <li class="breadcrumb-item active" aria-current="page">View</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- Row -->
    <div class="row row-cols-4">
        @foreach ($project?->projectPages ?? [] as $projectPage)
            <div class="col-xl-3 col-sm-12 col-md-12-white">
                <div class="card border shadow-sm p-3 mb-5 p-0">
                    <div class="card-header">
                        <h3 class="card-title text-success fs-18 w-100 text-capitalize">
                            {{ $projectPage?->project_page ?? '' }}
                            <span class="fs-10 text-primary" style="float: right">Developer
                                {{ $projectPage?->assignProject?->count() ?? '0' }}</span>
                        </h3>
                        <div class="card-options">
                            <a class="card-options-collapse" data-bs-toggle="card-collapse"><i
                                    class="fe fe-chevron-up"></i></a>
                            <a href="{{ route('project.page.delete', ['id' => $projectPage?->id ?? '']) }}"
                                id="delete"><i class="fe fe-trash text-danger"></i></a>
                        </div>
                    </div>
                    <div class="row m-2">
                        {{-- {{ $projectPage->assignProject->count() }} --}}
                        @if ($projectPage?->assignProject?->count() == 0)
                            <h2 class="text-center fs-12 text-danger">Not Any Staff Assign in this page yet</h2>
                        @endif
                        @foreach ($projectPage?->assignProject ?? [] as $assign)
                            @foreach ($assign?->assignProjectUSers ?? [] as $assignProjectUSer)
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-light">
                                        <div>
                                            <a href="{{ route('assign.staff.delete', ['id' => $assign->id]) }}"
                                                class="shadow-sm p-1 rounded text-center bg-white" style="float: right"
                                                id="delete"><i class="fe fe-trash text-danger"></i></a>
                                        </div>
                                        <a href="{{ route('staff.profile.view', ['id' => $assignProjectUSer->id]) }}">
                                            <div class="card-body text-center">
                                                @if (!isset($assignProjectUSer?->userInfo?->profile_img))
                                                    <span class="avatar avatar-xxl brround cover-image"
                                                        data-bs-image-src="{{ asset('uploads/images/defult_user_logo.png') }}"
                                                        style="background: url(&quot;{{ asset('uploads/images/defult_user_logo.png') }}&quot;) center center;"></span>
                                                @else
                                                    <span class="avatar avatar-xxl brround cover-image"
                                                        data-bs-image-src="{{ asset('storage/uploads/profile/' . $assignProjectUSer?->userInfo?->profile_img ?? '') }}"
                                                        style="background: url(&quot;{{ asset('storage/uploads/profile/' . $assignProjectUSer?->userInfo?->profile_img ?? '') }}&quot;) center center;"></span>
                                                @endif
                                                <h4 class="h4 mb-0 mt-3">
                                                    {{ $assignProjectUSer?->userInfo?->full_name ?? 'Empty' }} </h4>
                                                <p class="card-text mb-0 fs-12">{{ $assignProjectUSer?->email ?? 'Empty' }}
                                                </p>
                                                <p class="card-text fs-12 mb-0">Position : <span
                                                        class="text-white badge bg-warning">{{ $assignProjectUSer?->userInfo->userPosition->position ?? 'empty' }}
                                                    </span>
                                                </p>
                                                <p class="card-text fs-12 mb-0">Role : <span
                                                        class="text-white badge bg-success">
                                                        {{ $assignProjectUSer?->getRoleNames()->first() ?? 'empty' }}
                                                    </span>
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- End Row -->
@endsection

@section('extra_js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>;
    <script src="{{ asset('backend/assets/js/delete-sweete-alert.js') }}"></script>
@endsection
