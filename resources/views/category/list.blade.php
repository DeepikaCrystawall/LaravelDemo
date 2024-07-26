@extends('layouts.master')
@section('content')
<div class="container">
    <h1>{{ $title}}</h1>
    <a href="{{ route('category.create')}}" class="btn btn-success mb-4">Create +</a>  
    <div class="card">
        <div class="card-body">
            @session('success')
            <div class="alert alert-success alert-dismissible fade show">{{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endsession
            @if ($category->isEmpty())
                <p>No Category found.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th>SL No</th>
                            <th>Title</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $ckey =>$catgry)
                                <tr>
                                    <td>{{$ckey+1}}</td>
                                    <td>{{ $catgry->title }}</td>                                  
                                    <td>
                                        <a href="{{ route('category.edit',$catgry->id)}}" class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>
                                        <a href="{{ url('category/delete',$catgry->id)}}" class="btn btn-danger delete"><i class="fas fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
               
                <!-- Pagination links -->
            @endif
        </div>
    </div>
</div>



@endsection

