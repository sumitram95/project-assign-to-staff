@extends('backend.layouts.main')
@section('content')
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">Team Group</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('staff.task.index') }}">Task</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title fs-20 fw-semibold">{{ $project->project_name ?? '' }}</div>
                    <div class="card-title fs-20 fw-semibold">{{ $project->project_name ?? '' }}</div>
                </div>
                <div class="card-body">
                    @forelse ($uniqueEmployees as $value)
                        {{-- <span class="tag fs-10 badge-sm">{{ $assignProjectUSer->email ?? '' }}</span> --}}
                        <a href="dfafd">
                            {{-- <div class="media overflow-visible border-bottom"> --}}
                            {{-- <div class="media-body valign-middle mb-3 mt-3"> --}}
                            <p class="fs-18 text-muted">
                                {{ $value->userInfo->full_name == auth()->user()->userInfo->full_name ? 'Me' : $value->userInfo->full_name }}
                                <span class="badge bg-success fs-10">{{ $value->userInfo->userPosition->position }}</span>
                            </p>

                            {{-- <p class="text-muted mb-0">{{ $value->email }}</p> --}}


                            {{-- </div> --}}
                            {{-- </div> --}}
                        </a>

                    @empty
                    @endforelse

                </div>
            </div>
        </div>
        <!-- End Row -->

    </div>
@endsection
