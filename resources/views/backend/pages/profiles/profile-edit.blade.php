@extends('backend.layouts.main')
@section('content')
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">Edit Profile</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">DashBoard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Profile</h3>
                    </div>
                    <form action="{{ route('profile.edit.page.data.store') }}" method="post" enctype="multipart/form-data"
                        class="needs-validation" novalidate="">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group" id="add_input_inside">
                                <label for="formFile" class="form-label mt-0">Profile Photo Upload</label>
                                @if ($user->userInfo->profile_img)
                                    <img class="rounded object-fit-cover"
                                        src="{{ asset('storage/uploads/profile/' . $user->userInfo->profile_img) }}"
                                        alt="" width="100" height="100">
                                    <button type="button" class="btn btn-primary p-1 m-2"
                                        id="input_btn_click">Change</button>
                                @else
                                    <input class="form-control" type="file" name="profile_img" required>
                                @endif
                                <div class="invalid-feedback">
                                    Please Fill up this field.
                                </div>
                                @error('profile_img')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputname">Full Name</label>
                                        <input type="text" class="form-control" name="full_name"
                                            value="{{ old('full_name') ?? ($user?->userInfo?->full_name ?? 'null') }}"
                                            id="exampleInpu tname" placeholder="First Name" required>
                                        <div class="invalid-feedback">
                                            Please Fill up full name.
                                        </div>
                                        @error('full_name')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">About Me</label>
                                <textarea class="form-control" rows="6" name="about_me" required>{{ old('about_me') ?? ($user->userInfo->about_me ?? '') }}</textarea>
                                <div class="invalid-feedback">
                                    Please Fill up about you.
                                </div>
                                @error('about_me')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Skills</label>
                                <textarea class="form-control" rows="6" name="skills" placeholder="HTML,CSS,JavaScript, etc" required>{{ old('skills') ?? ($user->userInfo->skills ?? '') }}</textarea>
                                <div class="invalid-feedback">
                                    Please fill up this field.
                                </div>
                                @error('skills')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 mb-0">
                                    <div class="form-group">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" name="date_of_birth"
                                            value="{{ old('date_of_birth') ?? ($user->userInfo->date_of_birth ?? '') }}"
                                            required>
                                        <div class="invalid-feedback">
                                            Please Fill up this field.
                                        </div>
                                        @error('date_of_birth')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6 mb-0">
                                    <div class="form-group">
                                        <label for="exampleInputnumber" class="form-label">Contact Number</label>
                                        <input type="number" id="exampleInputnumber" class="form-control" name="mobile_no"
                                            placeholder="98XXXXXXX"
                                            value="{{ old('mobile_no') ?? ($user->userInfo->mobile_no ?? '') }}" required>
                                        <div class="invalid-feedback">
                                            Please Fill up this field.
                                        </div>
                                        @if (session()->has('extra'))
                                            <span class="text text-danger">{{ session()->get('extra') }}</span>
                                        @endif
                                        @error('mobile_no')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 mb-0">
                                    <div class="form-group">
                                        <label for="admission_date">Admission or Passout</label>
                                        <input type="text" class="form-control" name="admission_date" id="admission_date"
                                            placeholder="E.g 2080-2084"
                                            value="{{ old('admission_date') ?? ($user->userInfo->admission_date ?? '') }}"
                                            required>
                                        <div class="invalid-feedback">
                                            Please Fill up this field.
                                        </div>
                                        @error('admission_date')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6 mb-0">
                                    <div class="form-group">
                                        <label for="collage_name">Collage Name</label>
                                        <input type="text" class="form-control" name="collage_name"
                                            value="{{ old('collage_name') ?? ($user->userInfo->collage_name ?? '') }}"
                                            id="collage_name" placeholder="E.g Kathmandu University" required>
                                        <div class="invalid-feedback">
                                            Please Fill up this field.
                                        </div>
                                        @error('collage_name')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-success my-1">Update</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ROW-1 CLOSED -->

    </div>
@endsection
@section('extra_js')
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    <!-- SHOW PASSWORD JS -->
    <script src="{{ asset('assets/js/show-password.min.js') }}"></script>
    <!-- FILE UPLOADES JS -->
    <script src="../assets/plugins/fileuploads/js/fileupload.js"></script>
    {{-- <script src="../assets/plugins/fileuploads/js/file-upload.js"></script> --}}

    <script>
        let input_btn_click = document.getElementById("input_btn_click");
        let add_input_inside = document.getElementById("add_input_inside");

        input_btn_click.addEventListener("click", function(e) {
            add_input_inside.innerHTML =
                ` <label for="formFile" class="form-label mt-0">Profile Photo Upload</label><input class="form-control" type="file" name="profile_img" required>`;
        });
    </script>
@endsection
