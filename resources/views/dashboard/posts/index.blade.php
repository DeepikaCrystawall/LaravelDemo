@extends('layouts.master')

@section('title', 'Post List | Luis N Vaya')

@section('content')

<section class="pt-8 pt-md-11">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md">
                <a href="{{ route('home') }}" class="btn btn-link">
                    <i class="fe fe-arrow-left mr-2"></i> Back
                </a>
            </div>
            <div class="col-auto">
                <a href="{{ route('posts.create') }}" class="btn btn-primary">
                    Write Post
                </a>
            </div>
        </div>
    </div>
</section>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <hr class="border-gray-300">
        </div>
    </div>
</div>

<section class="pt-6 pt-md-8">
    <div class="container pb-8 pb-md-11 border-bottom border-gray-300">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive mb-7 mb-md-9">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>
                                    <span class="h6 text-uppercase font-weight-bold">
                                        Title
                                    </span>
                                </th>
                                <th>
                                    <span class="h6 text-uppercase font-weight-bold">
                                        Body
                                    </span>
                                </th>
                                <th>
                                    <span class="h6 text-uppercase font-weight-bold">
                                        Tags
                                    </span>
                                </th>
                                <th>
                                    <span class="h6 text-uppercase font-weight-bold">
                                        Published
                                    </span>
                                </th>
                                <th>
                                    <span class="h6 text-uppercase font-weight-bold">
                                        Action
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($posts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td>{!! Illuminate\Support\Str::limit($post->body, 100) !!}</td>
                                    <td>{{ $post->tags }}</td>
                                    <td>{{ $post->published }}</td>
                                    <td>
                                        @can('blog-list')
                                            @php
                                                $label = $post->published == 'Yes' ? 'Draft' : 'Publish';
                                            @endphp
                                            <a href="{{ url("/posts/{$post->id}/publish") }}" class="btn btn-warning btn-sm">{{ $label }}</a>
                                        @endcan
                                        <a href="{{ url("/posts/{$post->id}") }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Show</a>
                                        <a href="{{ url("/posts/{$post->id}/edit") }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="{{ url("/posts/{$post->id}/delete") }}" class="btn btn-danger btn-sm" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?"><i class="fa fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No posts available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
