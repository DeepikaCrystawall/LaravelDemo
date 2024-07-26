@extends('layouts.master')
@section('content')
<div class="container">
<h2>{{ $title}}</h2>
<form action="{{ $action }}" method="post">
    @csrf
    @if(!empty($row))
     @method('PUT')
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="Name">Category</label>
                <input type="text" class="form-control" id="" name="title" placeholder="Enter Title" required value="{{ @$row->title}}">
            </div>
        </div>
    </div>
  
  <button type="submit" class="btn btn-primary">{{ $btn_name}}</button>
</form>
</div>
@endsection