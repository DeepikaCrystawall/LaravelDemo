@extends('layouts.master')
@section('content')
<div class="container">
<form action="{{ $action }}" method="post" enctype="multipart/form-data">
    @csrf
    @if(!empty($row))
     @method('PUT')
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="Name">Product Name</label>
                <input type="text" class="form-control" id="" name="title" placeholder="Enter Title" required value="{{ @$row->title}}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="" name="price" placeholder="Enter price" required value="{{ @$row->price}}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="Category">Category</label>
                <select class="form-control" name="category_id">
                    @foreach($category as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="Short Description">Short Desc</label>
                <textarea class="form-control"  name="short_desc" rows="10">{{ @$row->short_desc}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="Description">Description</label>
                <textarea class="form-control" id="myeditor" name="description" rows="10">{{ @$row->description}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="Image">Image</label>
                
                <input type="file"  name="image" >
                @if(@$row->image)
                <!-- <img width="50px" class="mt-10" src="{{ asset('uploads/products/small/'.@$row->image)}}"><br> -->
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="Image Alt">Image Alt</label>
                <input type="text" class="form-control" id="" name="image_alt" placeholder="Enter Title" value="{{ @$row->image_alt}}">
            </div>
        </div>
    </div>
  
  <button type="submit" class="btn btn-primary">{{ $btn_name}}</button>
</form>
</div>
@endsection