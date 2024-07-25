@extends('layouts.app')
@section('content')
<div class="container">   
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h3>Ticket Details</h3>
                <div class="container">
                    <ul>
                        <li>Title : {{$ticketdetails->title}}</li>
                        <li>Description : {{$ticketdetails->description}}</li>
                        <li>Created Date : {{$ticketdetails->created_at}}</li>
                    </ul>
                </div>
            </div>
            @if (\Auth::user()->role_id != 2)
            <div class="row brdr-btm pt-4 mb-4">
                <form action="{{route('replyupdate',['ticketid'=>$ticketdetails->id])}}" method="post">
                    @csrf
                    <input type="hidden" name="ticketid" value="{{$ticketdetails->id}}">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Add Reply for <b>{{$ticketdetails->title}}</b></label>
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
            @endif    
        </div>
    </div>
    <div class="card">
        <div class="card-body">
<div class="row  mt-4">
            @if(!$replies->isEmpty())
                <h2>Replies</h2>
                <div class="container">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Reply</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($replies as $reply)
                            <tr>
                                <td>{{ $reply->body}}</td>
                                <td>{{ $reply->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>              
                </div>
            @else
               <p>No Replies Yet</p>
            @endif    
        </div>
</div>
</div>
</div>
@endsection
