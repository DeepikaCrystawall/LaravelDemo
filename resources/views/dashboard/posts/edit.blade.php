@extends('layouts.master')

@section('title', 'Post Update | Luis N Vaya')

@section('content')

<section class="pt-8 pt-md-11">
    <form class="form-horizontal" action="{{ url('posts/' . $post->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @method('PUT')
        
        <?php
            $title = $post->title;
            $body = $post->body;
            $meta_tag = $post->meta_tag;
            $meta_description = $post->meta_description;
            $slug = $post->slug;
            $keywords = $post->keywords;
            $tags = $post->tags;
        ?>

        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md">
                    <a href="{{ route('posts.index') }}" class="font-weight-bold font-size-sm text-decoration-none mb-3">
                        <i class="fe fe-arrow-left mr-3"></i> Back
                    </a>
                </div>
                <div class="col-auto">
                    <a href="{{ route('posts.index') }}" class="btn btn-primary-soft mr-1">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <hr class="border-gray-300">
            </div>
        </div>

        <div class="row">
          

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title" class="text-uppercase font-weight-bold">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $title) }}" placeholder="Enter Title">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                    <label for="body" class="text-uppercase font-weight-bold">Body</label>
                    <textarea name="body" id="body" rows="25" class="form-control @error('body') is-invalid @enderror" style="height:500px;">{{ old('body', $body) }}</textarea>
                    @error('body')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                        <div class="form-group">
                            <label for="slug" class="text-uppercase font-weight-bold">Permalink</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug', $slug) }}" placeholder="Enter Slug">
                            @error('slug')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="images" class="text-uppercase font-weight-bold">Image</label>
                            <input type="file" class="form-control-file @error('images') is-invalid @enderror" name="images">
                            @error('images')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tags" class="text-uppercase font-weight-bold">Tags</label>
                            <input type="text" class="form-control @error('tags') is-invalid @enderror" name="tags" value="{{ old('tags', $tags) }}" placeholder="Enter Tags">
                            @error('tags')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_tag" class="text-uppercase font-weight-bold">Meta Tag</label>
                            <input type="text" class="form-control @error('meta_tag') is-invalid @enderror" name="meta_tag" value="{{ old('meta_tag', $meta_tag) }}" placeholder="Enter Meta Tag">
                            @error('meta_tag')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_description" class="text-uppercase font-weight-bold">Meta Description</label>
                            <input type="text" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" value="{{ old('meta_description', $meta_description) }}" placeholder="Enter Meta Description">
                            @error('meta_description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keywords" class="text-uppercase font-weight-bold">Focus Keywords</label>
                            <input type="text" class="form-control @error('keywords') is-invalid @enderror" name="keywords" value="{{ old('keywords', $keywords) }}" placeholder="Enter Keywords">
                            @error('keywords')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

<script type="text/javascript">
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#imagePreview').attr('src', e.target.result).show();
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection
