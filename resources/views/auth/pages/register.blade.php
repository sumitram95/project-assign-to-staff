@extends('auth.layout.main')

@section('content')
    <div class="row">
        <div class="col-md-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Register</h3>
                </div>
                <form action="{{ route('register.store') }}" class="needs-validation was-validated" novalidate=""
                    method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6 mb-0">
                                <div class="form-group">
                                    <label for="validationTooltip01">Full name</label>
                                    <input type="text" class="form-control" id="validationTooltip01" name="full_name"
                                        placeholder="Full Name" value="{{ old('full_name') }}" required="">
                                    @error('full_name')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6 mb-0">
                                <div class="form-group ">
                                    <label for="inputEmail5">Email Address</label>
                                    <input type="email" class="form-control" id="inputEmail5" placeholder="Email Address"
                                        name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 mb-0">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Password" required>
                                    @error('password')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6 mb-0">
                                <div class="form-group">
                                    <label for="comf_pawrd">Comfirm Password</label>
                                    <input type="password" class="form-control" id="comf_pawrd" name="comformation_password"
                                        placeholder="Comfirm Password" required>
                                    @error('comformation_password')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label class="form-label">Choose</label>
                            <select class="form-control form-select select2" name="position" required>
                                <option value="">Choose</option>
                                @forelse ($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->position }}</option>
                                @empty
                                    <option selected>No Data</option>
                                @endforelse
                            </select>
                            @error('position')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        <div class="form-footer mt-2">
                            <button class="btn btn-primary" type="submit">Sign Up</button>
                            <p class="right">Have a Account ? <a href="{{ route('login') }}">Login</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('extra_js')
    {{-- validation --}}
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    <!-- INTERNAL SELECT2 JS -->
    <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endsection
