@extends('backend.layouts.main')
@section('content')
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">Change Password</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">DashBoard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Change</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->
        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Change Password</div>
                    </div>
                    <form action="{{ route('password.change.store') }}" class="needs-validation" novalidate=""
                        method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Current Password</label>
                                <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                    </a>
                                    <input class="input100 form-control" type="password" name="current_password"
                                        placeholder="Current Password" autocomplete="current-password" required>
                                    <div class="invalid-feedback">
                                        Please fill up current password.
                                    </div>
                                </div>
                                @error('current_password')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">New Password</label>
                                <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                    </a>
                                    <input class="input100 form-control" type="password" name="new_password"
                                        placeholder="New Password" autocomplete="new-password" required>
                                    <div class="invalid-feedback">
                                        Please fill up new password.
                                    </div>
                                    @error('new_password')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Confirm Password</label>
                                <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                    </a>
                                    <input class="input100 form-control" type="password" name="comfirm_password"
                                        placeholder="Confirm Password" autocomplete="new-password" required>
                                    <div class="invalid-feedback">
                                        Please fill up comfirm password.
                                    </div>
                                    @error('comfirm_password')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Change</a>
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
