@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-light mb-4">
        <div class="card-body">
            <h3 class="mb-4">Ticket Details</h3>
            <ul class="list-unstyled">
                <li><strong>Title:</strong> {{ $ticketdetails->title }}</li>
                <li><strong>Description:</strong> {{ $ticketdetails->description }}</li>
                <li><strong>Created Date:</strong> {{ $ticketdetails->created_at }}</li>
            </ul>
        </div>
    </div>

    @if (\Auth::user()->role_id != 2)
    <div class="card shadow-sm border-light mb-4">
        <div class="card-body">
            <h4 class="mb-3">Add Reply for <b>{{ $ticketdetails->title }}</b></h4>
            <form action="{{ route('replyupdate', ['ticketid' => $ticketdetails->id]) }}" method="post">
                @csrf
                <input type="hidden" name="ticketid" value="{{ $ticketdetails->id }}">
                <div class="mb-3">
                    <label for="content" class="form-label">Reply</label>
                    <textarea class="form-control" id="content" name="content" rows="3" placeholder="Enter your reply here"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    @endif

    <div class="card shadow-sm border-light">
        <div class="card-body">
            <h4 class="mb-3">Replies</h4>
            @if(!$replies->isEmpty())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Reply</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($replies as $reply)
                    <tr>
                        <td>{{ $reply->body }}</td>
                        <td>{{ $reply->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No Replies Yet</p>
            @endif
        </div>
    </div>
</div>
@endsection
