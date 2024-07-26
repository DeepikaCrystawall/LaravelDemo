
@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>{{ $title}}</h2> 
        <a href="{{ route('users.create')}}" class="btn btn-success mb-4">Create +</a>  
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif        
            <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>SL No</th>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td></td>
                    <td>{{ $product->image	}}</td>
                    <td>{{ $product->title}}</td>
                    <td>{{ $product->price}}</td>
                    <td>
                        <a href="{{ route('products.edit',$user->id)}}" class="btn btn-info"><i class="fas fa-info-circle"></i>Edit</a>
                        <a href="{{ url('products/delete',$user->id)}}" class="btn btn-danger delete">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection