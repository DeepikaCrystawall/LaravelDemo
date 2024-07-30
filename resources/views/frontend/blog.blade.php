@extends('layouts.frontend')

@section('content')
<!-- Page Header Start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Articles</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Articles</li>
    </ol>
</div>
<!-- Page Header End -->

<!-- Posts Start -->
<div class="container-fluid posts py-5">
    <div class="container py-5">
        <div class="posts-header text-center">
            <h4 class="text-primary">Articles</h4>
            <h1 class="display-5 mb-5 text-dark">Read Our Latest Articles</h1>
        </div>
        <div class="owl-carousel testimonial-carousel">
            @foreach($posts as $post)
            <div class="post-item img-border-radius bg-light rounded p-4">
                <div class="position-relative">
                    <a href="{{ route('show_blog', $post->id) }}">
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            @if($post->image)
                            <img src="{{ asset('assets/post/' . $post->image) }}" class="img-fluid rounded" alt="{{ $post->title }}" />
                            @else
                            <img src="{{ asset('assets/blog/images/posts/latest-sm-1.jpg') }}" class="img-fluid rounded" alt="{{ $post->title }}" />
                            @endif
                        </div>
                    </a>
                    <div class="post-details d-flex align-items-center flex-nowrap">
                        <div class="ms-4 d-block">
                            <h4 class="text-dark">{{ $post->title }}</h4>
                            <p class="m-0 pb-3">{{ Str::limit($post->body, 100) }} - {{ $post->created_at->format('F j, Y') }}</p>
                            <div class="d-flex pe-5 mt-3">
                            <a href="{{ route('show_blog', $post->id) }}">Read More</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Posts End -->
@endsection
