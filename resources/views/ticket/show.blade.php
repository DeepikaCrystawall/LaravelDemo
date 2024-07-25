@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="text-primary mb-4">{{ $ticket->title }}</h1>
            <div class="card shadow-sm border-light">
                <div class="card-body">
                    <!-- Ticket Description and Date -->
                    <div class="mb-4">
                        <p class="card-text">{{ $ticket->description }}</p>
                        <p class="text-muted mb-0">Created {{ $ticket->created_at->diffForHumans() }}</p>
                    </div>

                    <!-- Attachment -->
                    @if ($ticket->attachment)
                        <div class="mb-4">
                            <a href="{{ '/storage/' . $ticket->attachment }}" class="btn btn-outline-primary" target="_blank">
                                <i class="bi bi-paperclip"></i> View Attachment
                            </a>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('ticket.edit', $ticket->id) }}" class="btn btn-warning me-2">
                                <i class="bi bi-pencil"></i> Edit
                            </a>

                            <form action="{{ route('ticket.destroy', $ticket->id) }}" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this ticket?');">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>

                        @if (auth()->user()->isAdmin)
                            <div>
                                <form action="{{ route('ticket.update', $ticket->id) }}" method="post" class="d-inline me-2">
                                    @csrf
                                    @method('patch')
                                    <input type="hidden" name="status" value="resolved" />
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-check-circle"></i> Resolve
                                    </button>
                                </form>
                                <form action="{{ route('ticket.update', $ticket->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('patch')
                                    <input type="hidden" name="status" value="rejected" />
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-x-circle"></i> Reject
                                    </button>
                                </form>
                            </div>
                        @else
                            <span class="badge bg-secondary">Status: {{ $ticket->status }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
