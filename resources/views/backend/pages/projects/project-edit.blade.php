@extends('backend.layouts.main')

@section('content')
    <div class="row">
        <div class="page-header">
            <h1 class="page-title">Edit Project</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('project.index') }}">Projects</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Project</h3>
                    </div>

                    <form action="{{ route('project.update', ['project' => $project->id]) }}" method="POST"
                        class="needs-validation" novalidate="">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="project">Project Name</label>
                                {{-- {{dd($project->project_name)}} --}}
                                <input type="text" class="form-control" id="project" name="project_name"
                                    placeholder="E-Commerce" value="{{ $project->project_name }}" required>
                                @error('project_name')
                                    <span class="text text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12 mb-0">
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <label for="project">Project Specific Skill </label>
                                            <div class="form-footer mt-2">
                                                <button class="btn btn-sm p-1 btn-success" type="button" id="new_create"><i
                                                        class="fe fe-plus"></i>
                                                    Add extra page</button>
                                            </div>
                                        </div>

                                        @forelse  ($project->projectPages ?? [] as $page)
                                            <div id="row">
                                                <div class="input-group mt-2">
                                                    <div class="input-group-prepend">
                                                        <a href="{{ route('project.page.delete', ['id' => $page?->id ?? '']) }}"
                                                            id="delete"><i
                                                                class="fe fe-trash text-danger me-2 p-0 fs-16"></i></a>
                                                    </div>
                                                    <input type="text" class="form-control mt-2" id="project"
                                                        name="pages[]" placeholder="Frontend"
                                                        value="{{ $page->project_page ?? 'null' }}" required>
                                                </div>
                                            </div>
                                        @empty
                                            <span class="text text-danger">Empty</span>
                                        @endforelse

                                        <div id="newinput"></div>
                                        @error('pages')
                                            <span class="text text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer mt-2">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_js')
{{-- <script src="{{ asset('assets/js/form-validation.js') }}"></script> --}}
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="{{ asset('backend/assets/js/addExtraProjectPage.js') }}"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>;
    <script src="{{ asset('backend/assets/js/delete-sweete-alert.js') }}"></script>
@endsection
