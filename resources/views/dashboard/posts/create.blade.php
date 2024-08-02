@extends('layouts.master')

@section('title', 'Create Post | Luis N Vaya')

@section('content')

<section class="pt-8 pt-md-11">
    <div class="container">
        <div class="row align-items-center mb-4">
            <div class="col-12 col-md">
                <a href="{{ route('posts.index') }}" class="font-weight-bold font-size-sm text-decoration-none">
                    <i class="fe fe-arrow-left mr-3"></i> Back
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <hr class="border-gray-300">
            </div>
        </div>

        <form id="postForm" class="form-horizontal" action="{{ !empty($row) ? route('posts.update', $row->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @if(!empty($row))
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-12 col-md-9">
                    <div class="form-group">
                        <label for="title" class="font-weight-bold">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', @$row->title) }}" placeholder="Enter Title">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="body" class="font-weight-bold">Body</label>
                        <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="6" placeholder="Enter Body">{{ old('body', @$row->body) }}</textarea>
                        @error('body')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="meta_tag" class="font-weight-bold">Meta Tag</label>
                        <input type="text" class="form-control @error('meta_tag') is-invalid @enderror" id="meta_tag" name="meta_tag" value="{{ old('meta_tag', @$row->meta_tag) }}" placeholder="Enter Meta Tag">
                        @error('meta_tag')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="meta_description" class="font-weight-bold">Meta Description</label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="3" placeholder="Enter Meta Description">{{ old('meta_description', @$row->meta_description) }}</textarea>
                        @error('meta_description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="keywords" class="font-weight-bold">Focus Keywords</label>
                        <input type="text" class="form-control @error('keywords') is-invalid @enderror" id="keywords" name="keywords" value="{{ old('keywords', @$row->keywords) }}" placeholder="Enter Keywords">
                        @error('keywords')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tags" class="font-weight-bold">Tags</label>
                        <input type="text" class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags" value="{{ old('tags', @$row->tags) }}" placeholder="Enter Tags">
                        @error('tags')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="slug" class="font-weight-bold">Permalink</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', @$row->slug) }}" placeholder="Enter Slug">
                        @error('slug')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="images" class="font-weight-bold">Image</label>
                        <input type="file" class="form-control-file @error('images') is-invalid @enderror" id="images" name="image" onchange="readURL(this);">
                        @if(@$row->images)
                            <img id="imagePreview" src="{{ asset('uploads/posts/' . @$row->images) }}" alt="Image Preview" class="mt-2" style="max-width: 100%; height: auto;">
                        @else
                            <img id="imagePreview" src="#" alt="Image Preview" class="mt-2" style="display: none; max-width: 100%; height: auto;">
                        @endif
                        @error('images')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12 text-right">
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary mr-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">{{ !empty($row) ? 'Update' : 'Create' }}</button>
                </div>
            </div>
        </form>
    </div>
</section>

<script type="text/javascript">
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection
