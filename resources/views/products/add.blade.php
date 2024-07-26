@extends('layouts.master')
@section('content')
<div class="container">
<form action="{{ $action }}" method="post">
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
        <div class="col-md-6">
            <div class="form-group">
                <label for="EMail">Price</label>
                <input type="email" class="form-control" id="" name="price" placeholder="Enter Price" required value="{{ @$row->price}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="Phone">Phone</label>
                <textarea class="form-control" id="content" name="content" rows="10"></textarea>
            </div>
        </div>
    </div>
  
  <button type="submit" class="btn btn-primary">{{ $btn_name}}</button>
</form>
</div>
@endsection