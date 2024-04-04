@extends('backend.layouts.main')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Profile</h1>
        <div>
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="javascript:void(0)">Pages</a></li> --}}
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <!-- ROW-1 OPEN -->
    <div class="row" id="user-profile">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="wideget-user mb-2">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="row">



                                    <div class="text-center">
                                        @if (!isset($user->userInfo->profile_img))
                                            <img src="{{ asset('uploads/images/defult_user_logo.png') }}"
                                                alt="img"width="100" class="rounded-circle">
                                        @else
                                            <img src="{{ asset('storage/uploads/profile/' . $user->userInfo->profile_img) }}"
                                                alt="img" width="100" height="100" class="rounded-circle">
                                        @endif
                                        {{-- <img src="https://i.imgur.com/bDLhJiP.jpg" width="100" class="rounded-circle"> --}}
                                    </div>

                                    <div class="text-center mt-3">
                                        <h4 class="mt-2 mb-0"> {{ $user->userInfo->full_name }}</h4>

                                        <h5 class="mt-2 mb-0 badge bg-success">{{ $user->getRoleNames()->first() }}</h5>
                                        <span class="badge bg-warning">{{ $user->userInfo->userPosition->position }}</span>

                                        <div class="px-4 mt-1">
                                            @if (isset($user->userInfo->about_me))
                                                <div>
                                                    <h5>Biography</h5>
                                                    <p class="fonts">{!! $user->userInfo->about_me !!}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($user->userInfo->address)
                                <div class="d-flex align-items-center mb-3 mt-3">
                                    <div class="me-4 text-center text-primary">
                                        <span><i class="fe fe-map-pin fs-20"></i></span>
                                    </div>
                                    <div>
                                        <strong>{{ $user->userInfo->address ?? 'Empty' }}</strong>
                                    </div>
                                </div>
                            @endif
                            @if ($user->userInfo->mobile_no)
                                <div class="d-flex align-items-center mb-3 mt-3">
                                    <div class="me-4 text-center text-primary">
                                        <span><i class="fe fe-phone fs-20"></i></span>
                                    </div>
                                    <div>
                                        <strong>{{ $user->userInfo->mobile_no ?? 'Empty' }}</strong>
                                    </div>
                                </div>
                            @endif

                            <div class="d-flex align-items-center mb-3 mt-3">
                                <div class="me-4 text-center text-primary">
                                    <span><i class="fe fe-mail fs-20"></i></span>
                                </div>
                                <div>
                                    <strong>{{ $user->email }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (!empty(array_filter($skills, 'strlen')))
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Skills</div>
                            </div>
                            <div class="card-body">
                                <div class="tags">
                                    @forelse ($skills ?? [] as $skill)
                                        <a href="#" class="tag">{{ $skill ?? 'Empty' }}</a>
                                    @empty
                                        <a href="#" class="tag">Empty</a>
                                    @endforelse

                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Work & Education</div>
                        </div>
                        <div class="card-body">
                            <div class="main-profile-contact-list">
                                <div class="me-5">
                                    <div class="media mb-4 d-flex">
                                        <div class="media-icon bg-primary  mb-3 mb-sm-0 me-3 mt-1">
                                            <svg style="width:24px;height:24px;margin-top:-8px" viewBox="0 0 24 24">
                                                <path fill="#fff"
                                                    d="M12 3L1 9L5 11.18V17.18L12 21L19 17.18V11.18L21 10.09V17H23V9L12 3M18.82 9L12 12.72L5.18 9L12 5.28L18.82 9M17 16L12 18.72L7 16V12.27L12 15L17 12.27V16Z" />
                                            </svg>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="font-weight-semibold mb-1">
                                                {{ $user->userInfo->userPosition->position }} at <a
                                                    href="javascript:void(0)" class="btn-link">Sys Qube</a></h6>
                                            <span>{{ $user->userInfo->userPosition->created_at }}</span>
                                            {{-- <p>Past Work: Spruko, Inc.</p> --}}
                                        </div>
                                    </div>
                                </div>
                                @if ($user->userInfo->admission_date || $user->userInfo->collage_name)
                                    <div class="me-5 mt-5 mt-md-0">
                                        <div class="media mb-4 d-flex">
                                            <div class="media-icon bg-success text-white mb-3 mb-sm-0 me-3 mt-1">
                                                <svg style="width:24px;height:24px;margin-top:-8px" viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M20,6C20.58,6 21.05,6.2 21.42,6.59C21.8,7 22,7.45 22,8V19C22,19.55 21.8,20 21.42,20.41C21.05,20.8 20.58,21 20,21H4C3.42,21 2.95,20.8 2.58,20.41C2.2,20 2,19.55 2,19V8C2,7.45 2.2,7 2.58,6.59C2.95,6.2 3.42,6 4,6H8V4C8,3.42 8.2,2.95 8.58,2.58C8.95,2.2 9.42,2 10,2H14C14.58,2 15.05,2.2 15.42,2.58C15.8,2.95 16,3.42 16,4V6H20M4,8V19H20V8H4M14,6V4H10V6H14M12,9A2.25,2.25 0 0,1 14.25,11.25C14.25,12.5 13.24,13.5 12,13.5A2.25,2.25 0 0,1 9.75,11.25C9.75,10 10.76,9 12,9M16.5,18H7.5V16.88C7.5,15.63 9.5,14.63 12,14.63C14.5,14.63 16.5,15.63 16.5,16.88V18Z" />
                                                </svg>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="font-weight-semibold mb-1">Studied at <a
                                                        href="javascript:void(0)"
                                                        class="btn-link">{{ $user->userInfo->collage_name ?? 'Empty' }}</a>
                                                </h6>
                                                <span>{{ $user->userInfo->admission_date ?? 'Empty' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="profile-edit">
                                <textarea class="form-control" placeholder="What's in your mind right now" rows="7"></textarea>
                                <div class="profile-share border-top-0">
                                    <div class="mt-2">
                                        <a href="javascript:void(0)" class="me-2" title="Audio"
                                            data-bs-toggle="tooltip" data-bs-placement="top"><span class="text-muted"><i
                                                    class="fe fe-mic"></i></span></a>
                                        <a href="javascript:void(0)" class="me-2" title="Video"
                                            data-bs-toggle="tooltip" data-bs-placement="top"><span class="text-muted"><i
                                                    class="fe fe-video"></i></span></a>
                                        <a href="javascript:void(0)" class="me-2" title="Image"
                                            data-bs-toggle="tooltip" data-bs-placement="top"><span class="text-muted"><i
                                                    class="fe fe-image"></i></span></a>
                                    </div>
                                    <button class="btn btn-sm btn-success ms-auto"><i class="fa fa-share ms-1"></i>
                                        Share</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
        <!-- COL-END -->
    </div>
    <!-- ROW-1 CLOSED -->
@endsection
