@extends('backend.layouts.main')
@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Error</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('errors.website.index') }}">Error</a></li>
                <li class="breadcrumb-item active" aria-current="page">code</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <!-- ROW-1 -->

    <h6 class="text-danger">Error :- {{ $error->error }}</h6>
    <pre class="text-light bg-dark">
        {{ $error->controller_name }}
         {
            {{ $error->method }}(){
                 <span class="text-warning">{{ $error->error }}</span>
           }
        }
    </pre>
@endsection
