
@extends('layouts.master')
@section('content')
<div class="container">
    <h2>{{ $title}}</h2> 
    <a href="{{ route('users.create')}}" class="btn btn-success mb-4">Create +</a>  
    @if (session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
    @endif    
    <div class="card">
      <div class="card-body">    
        <div class="table-responsive">
          <table class="table table-striped">
              <thead>
                <tr>
                  <th>Firstname</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($users as $user)
                  <tr>
                  <td>{{ $user->name}}</td>
                  <td>{{ $user->email}}</td>
                  <td>{{ $user->phone}}</td>
                  <td>
                      <a href="{{ route('users.edit',$user->id)}}" class="btn btn-info"><i class="fas fa-info-circle"></i> Edit</a>
                      <!-- <a href="{{ route('users.destroy',$user->id)}}" class="btn btn-danger delete"> Delete</a></td> -->
                      <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger delete" type="submit">Delete</button>
                </form>
                      <!-- <a href="{{ url('users/delete',$user->id)}}" class="btn btn-danger delete"> Delete</a></td> -->
                </tr>
                  @endforeach
              </tbody>
            </table>
        </div>
        {{ $users->links() }}
      </div>
    </div>
</div>

@endsection