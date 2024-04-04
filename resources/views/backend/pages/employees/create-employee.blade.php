@extends('backend.layouts.main')

@section('content')
    <div class="row">
        <div class="page-header">
            <h1 class="page-title">Create-Employ</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Employ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Employ</h3>
                    </div>
                    <form action="{{ route('employee.store') }}" class="needs-validation" novalidate="" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-12 mb-0">
                                    <div class="form-group">
                                        <label class="form-label">Full name <span class="text-danger"> [ Required
                                                ]</span></label>
                                        <input type="text" name="full_name" value="{{ old('full_name') }}"
                                            class="form-control" placeholder="Full Name" required>
                                        <div class="invalid-feedback">
                                            Please choose a valid First Name.
                                        </div>
                                        @error('full_name')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 mb-0">
                                    <div class="form-group">
                                        <label class="form-label">Email Address <span class="text-danger"> [
                                                Required ]</span></label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control" id="inputEmail5" placeholder="Email Address" required>
                                        <div class="invalid-feedback">
                                            Please choose a valid Email.
                                        </div>
                                        @error('email')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6 mb-0">
                                    <div class="form-group m-0">
                                        <label class="form-label">Postion <span class="text-danger"> [ Required
                                                ]</span></label>
                                        <select name="position" class="form-control form-select select2" required>
                                            <option value="" selected="">Choose</option>
                                            @forelse ($positions ?? [] as $position)
                                                <option class="text-capitalize" value="{{ $position->id }}">
                                                    {{ $position->position }}</option>
                                            @empty
                                                <option value="" selected>no data found</option>
                                            @endforelse
                                        </select>
                                        <div class="invalid-feedback">
                                            Please choose a valid Position.
                                        </div>
                                        @error('position')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 mb-0">
                                    <label class="form-label">Role <span class="text-danger"> [ Required ]</span></label>
                                    <select name="role" class="form-control form-select select2" required>
                                        <option value="" selected="">Choose</option>
                                        @foreach ($roles ?? [] as $role)
                                            <option class="text-capitalize" value="{{ $role->name }}">
                                                {{ ucfirst($role->name) }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please choose a valid Role.
                                    </div>
                                    @error('role')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 mb-0">
                                    <label class="form-label">Status <span class="text-danger"> [ Required ]</span></label>
                                    <select name="status" class="form-control form-select select2" required>
                                        <option value="" selected="">Choose</option>
                                        <option class="text-capitalize" value="active">Active</option>
                                        <option class="text-capitalize" value="inactive">Inactive
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please choose a valid Status.
                                    </div>
                                    @error('role')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
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
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endsection
