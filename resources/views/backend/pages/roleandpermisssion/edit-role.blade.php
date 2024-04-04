@extends('backend.layouts.main')

@section('content')
    <div class="row">
        <div class="page-header">
            <h1 class="page-title">Edit</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Role</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Role</h3>
                    </div>
                    <form action="{{ route('role_permission.updatae_data_store', ['id' => $roleWithPermissions->id]) }}"
                        class="needs-validation" novalidate="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-12 mb-0">
                                    <div class="form-group">
                                        <label class="form-label">Role Name<span class="text-danger"></label>
                                        <input type="text" name="role_name" value="{{ $roleWithPermissions?->name ?? '' }}"
                                            class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                @foreach ($permissions as $permission)
                                    <div class="form-check me-5">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            value="{{ $permission->id }}" id=""
                                            {{ in_array($permission->id, $roleWithPermissionsArray) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
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
    <!-- INTERNAL SELECT2 JS -->
    <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endsection
