@extends('backend.layouts.main')
@section('content')
    <div class="main-container container-fluid">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">Edit Profile</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="col-xl-8">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Notifications</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group mg-b-10">
                                    <label class="custom-switch ps-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                            checked="">
                                        <span class="custom-switch-indicator me-3"></span>
                                        <span class="custom-switch-description mg-l-10">Updates Automatically</span>
                                    </label>
                                </div>
                                <div class="form-group mg-b-10">
                                    <label class="custom-switch ps-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                        <span class="custom-switch-indicator me-3"></span>
                                        <span class="custom-switch-description mg-l-10">Allow Location Map</span>
                                    </label>
                                </div>
                                <div class="form-group mg-b-10">
                                    <label class="custom-switch ps-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                            checked="">
                                        <span class="custom-switch-indicator me-3"></span>
                                        <span class="custom-switch-description mg-l-10">Show Contacts</span>
                                    </label>
                                </div>
                                <div class="form-group mg-b-10">
                                    <label class="custom-switch ps-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                            checked="">
                                        <span class="custom-switch-indicator me-3"></span>
                                        <span class="custom-switch-description mg-l-10">Show Notfication</span>
                                    </label>
                                </div>
                                <div class="form-group mg-b-10">
                                    <label class="custom-switch ps-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                        <span class="custom-switch-indicator me-3"></span>
                                        <span class="custom-switch-description mg-l-10">Show Tasks Statistics</span>
                                    </label>
                                </div>
                                <div class="form-group mg-b-10">
                                    <label class="custom-switch ps-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                            checked="">
                                        <span class="custom-switch-indicator me-3"></span>
                                        <span class="custom-switch-description mg-l-10">Show Email Notification</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Privacy and Security</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group mg-b-10">
                                    <label class="custom-switch ps-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                            checked="">
                                        <span class="custom-switch-indicator me-3"></span>
                                        <span class="custom-switch-description mg-l-10">Allow Others to see my
                                            profile</span>
                                    </label>
                                </div>
                                <div class="form-group mg-b-10">
                                    <label class="custom-switch ps-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                        <span class="custom-switch-indicator me-3"></span>
                                        <span class="custom-switch-description mg-l-10">Make my profile Public</span>
                                    </label>
                                </div>
                                <div class="form-group mg-b-10">
                                    <label class="custom-switch ps-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                        <span class="custom-switch-indicator me-3"></span>
                                        <span class="custom-switch-description mg-l-10">Security Alert</span>
                                    </label>
                                </div>
                                <div class="form-group mg-b-10">
                                    <label class="custom-switch ps-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                            checked="">
                                        <span class="custom-switch-indicator me-3"></span>
                                        <span class="custom-switch-description mg-l-10">Passcode and Face ID</span>
                                    </label>
                                </div>
                                <div class="form-group mg-b-10">
                                    <label class="custom-switch ps-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                        <span class="custom-switch-indicator me-3"></span>
                                        <span class="custom-switch-description mg-l-10">Two Step Verification</span>
                                    </label>
                                </div>
                                <div class="form-group mg-b-10">
                                    <label class="custom-switch ps-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                            checked="">
                                        <span class="custom-switch-indicator me-3"></span>
                                        <span class="custom-switch-description mg-l-10">Always Sign In</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Delete Account</div>
                    </div>
                    <div class="card-body">
                        <p>Its Advisable for you to request your data to be sent to your Email.</p>
                        <label class="custom-control custom-checkbox mb-0">
                            <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1"
                                checked="">
                            <span class="custom-control-label">Yes, Send my data to my Email.</span>
                        </label>
                    </div>
                    <div class="card-footer text-end">
                        <a href="javascript:void(0)" class="btn btn-primary my-1">Deactivate</a>
                        <a href="javascript:void(0)" class="btn btn-danger my-1">Delete Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
