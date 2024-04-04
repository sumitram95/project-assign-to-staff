@extends('backend.layouts.main')
@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Assign</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Assign</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <div class="col-xl-12 col-md-12">
        <form action="{{ route('assign.project.store') }}" class="card" method="POST">
            @csrf
            <div class="card-header">
                <h3 class="card-title">Assign StaffF</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Select Project Name</label>
                    <select name="project_name_id" id="change_id" class="form-control form-select select2" required>
                        <option value="{{ $project->id }}">
                            {{ $project->project_name }}</option>
                    </select>
                    @error('project_name_id')
                        <span class="text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label class="form-label">Pages</label>
                        <select class="js-example-basic-multiple form-select select2" name="page_id[]" multiple="multiple"
                            required>
                            @forelse ($project->projectPages ?? [] as $project_page)
                                <option class="form-control form-select select2" value="{{ $project_page->id }}">
                                    {{ $project_page->project_page }}</option>
                            @empty
                                <option value="" selected>No Project</option>
                            @endforelse
                        </select>
                        @error('page_id')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label class="form-label">Select Staff</label>
                        <select class="js-example-basic-multiple form-control form-select select2" name="users_id[]"
                            multiple="multiple" required>
                            @forelse ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->userInfo->full_name }}
                                    ({{ $user->userInfo->userPosition->position }})</option>
                            @empty
                                <option value="" selected>No Staff</option>
                            @endforelse
                        </select>
                        @error('users_id')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-footer mt-2">
                    <button class="btn btn-primary" type="submit">Assign</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('extra_js')
    {{-- <script src="{{ asset('assets/js/form-validation.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    {{-- <script>
        $(document).ready(function() {
            let page = document.getElementById("pages");
            page.style.display = "none";
            $('select[id="change_id"]').change(function() {
                $("#state-dd").html('');
                $.ajax({
                    type: "POST",
                    url: "{{ route('fetch.pages') }}", // Update with your actual route name
                    data: {
                        project_name_id: $(this).val(),
                        _token: "{{ csrf_token() }}" // Add CSRF token for security
                    },
                    dataType: 'json',
                    success: function(result) {
                        // Handle the response data, e.g., update the UI
                        $('#pages').html('<option value="">Choose Page</option>');
                        $.each(result.pages, function(key, value) {
                            $("#pages").append('<option value="' + value
                                .id + '">' + value.project_page + '</option>');
                        });
                        console.log(result);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });
    </script> --}}

    <!-- SELECT2 JS -->
    <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
