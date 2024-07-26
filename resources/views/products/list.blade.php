@extends('layouts.master')
@section('content')
<div class="container">
    <h1>{{ $title}}</h1>
    <a href="{{ route('products.create')}}" class="btn btn-success mb-4">Create +</a>  
    <div class="card">
        <div class="card-body">
            @session('success')
            <div class="alert alert-success alert-dismissible fade show">{{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endsession
            @if ($products->isEmpty())
                <p>No Products found.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped">
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
                                    <td>
                                    <td>{{ $product->image	}}</td>
                                    <td>{{ $product->title }}</td>
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
                {{ $products->links() }}
                <!-- Pagination links -->
            @endif
        </div>
    </div>
</div>



@endsection

