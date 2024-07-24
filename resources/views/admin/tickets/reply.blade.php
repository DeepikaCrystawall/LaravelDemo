@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Replies</h1>

    <div class="card">
        <div class="card-body">

            <form action="{{route('replyupdate',['ticketid'=>$ticketdetails->id])}}" method="post">
                @csrf
            <input type="hidden" name="ticketid" value="{{$ticketdetails->id}}">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Reply for {{$ticketdetails->title}}</label>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Reply</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
