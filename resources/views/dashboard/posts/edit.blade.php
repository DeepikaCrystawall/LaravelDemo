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
                <div class="form-group">
                    <label for="body" class="text-uppercase font-weight-bold">Body</label>
                    <textarea name="body" id="body" rows="25" class="form-control" style="height:500px;">{{ old('body', $body) }}</textarea>
                    <div class="text-danger" id="bodyError"></div>
                    @if($errors->has('body'))
                        <div class="text-danger">{{ $errors->first('body') }}</div>
                    @endif
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title" class="text-uppercase font-weight-bold">Title</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title', $title) }}" placeholder="Enter Title">
                            @if($errors->has('title'))
                                <div class="text-danger">{{ $errors->first('title') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="slug" class="text-uppercase font-weight-bold">Permalink</label>
                            <input type="text" class="form-control" name="slug" value="{{ old('slug', $slug) }}" placeholder="Enter Slug">
                            @if($errors->has('slug'))
                                <div class="text-danger">{{ $errors->first('slug') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="images" class="text-uppercase font-weight-bold">Image</label>
                            <input type="file" class="form-control-file" name="images">
                            @if($errors->has('images'))
                                <div class="text-danger">{{ $errors->first('images') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="tags" class="text-uppercase font-weight-bold">Tag</label>
                            <input type="text" class="form-control" name="tags" value="{{ old('tags', $tags) }}" placeholder="Enter Tags">
                            @if($errors->has('tags'))
                                <div class="text-danger">{{ $errors->first('tags') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="meta_tag" class="text-uppercase font-weight-bold">Meta Tag</label>
                            <input type="text" class="form-control" name="meta_tag" value="{{ old('meta_tag', $meta_tag) }}" placeholder="Enter Meta Tag">
                            @if($errors->has('meta_tag'))
                                <div class="text-danger">{{ $errors->first('meta_tag') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="meta_description" class="text-uppercase font-weight-bold">Meta Description</label>
                            <input type="text" class="form-control" name="meta_description" value="{{ old('meta_description', $meta_description) }}" placeholder="Enter Meta Description">
                            @if($errors->has('meta_description'))
                                <div class="text-danger">{{ $errors->first('meta_description') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="keywords" class="text-uppercase font-weight-bold">Focus Keywords</label>
                            <input type="text" class="form-control" name="keywords" value="{{ old('keywords', $keywords) }}" placeholder="Enter Keywords">
                            @if($errors->has('keywords'))
                                <div class="text-danger">{{ $errors->first('keywords') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

<script type="text/javascript">
function readURL(input) {
    if (input.images && input.images[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#imagePreview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection
