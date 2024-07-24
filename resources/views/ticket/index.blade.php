@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="text-primary">Support Tickets</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('ticket.create') }}" class="btn btn-primary">Create New</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @forelse ($tickets as $ticket)
                <div class="d-flex justify-content-between py-3 border-bottom">
                    <a href="{{ route('ticket.show', $ticket->id) }}" class="text-decoration-none text-dark">{{ $ticket->title }}</a>
                    <p class="mb-0 text-muted">{{ $ticket->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <p class="text-muted">You don't have any support tickets yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
