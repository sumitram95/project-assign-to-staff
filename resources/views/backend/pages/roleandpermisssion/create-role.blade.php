@extends('backend.layouts.main')

@section('content')
    <div class="row">
        <div class="page-header">
            <h1 class="page-title">Create</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Role</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Role</h3>
                    </div>
                    <form action="{{ route('role.store') }}" class="needs-validation" novalidate="" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-12 mb-0">
                                    <div class="form-group">
                                        <label class="form-label">Role Name<span class="text-danger"> [ Required
                                                ]</span></label>
                                        <input type="text" name="role_name" value="{{ old('role_name') }}"
                                            class="form-control" placeholder="Role Name" required="">
                                        <div class="invalid-feedback">
                                            Please choose a valid Role Name.
                                        </div>
                                        @error('role_name')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                @foreach ($permissions as $permission)
                                    <div class="form-check me-5">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            value="{{ $permission->id }}" id="permission_{{ $permission->id }}">
                                        <label class="form-check-label" for="permission_{{ $permission->id }}">
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
