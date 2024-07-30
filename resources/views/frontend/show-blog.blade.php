@extends('layouts.frontend')

@section('content')
<!-- Page Header Start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">{{ $post->title }}</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Articles</a></li>
        <li class="breadcrumb-item active text-white">{{ $post->title }}</li>
    </ol>
</div>
<!-- Page Header End -->

<!-- Post Details Start -->
<div class="container-fluid post-details py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="post-content bg-light rounded p-4">
                    <div class="position-relative">
                        @if($post->image)
                        <img src="{{ asset('assets/post/' . $post->image) }}" class="img-fluid rounded" alt="{{ $post->title }}" />
                        @else
                        <img src="{{ asset('assets/blog/images/posts/latest-sm-1.jpg') }}" class="img-fluid rounded" alt="{{ $post->title }}" />
                        @endif
                    </div>
                    <div class="post-body mt-4">
                        <h2 class="text-dark">{{ $post->title }}</h2>
                        <p class="text-muted">{{ $post->created_at->format('F j, Y') }}</p>
                        <div class="mt-3">
                            {!! $post->body !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Post Details End -->
@endsection
