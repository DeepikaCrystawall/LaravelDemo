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
                <label for="Name">Name</label>
                <input type="text" class="form-control" id="" name="name" placeholder="Enter Name" required value="{{ @$row->name}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="EMail">Email address</label>
                <input type="email" class="form-control" id="" name="email" placeholder="Enter email" required value="{{ @$row->email}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="Phone">Phone</label>
                <input type="text" class="form-control" id="Phone" name="phone" placeholder="Enter Phone" required value="{{ @$row->phone}}">
            </div>
        </div>
    </div>
  
  <button type="submit" class="btn btn-primary">{{ $btn_name}}</button>
</form>
</div>
@endsection