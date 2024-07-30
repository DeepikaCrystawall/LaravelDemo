@extends('layouts.frontend')
@section('content')
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">My Account</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">My Account</li>
    </ol>
</div>
<!-- Single Page Header End -->
<div class="container">

<div class="topic">CSS Vertical Tab</div>

<div class="content">
    <input type="radio" name="slider" checked id="home">
    <input type="radio" name="slider" id="blog">
    
    <div class="list">
        <label for="home" class="home">
            <span>Profile</span>
        </label>
        <label for="blog" class="blog">
            <span>Tickets</span>
        </label>
        
        <div class="slider"></div>
    </div>

    <div class="text-content mt-6">
            @session('success')
            <div class="alert alert-success alert-dismissible fade show">{{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endsession
        <div class="home text">
            <div class="title">Profile</div>
            <form action="profile-update" method="post">
                @csrf
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="form-item w-100">
                            <label class="form-label my-3">Name<sup>*</sup></label>
                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-item w-100">
                            <label class="form-label my-3">Email<sup>*</sup></label>
                                <input type="text" class="form-control" name="email" value="{{ Auth::user()->email}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-item w-100">
                            <label class="form-label my-3">Phone<sup>*</sup></label>
                                <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone}}">
                        </div>
                    </div>
                </div>
                <div class="g-2 mt-4">
                    <button type="submit" class="btn btn-primary border-2 border-secondary  text-white h-100"  >Update</button>
                </div>
            </form>
        </div>
        <div class="blog text">
            <div class="title">Tickets</div>
            <!-- <button class="btn btn-success mt-2 mb-2">Create New Ticket +</button> -->
                @if ($tickets->isEmpty())
                <p>No tickets found.</p>
                @else
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">SL.No</th>
                            <th scope="col">Title</th>
                            <th scope="col">Product</th>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created On</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $tky=>$tckt)
                           <tr>
                              <td>{{++$tky}}</td>
                              <td>{{ $tckt->title}}</td>
                              <td>{{ $tckt->product->title}}</td>
                              <td>{{ $tckt->description}}</td>
                              <td>{{ $tckt->status}}</td>
                              <td>{{ $tckt->created_at}}</td>
                              <td>
                                <button type="button" class="btn btn-primary ticket-reply" id="{{ $tckt->id}}" data-bs-toggle="modal" data-bs-target="#staticBackdrop">View</button></td>
                           </tr>
                        @endforeach
                    </tbody>

                </table>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade " id="staticBackdrop"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog model-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Ticket Replies</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="reply-body"></div>
      </div>
     
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script>
      $(document).ready(function() {
    
    $('.ticket-reply').click(function(event) {
       var id = $(this).attr('id');
       $.ajax({
            url: "<?php echo url('view-tickets'); ?>",
            method: "POST",
            data: {
                ticket_id: id,
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
               $('.reply-body').html(response);
            }
        });
        });
    });
</script>
@endsection