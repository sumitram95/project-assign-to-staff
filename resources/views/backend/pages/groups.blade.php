@extends('backend.layouts.main')
@section('content')
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">Chat</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('project.index') }}">Projects</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chat</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Groups of project</div>
                </div>
                <div class="card-body">
                    <div class="">
                        @forelse ($user->staffAssignPages as $value)
                            @foreach ($value->getPages ?? [] as $page)
                                <span class="tag fs-10 badge-sm">{{ $page->project_page ?? '' }}</span>
                                @foreach ($page->projectNames ?? [] as $projectName)
                                    <span class="tag fs-10 badge-sm">{{ $projectName->project_name ?? '' }}</span>
                                    <a href="dfafd">
                                        <div class="media overflow-visible border-bottom">
                                            {{-- <img class="avatar brround avatar-md me-3" src="../assets/images/users/18.jpg" alt="avatar-img"> --}}
                                            <div class="media-body valign-middle mb-3 mt-3">
                                                <i class="fs-20 fa-brands fa-r-project"></i><span
                                                    class="fs-20 fw-semibold text text-success">{{ $value }}</span>
                                                {{-- <p class="text-muted mb-0">{{dd($uniqueEmployees)}}</p> --}}
                                                <p class="text-muted mb-0">

                                                </p>
                                            </div>
                                            {{-- <div class="media-body valign-middle text-end overflow-visible mt-2">
                                            <button class="btn btn-sm btn-primary" type="button">Follow</button>
                                        </div> --}}
                                        </div>
                                    </a>
                                @endforeach
                            @endforeach

                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

    </div>
@endsection
