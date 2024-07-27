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
                            @foreach ($products as $pkey =>$product)
                                <tr>
                                    <td>{{$pkey +1}}</td>
                                    <td><img width="50px" src="{{ asset('uploads/products/small/'.$product->image)}}"></td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->price}}</td>                                   
                                    <td>
                                        <a href="{{ route('products.edit',$product->id)}}" class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>
                                        <a href="{{ url('products/delete',$product->id)}}" class="btn btn-danger delete"><i class="fas fa-trash"></i> Delete</a>
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

