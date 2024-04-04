@extends('backend.layouts.main')

@section('content')
    <div class="row">
        <div class="page-header">
            <h1 class="page-title">Create-Project</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Project</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Project</h3>
                    </div>

                    <form action="{{ route('create.project.store') }}" method="POST" class="needs-validation"
                        novalidate="">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="project">Project Name<span class="text-danger">[Required]</span> </label>
                                <input type="text" class="form-control" id="project" name="project_name"
                                    placeholder="E-Commerce" required>
                                <div class="invalid-feedback">
                                    Please fill up project name.
                                </div>
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
                                            <label for="project">Project Specific Skill <span
                                                    class="text-danger">[Required]</span> </label>
                                            <div class="form-footer mt-2">
                                                <button class="btn btn-sm p-1 btn-success" type="button" id="new_create"><i
                                                        class="fe fe-plus"></i>
                                                    Add new page</button>
                                            </div>
                                        </div>
                                        <div id="row">
                                            <div class="input-group mt-2">
                                                <div class="input-group-prepend">
                                                    <i class="icon icon-minus text-danger me-2 p-0 fs-16"
                                                        id="DeleteRow"></i>
                                                </div>
                                                <input type="text" class="form-control" id="project" name="pages[]"
                                                    placeholder="e.g Login | Register" required>
                                            </div>
                                        </div>
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
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra_js')
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('backend/assets/js/addNewInputField.js') }}"></script>
@endsection
