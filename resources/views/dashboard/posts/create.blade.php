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
            <div class="col-auto">
                <a href="{{ route('posts.index') }}" class="btn btn-secondary mr-2">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary" form="postForm">
                    Create
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <hr class="border-gray-300">
            </div>
        </div>

        <form id="postForm" class="form-horizontal" action="{{ url('posts') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf

            <div class="row">
                <div class="col-12 col-md-9">
                    <div class="form-group">
                        <label for="title" class="font-weight-bold">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Enter Title">
                        <div class="text-danger" id="titleErro"></div>
                    </div>

                    <div class="form-group">
                        <label for="body" class="font-weight-bold">Body</label>
                        <textarea class="form-control" id="body" name="body" rows="6" placeholder="Enter Body">{{ old('body') }}</textarea>
                        <div class="text-danger" id="bodyErro"></div>
                    </div>

                    <div class="form-group">
                        <label for="meta_tag" class="font-weight-bold">Meta Tag</label>
                        <input type="text" class="form-control" id="meta_tag" name="meta_tag" value="{{ old('meta_tag') }}" placeholder="Enter Meta Tag">
                        <div class="text-danger" id="meta_tagErro"></div>
                    </div>

                    <div class="form-group">
                        <label for="meta_description" class="font-weight-bold">Meta Description</label>
                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Enter Meta Description">{{ old('meta_description') }}</textarea>
                        <div class="text-danger" id="meta_descriptionErro"></div>
                    </div>

                    <div class="form-group">
                        <label for="keywords" class="font-weight-bold">Focus Keywords</label>
                        <input type="text" class="form-control" id="keywords" name="keywords" value="{{ old('keywords') }}" placeholder="Enter Keywords">
                        <div class="text-danger" id="keywordsErro"></div>
                    </div>

                    <div class="form-group">
                        <label for="tags" class="font-weight-bold">Tags</label>
                        <input type="text" class="form-control" id="tags" name="tags" value="{{ old('tags') }}" placeholder="Enter Tags">
                        <div class="text-danger" id="tagsErro"></div>
                    </div>

                    <div class="form-group">
                        <label for="slug" class="font-weight-bold">Permalink</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Enter Slug">
                        <div class="text-danger" id="slugErro"></div>
                    </div>

                    <div class="form-group">
                        <label for="images" class="font-weight-bold">Image</label>
                        <input type="file" class="form-control-file" id="images" name="images" onchange="readURL(this);">
                        <img id="imagePreview" src="#" alt="Image Preview" class="mt-2" style="display: none; max-width: 100%; height: auto;">
                        <div class="text-danger" id="imagesErro"></div>
                    </div>
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
            $('#imagePreview').attr('src', e.target.result).show();
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection
