@extends('backend.layouts.main')

@section('content')
    <div class="row">
        <div class="page-header">
            <h1 class="page-title">Employee</h1>
            <div>
                <ol class="breadcrumb">
                    {{-- <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li> --}}
                    <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Employee</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit</h3>
                    </div>
                    <form action="{{ route('employee.update', $user->employee_id) }}" class="needs-validation was-validated"
                        novalidate="" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-12 mb-0">
                                    <div class="form-group">
                                        <label for="validationTooltip01">Full name</label>
                                        <input type="text" name="full_name"
                                            value="{{ old('full_name') ?? ($user?->full_name ?? '') }}" class="form-control"
                                            id="validationTooltip01" placeholder="Full Name" required="">
                                        <div class="invalid-feedback">
                                            Please choose a valid First Name.
                                        </div>
                                        @error('full_name')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="form-label">Postion</label>
                                    <select name="position" class="form-control form-select select2" required>
                                        @foreach ($positions as $position)
                                            <option value="{{ $position->id }}" class="text-capitalize"
                                                {{ $user?->userPosition?->position == $position?->position ? 'selected' : '' }}>
                                                {{ ucfirst($position->position) }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please choose a valid Position.
                                    </div>
                                    @error('position')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 mb-0">
                                    <div class="form-group">
                                        <label class="form-label">Role</label>
                                        <select name="role" class="text-capitalize form-control form-select select2"
                                            required>
                                            @foreach ($roles as $role)
                                                <option class="text-capitalize" value="{{ $role->name }}"
                                                    {{ $user->user->getRoleNames()->first() == $role->name ? 'selected' : '' }}>
                                                    {{ ucfirst($role->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please choose a valid Role.
                                        </div>
                                        @error('role')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6 mb-0">
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control form-select select2" required>
                                            <option class="text-capitalize" value="active"
                                                {{ $user->status === 'active' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option class="text-capitalize" value="inactive"
                                                {{ $user->status === 'inactive' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please choose a valid Role.
                                        </div>
                                        @error('role')
                                            <span class="text text-danger">{{ $message }}</span>
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
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    <!-- INTERNAL SELECT2 JS -->
    <script src="../assets/plugins/select2/select2.full.min.js"></script>
    <script src="../assets/js/select2.js"></script>
@endsection
