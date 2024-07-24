@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-primary">{{ $ticket->title }}</h1>
    <div class="card mt-4">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <p>{{ $ticket->description }}</p>
                <p class="text-muted mb-0">{{ $ticket->created_at->diffForHumans() }}</p>
                @if ($ticket->attachment)
                    <a href="{{ '/storage/' . $ticket->attachment }}" class="btn btn-link" target="_blank">Attachment</a>
                @endif
            </div>

            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="{{ route('ticket.edit', $ticket->id) }}" class="btn btn-warning me-2">Edit</a>

                    <form action="{{ route('ticket.destroy', $ticket->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this ticket?');">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>

                @if (auth()->user()->isAdmin)
                    <div class="d-flex">
                        <form action="{{ route('ticket.update', $ticket->id) }}" method="post" class="me-2">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="status" value="resolved" />
                            <button type="submit" class="btn btn-success">Resolve</button>
                        </form>
                        <form action="{{ route('ticket.update', $ticket->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="status" value="rejected" />
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>
                    </div>
                @else
                    <p class="text-muted mb-0">Status: {{ $ticket->status }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
